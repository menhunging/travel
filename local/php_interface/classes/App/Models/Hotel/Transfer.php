<?php

namespace App\Models\Hotel;

use Bitrix\Main\Loader;
use App\Helper;

class Transfer
{
    public static function getTransfers($sectionId)
    {
        $sectionId = intval($sectionId);

        if (Loader::includeModule('iblock') === false || $sectionId == 0) {
            return [];
        }

        $result = [];
        $sectionIds = [];
        $arProps = ['PRICE_LIST'];

        $iblockId = intval(Helper\Iblock::getIblockId('transfers'));

        if ($iblockId) {
            $arFilter = [
                'IBLOCK_ID' => $iblockId,
                'SECTION_ID' => $sectionId,
                'ACTIVE' => 'Y',
                'INCLUDE_SUBSECTIONS' => 'Y',
            ];
            $arSelect = array("IBLOCK_ID", "ID", "NAME", "IBLOCK_SECTION_ID");

            $result["ITEMS"] = [];
            $rsElement = \CIBlockElement::GetList(array('sort' => 'asc'), $arFilter, false, false, $arSelect);
            while ($arItem = $rsElement->GetNext()) {
                $arItem["PROPERTIES"] = array();
                $arItem["DISPLAY_PROPERTIES"] = array();

                $id = (int)$arItem["ID"];
                $result["ITEMS"][$id] = $arItem;

                if ($arItem['IBLOCK_SECTION_ID']) {
                    $sectionIds[] = $arItem['IBLOCK_SECTION_ID'];
                }
            }

            if (!empty($result['ITEMS'])) {
                \CIBlockElement::GetPropertyValuesArray(
                    $result["ITEMS"],
                    $iblockId,
                    $arFilter
                );
            } else {
                return [];
            }

            $result['ITEMS'] = array_values($result['ITEMS']);

            foreach ($result["ITEMS"] as &$arItem) {
                foreach ($arProps as $pid) {
                    $prop = &$arItem["PROPERTIES"][$pid];
                    if (
                        (is_array($prop["VALUE"]) && count($prop["VALUE"]) > 0)
                        || (!is_array($prop["VALUE"]) && $prop["VALUE"] <> '')
                    ) {
                        $arItem["DISPLAY_PROPERTIES"][$pid] = \CIBlockFormatProperties::GetDisplayValue($arItem, $prop);
                    }
                }
            }
            unset($arItem);

            $result['SECTION'] = [];
            if (!empty($sectionIds)) {
                $result['SECTION'] = self::getTransfersSection($sectionIds);
            }
        }

        return $result;
    }

    protected static function getTransfersSection(array $id)
    {
        if (Loader::includeModule('iblock') === false|| empty($id)) {
            return [];
        }

        $result = [];

        $iblockId = intval(Helper\Iblock::getIblockId('transfers'));

        if ($iblockId) {
            $arFilter = [
                "IBLOCK_ID" => $iblockId,
                "ID" => $id,
                "ACTIVE" => "Y",
                "GLOBAL_ACTIVE" => "Y",
            ];

            $res = \CIBlockSection::GetList(array("SORT" => "ASC"), $arFilter, false, array('ID', 'NAME', 'SORT', 'UF_AIRPORT'));
            while ($arFields = $res->Fetch()) {
                $result[$arFields['ID']] = $arFields;
            }
        }

        return $result;
    }
}