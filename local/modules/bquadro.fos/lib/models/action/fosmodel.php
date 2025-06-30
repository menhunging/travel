<?php

namespace Bquadro\Fos\Models\Action;

use Bquadro\Fos\Models\Sender\MessageSenderFactory;
use CIBlockElement;
use Bquadro\Fos\Dto\FormDTOInterface;
use Bitrix\Main\Result;
use Bitrix\Main\Error;

class FosModel extends Base
{
    private FormDTOInterface $dto;

    public function __construct(FormDTOInterface $dto)
    {
        parent::__construct();
        $this->dto = $dto;
    }

    public function addEl(): Result
    {
        try {
            $requestData = $this->dto->getFosData();
            $arPropFields = $this->dto->getAddData();
            $this->checkFields($arPropFields);

            if (empty($this->result->getErrors())) {
                $this->checkRecaptcha($requestData);
            }

            if (empty($this->result->getErrors())) {
                $arLoadProductArray = $this->getData($arPropFields);

                $el = new CIBlockElement;
                $id = $el->Add($arLoadProductArray);
                if ($id > 0) {
                    $this->data['id'] = $id;
                    $this->data['goal'] = $requestData['GOAL'] ?? '';
                    $this->eventSend();
                } else {
                    throw new \Exception('Проблема с сохранением данных: ' . $el->LAST_ERROR);
                }
            }
        } catch (\Exception $e) {
            $this->result->addError(new Error($e->getMessage()));
        }

        return $this->getResult();
    }

    private function getData($arPropFields)
    {
        $this->prepareFields($arPropFields);

        $arLoadProductArray = [
            "IBLOCK_ID" => $this->dto->getIBlockId(),
            "PROPERTY_VALUES" => $arPropFields,
            "ACTIVE" => "N",
        ];

        $arLoadProductArray["NAME"] = $this->getFormName();

        return $arLoadProductArray;
    }

    private function checkFields($arPropFields)
    {
        $questions = $this->dto->getFormFields();

        if (is_array($questions)) {
            foreach ($questions as $arQuestion) {
                if ($arQuestion['CODE'] == "EMAIL") {
                    if ($arPropFields[$arQuestion['CODE']] != "" && !check_email($arPropFields[$arQuestion['CODE']])) {
                        $this->result->addError(new Error('Заполните поле ' . $arQuestion["NAME"], 500, ['code' => $arQuestion['CODE']]));
                    }
                }

                if ($arQuestion['CODE'] == "PHONE") {
                    if ($arPropFields[$arQuestion['CODE']] != "" && strlen(preg_replace('/[^0-9]/', '', trim($arPropFields[$arQuestion['CODE']]))) != 11) {
                        $this->result->addError(new Error('Заполните поле ' . $arQuestion["NAME"], 500, ['code' => $arQuestion['CODE']]));
                    }
                }

                if (empty($arPropFields[$arQuestion['CODE']]) && $arQuestion["IS_REQUIRED"] == "Y" && $arQuestion["PROPERTY_TYPE"] !== 'F') {
                    $this->result->addError(new Error('Заполните поле ' . $arQuestion["NAME"], 500, ['code' => $arQuestion['CODE']]));
                }
            }
        }
    }

    private function checkRecaptcha($requestData)
    {
        $res = (new \App\Services\ReCaptcha($requestData['recaptcha_response'], $requestData['recaptcha_action']))->verify();
        if ($res['success'] == 'error') {
            $this->result->addError(new Error(implode(', ', $res['errors'])));
        }
    }

