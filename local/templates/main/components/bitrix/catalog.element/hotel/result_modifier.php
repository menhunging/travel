<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

if ($arResult['PROPERTIES']['GALLERY']['VALUE']) {
    $arResult['DISPLAY_PROPERTIES']['GALLERY']['FILE_VALUE'] = [];
    foreach ($arResult['PROPERTIES']['GALLERY']['VALUE'] as $value) {
        $arResult['DISPLAY_PROPERTIES']['GALLERY']['FILE_VALUE'][] = CFile::GetFileArray($value);
    }
}
