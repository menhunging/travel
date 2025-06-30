<?php

namespace Bquadro\Fos\Dto;

use Bitrix\Iblock\PropertyTable;
use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use App\Helper;

abstract class BaseFormDTO implements FormDTOInterface
{
    public array $data;
    protected string $iblockId;
    protected string $iblockCode;
    protected array $addData;

    public function __construct()
    {
    }

    /**
     * Получение данных FOS из запроса
     * @return array
     */
    public function getFosData(): array
    {
        $request = Application::getInstance()->getContext()->getRequest();

        return $request->getPostList()->toArray();
    }

    protected function getIBlockByCodeId($iblockCode): ?int
    {
        return intval(Helper\Iblock::getIblockId($iblockCode));
    }

    public function getIblock()
    {
        Loader::includeModule('iblock');
        $arIBlock = \CIBlock::GetList(false, array("ID" => $this->iblockId))->Fetch();
        if ($arIBlock['IBLOCK_TYPE_ID']) {
            $arIBlock["IBLOCK_TYPE_STRING"] = \CIBlockType::GetByID($arIBlock['IBLOCK_TYPE_ID'])->Fetch();
        }

        return $arIBlock;
    }

    public function getSite()
    {
        return \CSite::GetByID(SITE_ID)->Fetch();
    }

    public function getFormFields($fieldsCode = null)
    {
        $cacheTime = 3600000; // Время жизни кеша в секундах

        $filter = ['=IBLOCK_ID' => $this->iblockId, '=ACTIVE' => 'Y'];

        if (!empty($fieldsCode)) {
            $filter['CODE'] = $fieldsCode;
        }

        $properties = PropertyTable::getList([
            'filter' => $filter,
            'select' => ['ID', 'NAME', 'CODE', 'PROPERTY_TYPE', 'IS_REQUIRED', 'USER_TYPE', 'MULTIPLE'],
            'order' => ['SORT' => 'ASC'],
            'cache' => [
                'ttl' => $cacheTime,
                'cache_joins' => true,
            ],
        ])->fetchAll();

        return $properties;
    }

    protected function setAddData($iblockFields, $requestData)
    {
        $res = [];
        foreach ($iblockFields as $iblockField) {
            $code = $iblockField['CODE'];
            $res['PROPS'][$code] = $requestData[$code];
        }
        $this->addData = $res;
    }

    public function getAddData(): array
    {
        return $this->addData['PROPS'];
    }

    public function getIBlockId()
    {
        return $this->iblockId;
    }

    public function getIblockCode()
    {
        return $this->iblockCode;
    }

    protected function getEmailFields(): array
    {
        $fields = [];

        return $fields;
    }

    protected function setEmailData($emailFields, $requestData)
    {
        $res = [];

        if (!empty($emailFields)) {
            foreach ($emailFields as $key) {
                if (!isset($requestData[$key])) {
                    continue;
                }

                $res[$key] = $requestData[$key];
            }
            return $res;
        } else {
            return $requestData;
        }
    }

    public function getData()
    {
        return $this->data;
    }
}