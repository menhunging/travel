<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use App\Helper;

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */

/** @var CBitrixComponent $component */

use Bitrix\Main\Loader;

$this->setFrameMode(true);

$arFilter = array(
    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
    "ACTIVE" => "Y",
    "GLOBAL_ACTIVE" => "Y",
);
if (0 < intval($arResult["VARIABLES"]["SECTION_ID"]))
    $arFilter["ID"] = $arResult["VARIABLES"]["SECTION_ID"];
elseif ('' != $arResult["VARIABLES"]["SECTION_CODE"])
    $arFilter["=CODE"] = $arResult["VARIABLES"]["SECTION_CODE"];

$obCache = new CPHPCache();
if ($obCache->InitCache(36000, serialize($arFilter), "/iblock/catalog")) {
    $arCurSection = $obCache->GetVars();
} elseif ($obCache->StartDataCache()) {
    $arCurSection = array();
    if (Loader::includeModule("iblock")) {
        $dbRes = CIBlockSection::GetList(
            array(),
            $arFilter,
            false,
            array("ID", "NAME", "DEPTH_LEVEL", "IBLOCK_SECTION_ID", "PICTURE", "DESCRIPTION", "UF_COUNTRY", "UF_REGION", "UF_CHINA", "UF_CHINA_TEMPLATE")
        );

        if (defined("BX_COMP_MANAGED_CACHE")) {
            global $CACHE_MANAGER;
            $CACHE_MANAGER->StartTagCache("/iblock/catalog");

            if ($arCurSection = $dbRes->Fetch())
                $CACHE_MANAGER->RegisterTag("iblock_id_" . $arParams["IBLOCK_ID"]);

            $CACHE_MANAGER->EndTagCache();
        } else {
            if (!$arCurSection = $dbRes->Fetch())
                $arCurSection = array();
        }
    }
    $obCache->EndDataCache($arCurSection);
}
if (!isset($arCurSection))
    $arCurSection = array();

if ($arCurSection['DEPTH_LEVEL'] == 1) {
    if ($arCurSection['UF_CHINA']) {
        include($_SERVER["DOCUMENT_ROOT"] . "/" . $this->GetFolder() . "/china.php");
    } else {
        include($_SERVER["DOCUMENT_ROOT"] . "/" . $this->GetFolder() . "/country.php");
    }
} elseif ($arCurSection['DEPTH_LEVEL'] == 2) {
    if ($arCurSection['UF_CHINA_TEMPLATE']) {
        if ($template = Helper\UserField::getById($arCurSection['UF_CHINA_TEMPLATE'] ?: '')) {
            include($_SERVER["DOCUMENT_ROOT"] . "/" . $this->GetFolder() . "/china/" . $template['XML_ID'] . ".php");
        }
    } else {
        include($_SERVER["DOCUMENT_ROOT"] . "/" . $this->GetFolder() . "/region.php");
    }
} else {
    LocalRedirect("/hotels/", true, '301 Moved permanently');
}
