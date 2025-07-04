<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arViewModeList = array('LIST', 'LINE', 'TEXT', 'TILE');

$arDefaultParams = array(
    'VIEW_MODE' => 'LIST',
    'SHOW_PARENT_NAME' => 'Y',
    'HIDE_SECTION_NAME' => 'N'
);

$arParams = array_merge($arDefaultParams, $arParams);

if (!in_array($arParams['VIEW_MODE'], $arViewModeList))
    $arParams['VIEW_MODE'] = 'LIST';
if ('N' != $arParams['SHOW_PARENT_NAME'])
    $arParams['SHOW_PARENT_NAME'] = 'Y';
if ('Y' != $arParams['HIDE_SECTION_NAME'])
    $arParams['HIDE_SECTION_NAME'] = 'N';

$arResult['VIEW_MODE_LIST'] = $arViewModeList;

if (0 < $arResult['SECTIONS_COUNT']) {
    if ('LIST' != $arParams['VIEW_MODE']) {
        $boolClear = false;
        $arNewSections = array();
        foreach ($arResult['SECTIONS'] as &$arOneSection) {
            if (1 < $arOneSection['RELATIVE_DEPTH_LEVEL']) {
                $boolClear = true;
                continue;
            }
            $arNewSections[] = $arOneSection;
        }
        unset($arOneSection);
        if ($boolClear) {
            $arResult['SECTIONS'] = $arNewSections;
            $arResult['SECTIONS_COUNT'] = count($arNewSections);
        }
        unset($arNewSections);
    }
}

$arResult['LETTER'] = [];
if (0 < $arResult['SECTIONS_COUNT']) {
    $arNames = array_column($arResult["SECTIONS"], 'NAME');
    $arNames = array_unique(array_map(function ($item) {
        return mb_substr($item, 0, 1);
    }, $arNames));

    sort($arNames);

    $arResult['LETTER'] = $arNames;
}
