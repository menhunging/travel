<?php

use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;
use Bitrix\Main\SystemException;
use App\Helper;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class BqFosComponent extends \CBitrixComponent
{
    /**
     * @throws LoaderException
     * @throws SystemException
     * @throws Exception
     */
    public function onPrepareComponentParams($params): array
    {
        $params['IBLOCK_ID'] = $this->isIBlock($params);
        if (!empty(COption::GetOptionString('bquadro.fos', 'BQ_MODULE_FOS_BOT_PROTECT_SETTING_RECAPTCHA_ENABLE'))) {
            $params['RECAPTCHA_KEY'] = COption::GetOptionString(
                'bquadro.fos',
                'BQ_MODULE_FOS_BOT_PROTECT_SETTING_RECAPCHA_KEY'
            );
        }

        return $params;
    }

    /**
     * @throws Exception
     */
    private function isIBlock($params)
    {
        if (!isset($params['IBLOCK_CODE'])) {
            throw new Exception('не указан инфоблок для сохранения форм');
        }

        $IBLOCK_ID = intval(Helper\Iblock::getIblockId($params['IBLOCK_CODE']));

        if ($IBLOCK_ID == 0) {
            throw new Exception('Инфоблок с символьным кодом: ' . $params['IBLOCK_CODE'] . ' не сущесвует');
        }

        return $IBLOCK_ID;
    }

    public function executeComponent()
    {
        $this->includeComponentTemplate();
    }

    function listKeysSignedParameters(): array
    {
        //перечисляем те имена параметров, которые нужно использовать в аякс-действиях
        return [
            'IBLOCK_CODE',
            'SECTION_CODE',
        ];
    }
}