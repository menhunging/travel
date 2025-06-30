<?php

namespace Bquadro\Fos\Models\Sender;

use Bitrix\Main\Localization\Loc;
use CEvent;
use CEventType;
use CEventMessage;
use CSite;
use Bquadro\Fos\Dto\FormDTOInterface;

class EmailSender implements MessageSender
{
    const EVENT_TYPE = 'BQUADRO_SEND_FORM';

    private $arResult = [];

    public function send($params)
    {
        $event = '';
        $arFields = [];
        $duplicate = 'Y';
        extract($params);

        CEvent::Send($event, SITE_ID, $arFields, $duplicate);
    }

    public function makeEventMessage(FormDTOInterface $dto)
    {
        $iblockId = $dto->getIBlockId();
        $questions = $dto->getFormFields();

        $eventDesc = '';
        $messBody = '';

        $arIBlock = \CIBlock::GetList(false, array("ID" => $iblockId))->Fetch();
        $this->arResult["IBLOCK_CODE"] = $arIBlock["CODE"] ?: "form_" . $arIBlock["ID"];
        $this->arResult["IBLOCK_TITLE"] = $arIBlock["NAME"];
        $this->arResult["IBLOCK_DESCRIPTION"] = $arIBlock["DESCRIPTION"];
        $this->arResult["IBLOCK_DESCRIPTION_TYPE"] = $arIBlock["DESCRIPTION_TYPE"];

        if ($arIBlock['IBLOCK_TYPE_ID']) {
            $this->arResult["IBLOCK_TYPE_STRING"] = \CIBlockType::GetByID($arIBlock['IBLOCK_TYPE_ID'])->Fetch();
        }

        $this->arResult["SITE"] = CSite::GetByID(SITE_ID)->Fetch();

        if (is_array($questions)) {
            foreach ($questions as $arQuestion) {
                $eventDesc .= $arQuestion["NAME"] . ": " . "#" . $arQuestion['CODE'] . "#\n";
                if ($arQuestion["USER_TYPE"] == "HTML") {
                    $messBody .= $arQuestion["NAME"] . ":\n" . "#" . $arQuestion['CODE'] . "#\n";
                } else {
                    $messBody .= $arQuestion["NAME"] . ": " . "#" . $arQuestion['CODE'] . "#\n";
                }
            }
        }
        $eventDesc .= Loc::getMessage("FORM_ET_DESCRIPTION");
        $eventDescAdmin = $eventDesc . Loc::getMessage("FORM_ET_DESCRIPTION_ADMIN");
        $messBodyAdmin = $messBody;
        $messBodyAdmin .= Loc::getMessage("FORM_EM_ADMIN_LINK");

        $eventName = self::EVENT_TYPE . "_" . $iblockId;
        $arEvent = CEventType::GetByID($eventName, $this->arResult["SITE"]["LANGUAGE_ID"])->Fetch();
        if (!is_array($arEvent)) {
            $et = new CEventType;
            $arEventFields = array(
                "LID" => $this->arResult["SITE"]["LANGUAGE_ID"],
                "EVENT_NAME" => $eventName,
                "NAME" => Loc::getMessage("FORM_ET_NAME") . " \"" . $this->arResult["IBLOCK_TITLE"] . "\"",
                "DESCRIPTION" => $eventDesc,
            );
            $et->Add($arEventFields);
            $arEventFields["LID"] = ($this->arResult["SITE"]["LANGUAGE_ID"] == 'ru' ? 'en' : 'ru');
            $et->Add($arEventFields);
        }

        $this->arResult["MESS"] = CEventMessage::GetList($this->arResult["SITE"]["ID"], $order = "desc", array("TYPE_ID" => $eventName))->Fetch();
        if (!is_array($this->arResult["MESS"])) {
            $em = new CEventMessage;
            $this->arResult["MESS"] = array();
            $this->arResult["MESS"]["ID"] = $em->Add(
                array(
                    "ACTIVE" => "Y",
                    "EVENT_NAME" => $eventName,
                    "LID" => array($this->arResult["SITE"]["LID"]),
                    "EMAIL_FROM" => "#DEFAULT_EMAIL_FROM#",
                    "EMAIL_TO" => "#EMAIL#",
                    "BCC" => "",
                    "SUBJECT" => Loc::getMessage("FORM_EM_NAME"),
                    "BODY_TYPE" => "text",
                    "MESSAGE" => Loc::getMessage("FORM_EM_START") . $messBody . Loc::getMessage("FORM_EM_END"),
                ));
            $this->arResult["MESS"]["EVENT_NAME"] = $eventName;
        }

        $eventNameAdmin = self::EVENT_TYPE . "_ADMIN_" . $iblockId;
        $arEvent = CEventType::GetByID($eventNameAdmin, $this->arResult["SITE"]["LANGUAGE_ID"])->Fetch();
        if (!is_array($arEvent)) {
            $et = new CEventType;
            $arEventFields = array(
                "LID" => $this->arResult["SITE"]["LANGUAGE_ID"],
                "EVENT_NAME" => $eventNameAdmin,
                "NAME" => Loc::getMessage("FORM_ET_NAME") . " \"" . $this->arResult["IBLOCK_TITLE"] . "\"",
                "DESCRIPTION" => $eventDescAdmin,
            );
            $et->Add($arEventFields);
            $arEventFields["LID"] = ($this->arResult["SITE"]["LANGUAGE_ID"] == 'ru' ? 'en' : 'ru');
            $et->Add($arEventFields);
        }

        $this->arResult["MESS_ADMIN"] = CEventMessage::GetList($this->arResult["SITE"]["ID"], $order = "desc", array("TYPE_ID" => $eventNameAdmin))->Fetch();
        if (!is_array($this->arResult["MESS_ADMIN"])) {
            $em = new CEventMessage;
            $this->arResult["MESS_ADMIN"] = array();
            $this->arResult["MESS_ADMIN"]["ID"] = $em->Add(
                array(
                    "ACTIVE" => "Y",
                    "EVENT_NAME" => $eventNameAdmin,
                    "LID" => array($this->arResult["SITE"]["LID"]),
                    "EMAIL_FROM" => "#DEFAULT_EMAIL_FROM#",
                    "EMAIL_TO" => "#DEFAULT_EMAIL_FROM#",
                    "BCC" => "",
                    "SUBJECT" => Loc::getMessage("FORM_EM_NAME"),
                    "BODY_TYPE" => "text",
                    "MESSAGE" => Loc::getMessage("FORM_EM_START_ADMIN") . $messBodyAdmin . Loc::getMessage("FORM_EM_END"),
                ));
            $this->arResult["MESS_ADMIN"]["EVENT_NAME"] = $eventNameAdmin;
        }
    }

    public function getEventName()
    {
        return $this->arResult["MESS"]["EVENT_NAME"];
    }

    public function getEventNameAdmin()
    {
        return $this->arResult["MESS_ADMIN"]["EVENT_NAME"];
    }
}