<?php

namespace App\Models;

use Bitrix\Main\Loader;
use CPHPCache;
use CIBlockElement;
use App\Helper;

class SiteContact
{
    public static function getContacts()
    {
        $iblockId = Helper\Iblock::getIblockId('directory_contacts');

        $arFilter = array(
            "IBLOCK_ID" => $iblockId,
            "CODE" => "contacts",
            "ACTIVE" => "Y",
        );

        $arSiteContacts = [];
        $siteContactsCacheID = serialize($arFilter);
        $obCache = new CPHPCache();
        if ($obCache->InitCache(86400, $siteContactsCacheID, "/site/contacts")) {
            $arSiteContacts = $obCache->GetVars();
        } elseif ($obCache->StartDataCache()) {
            if (Loader::includeModule("iblock")) {
                $arSelect = array("*");
                $res = CIBlockElement::GetList(array("sort" => "asc"), $arFilter, false, array("nTopCount" => 1), $arSelect);

                if (defined("BX_COMP_MANAGED_CACHE")) {
                    global $CACHE_MANAGER;
                    $CACHE_MANAGER->StartTagCache("/site/contacts");
                }

                if ($ob = $res->GetNextElement()) {
                    $arFields = $ob->GetFields();
                    $arFields["PROPERTIES"] = $ob->GetProperties();

                    $arSiteContacts = [
                        "PHONE" => $arFields["PROPERTIES"]["PHONE"]["~VALUE"] ?: null,
                        "EMAIL" => $arFields["PROPERTIES"]["EMAIL"]["~VALUE"] ?: null,
                        "SCHEDULE" => $arFields["PROPERTIES"]["SCHEDULE"]["~VALUE"]
                            ? [
                                'VALUE' => $arFields["PROPERTIES"]["SCHEDULE"]["~VALUE"],
                                'DESCRIPTION' => $arFields["PROPERTIES"]["SCHEDULE"]["~DESCRIPTION"],
                            ]
                            : null,
                        "COUNTRY" => $arFields["PROPERTIES"]["COUNTRY"]["~VALUE"] ?: null,
                        "CITY" => $arFields["PROPERTIES"]["CITY"]["~VALUE"] ?: null,
                        "ADDRESS" => $arFields["PROPERTIES"]["ADDRESS"]["~VALUE"] ?: null,
                        "UR_NAME" => $arFields["PROPERTIES"]["UR_NAME"]["~VALUE"] ?: null,
                        "UR_ADDRESS" => $arFields["PROPERTIES"]["UR_ADDRESS"]["~VALUE"] ?: null,
                        "OGRN" => $arFields["PROPERTIES"]["OGRN"]["~VALUE"] ?: null,
                        "UR_NUMBER" => $arFields["PROPERTIES"]["UR_NUMBER"]["~VALUE"] ?: null,
                        "YANDEX_MAP_CONSTRUCTOR" => $arFields["PROPERTIES"]["YANDEX_MAP_CONSTRUCTOR"]["~VALUE"] ?: null,
                        "YANDEX_MAP" => $arFields["PROPERTIES"]["YANDEX_MAP"]["~VALUE"] ? explode(',', $arFields["PROPERTIES"]["YANDEX_MAP"]["~VALUE"]) : null,
                    ];

                    if (defined("BX_COMP_MANAGED_CACHE")) {
                        $CACHE_MANAGER->RegisterTag("iblock_id_" . $iblockId);
                    }
                }

                if (defined("BX_COMP_MANAGED_CACHE")) {
                    $CACHE_MANAGER->EndTagCache();
                }
            }
            $obCache->EndDataCache($arSiteContacts);
        }

        return $arSiteContacts;
    }
}
