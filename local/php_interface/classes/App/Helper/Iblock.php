<?php

namespace App\Helper;

use Bitrix\Main\Loader;
use Sprint\Migration\HelperManager;

class Iblock
{
    protected static function getHelper()
    {
        Loader::includeModule('sprint.migration');
        return HelperManager::getInstance();
    }

    public static function getIblockId($code)
    {
        if (Loader::includeModule('sprint.migration')) {
            return self::getHelper()->Iblock()->getIblockId($code);
        }

        return '';
    }

    public static function getPropertyId($iblockCode, $propertyCode)
    {
        if (Loader::includeModule('sprint.migration')) {
            if (intval($iblockCode) > 0) {
                $iblockId = $iblockCode;
            } else {
                $iblockId = self::getHelper()->Iblock()->getIblockId($iblockCode);
            }

            return self::getHelper()->Iblock()->getPropertyId($iblockId, $propertyCode);
        }

        return '';
    }

    public static function getPropertyEnumId($iblockCode, $propertyCode, $propertyEnumXmlId)
    {
        if (Loader::includeModule('sprint.migration')) {
            if (intval($iblockCode) > 0) {
                $iblockId = $iblockCode;
            } else {
                $iblockId = self::getHelper()->Iblock()->getIblockId($iblockCode);
            }

            return self::getHelper()->Iblock()->getPropertyEnumIdByXmlId($iblockId, $propertyCode, $propertyEnumXmlId);
        }

        return '';
    }

    public static function getPropertyEnums($iblockCode, $propertyCode)
    {
        if (Loader::includeModule('sprint.migration')) {
            if (intval($iblockCode) > 0) {
                $iblockId = $iblockCode;
            } else {
                $iblockId = self::getHelper()->Iblock()->getIblockId($iblockCode);
            }

            $filter = [
                'IBLOCK_ID' => $iblockId,
                'CODE' => $propertyCode,
            ];

            return self::getHelper()->Iblock()->getPropertyEnums($filter);
        }

        return [];
    }
}