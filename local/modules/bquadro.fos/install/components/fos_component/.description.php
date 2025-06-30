<?php

use Bitrix\Main\Localization\Loc;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
Loc::loadMessages(__FILE__);

$arComponentDescription = [
    'NAME'        => Loc::getMessage("BQ_MODULE_FOS_COMPONENT_NAME"),
    'DESCRIPTION' => 'Выводит товар каталога',
    'PATH'        => [
        'ID'    => 'bquadro',
        'NAME'  => 'Bquadro',
        'CHILD' => [
            'ID'   => 'bquadro_fos',
            'NAME' => 'Формы обратной связи',
        ],
    ],
    'ICON'        => '/images/icon.gif',
];