    private function prepareFields(&$arPropFields)
    {
        $questions = $this->dto->getFormFields();

        if (is_array($questions)) {
            if (is_array($_FILES)) {
                foreach ($questions as $arQuestion) {
                    $code = $arQuestion['CODE'];
                    if ($arQuestion["PROPERTY_TYPE"] === 'F') {
                        $bMultiple = $arQuestion["MULTIPLE"] === "Y";
                        $arFiles = array();
                        if (isset($_FILES[$code]) && !$bMultiple) {
                            $arFiles[$code] = $_FILES[$code];
                        } elseif (isset($_FILES[$code]) && $bMultiple) {
                            foreach ($_FILES[$code]["name"] as $key => $arFile) {
                                $arFiles[$key]["name"] = $arFile;
                                $arFiles[$key]["full_path"] = $_FILES[$code]["full_path"][$key];
                                $arFiles[$key]["type"] = $_FILES[$code]["type"][$key];
                                $arFiles[$key]["tmp_name"] = $_FILES[$code]["tmp_name"][$key];
                                $arFiles[$key]["error"] = $_FILES[$code]["error"][$key];
                                $arFiles[$key]["size"] = $_FILES[$code]["size"][$key];
                            }
                        }

                        if ($arFiles) {
                            foreach ($arFiles as $key => $arFile) {
                                if ($arFile['name']) {
                                    if ($arFile['error']) {
                                        $this->result->addError(new Error('Ошибка загрузки файла ' . $arFile['name'], 500, ['code' => $arQuestion['CODE']]));
                                    } else {
                                        $arPropFields[$code][] = $arFile;
                                    }
                                }
                            }
                        }
                    }
                }
            }

            foreach ($questions as $arQuestion) {
                $code = $arQuestion['CODE'];

                if (isset($arPropFields[$code])) {
                    $value = $arPropFields[$code];

                    if (strpos($code, "PHONE") !== false) {
                        $arPropFields[$code] = str_replace(array('(', ')', ' ', '-'), '', $value);
                    }

                    if ($arQuestion["USER_TYPE"] == "HTML") {
                        $arPropFields[$code] = array("VALUE" => array("TEXT" => $value, "TYPE" => $arQuestion["FIELD_TYPE"]));
                    } elseif ($arQuestion["USER_TYPE"] == "DATE") {
                        $arPropFields[$code] = array("VALUE" => str_replace(array('-', '/', ' ', ':'), array('.', '.', '.', '.'), $value));
                    } elseif ($arQuestion["USER_TYPE"] == "DATETIME") {
                        $arDateTime = explode(' ', $value);
                        $arPropFields[$code] = array("VALUE" => str_replace(array('-', '/', ' ', ':'), array('.', '.', '.', '.'), $arDateTime[0]) . ' ' . str_replace(array('-', '/', ' ', ':'), array(':', ':', ':', ':'), $arDateTime[1]));
                    }
                }
            }
        }
    }

    private function getFormName()
    {
        $arIBlock = \CIBlock::GetList(false, array("ID" => $this->dto->getIBlockId()))->Fetch();
        $formName = $arIBlock["NAME"];

        $moscowTimezone = new \DateTimeZone('Europe/Moscow');
        $nowDateTime = new \DateTime('now', $moscowTimezone);

        return 'Сообщение формы "' . $formName . '" от ' . $nowDateTime->format("d.m.Y H:i:s");
    }

    protected function eventSend()
    {
        $data = $this->dto->getData();
        $iblock = $this->dto->getIBlock();
        $site = $this->dto->getSite();

        $arEventFields = array(
            "SITE_NAME" => $site["NAME"],
            "FORM_NAME" => $iblock["NAME"],
            "ADMIN_RESULT_URL" => (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['SERVER_NAME'] . '/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=' . $this->dto->getIBlockId() . '&type=' . $iblock["IBLOCK_TYPE_STRING"]['ID'] . '&ID=' . $this->data['id'] . '&lang=' . $site["LANGUAGE_ID"] . '&find_section_section=0&WF=Y',
        );

        $arFields = $data['emailData'];
        $this->prepareEventFields($arFields);
        $arEventFields = array_merge($arFields, $arEventFields);

        $emailSender = MessageSenderFactory::createSender('email');
        $emailSender->makeEventMessage($this->dto);
        $arEventFields["EMAIL"] && $emailSender->send(['event' => $emailSender->getEventName(), 'arFields' => $arEventFields, 'duplicate' => 'N']);
        $emailSender->send(['event' => $emailSender->getEventNameAdmin(), 'arFields' => $arEventFields, 'duplicate' => 'N']);
    }

    protected function prepareEventFields(&$arEventFields)
    {
        $questions = $this->dto->getFormFields();

        if (is_array($questions)) {
            foreach ($questions as $arQuestion) {
                $code = $arQuestion['CODE'];

                if ($arQuestion["PROPERTY_TYPE"] === 'F') {
                    $arEventFields[$code] = [];

                    $dbRes = CIBlockElement::GetList(array(), array('ID' => $this->data['id'], 'IBLOCK_ID' => $this->dto->getIBlockId()), false, false, array('ID', 'PROPERTY_' . $code));
                    while ($arItem = $dbRes->Fetch()) {
                        if ($arItem['PROPERTY_' . strtoupper($code) . '_VALUE']) {
                            $filePath = \CFile::GetPath($arItem['PROPERTY_' . strtoupper($code) . '_VALUE']);
                            $fileLink = (\CMain::IsHTTPS() ? 'https' : 'http') . '://' . $_SERVER['SERVER_NAME'] . $filePath;
                            $arEventFields[$code][] = $fileLink;
                        }
                    }

                    $arEventFields[$code] = (count($arEventFields[$code]) > 1 ? "\n" : '') . implode("\n", $arEventFields[$code]);
                }
            }
        }
    }
}