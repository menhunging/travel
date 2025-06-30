<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use App\Models\Hotel\Transfer;

$arResult['TRANSFERS'] = [];
if ($sectionId = $arResult['PROPERTIES']['TRANSFERS']['VALUE']) {
    $arResult['TRANSFERS'] = Transfer::getTransfers($sectionId);
}
