<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arResult['LINK_NEWS'] = [];

$arFilter = array(
    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
    "ACTIVE_DATE" => "Y",
    "ACTIVE" => "Y",
    "CHECK_PERMISSIONS" => "Y",
);

$res = CIBlockElement::GetList(
    array(
        $arParams["SORT_BY1"] => $arParams["SORT_ORDER1"],
        $arParams["SORT_BY2"] => $arParams["SORT_ORDER2"],
    ),
    $arFilter,
    false,
    array("nPageSize" => "3", "nElementID" => $arResult["ID"]),
    array("ID", "NAME")
);
while ($ob = $res->GetNext()) {
    if ($ob['ID'] != $arResult["ID"]) {
        $arResult['LINK_NEWS'][] = $ob['ID'];
    }
}
