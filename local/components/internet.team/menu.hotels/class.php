<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use App\Helper;

class ComponentMenuHotels extends \CBitrixComponent
{
    const CACHE_TIME = 36000;

    protected $module = [
        'iblock',
        'sprint.migration',
    ];

    public function onPrepareComponentParams($params)
    {
        $params['SECTION_ID'] = intval($params['SECTION_ID']);
        $params['IBLOCK_SECTION_ID'] = intval($params['IBLOCK_SECTION_ID']);
        $params['HIDE_HOTELS'] = $params['HIDE_HOTELS'] == 'Y' ? 'Y' : 'N';
        $params['SECTION_SORT_FIELD'] = $params['SECTION_SORT_FIELD'] ?: 'name';
        $params['SECTION_SORT_ORDER'] = $params['SECTION_SORT_ORDER'] ?: 'asc';

        return $params;
    }

    protected function includeModule()
    {
        foreach ($this->module as $moduleName) {
            if (!Loader::includeModule($moduleName)) {
                throw new \Exception('Модуль "' . $moduleName . '" не установлен.');
            }
        }
    }

    protected function getRegions(): void
    {
        $arFilter = array(
            "IBLOCK_ID" => $this->iblockId,
            "ACTIVE " => "Y",
            "GLOBAL_ACTIVE" => "Y",
            "=DEPTH_LEVEL" => 2,
        );

        if (0 < intval($this->arParams["IBLOCK_SECTION_ID"])) {
            $arFilter["SECTION_ID"] = $this->arParams["IBLOCK_SECTION_ID"];
        } elseif (0 < intval($this->arParams["SECTION_ID"])) {
            $arFilter["SECTION_ID"] = $this->arParams["SECTION_ID"];
        }

        $obCache = new \CPHPCache();
        if ($obCache->InitCache(static::CACHE_TIME, serialize($this->arParams) . serialize($arFilter), "/menu/hotels/region")) {
            $aMenuLinksExt = $obCache->GetVars();
        } elseif ($obCache->StartDataCache()) {
            $aMenuLinksExt = array();

            $arOrder = [
                $this->arParams['SECTION_SORT_FIELD'] => $this->arParams['SECTION_SORT_ORDER'],
            ];

            $rsSections = \CIBlockSection::GetList($arOrder, $arFilter, false, array('ID', 'NAME', 'SECTION_PAGE_URL'));

            if (defined("BX_COMP_MANAGED_CACHE")) {
                global $CACHE_MANAGER;
                $CACHE_MANAGER->StartTagCache("/menu/hotels/region");
            }

            while ($arSection = $rsSections->GetNext()) {
                $aMenuLinksExt[] = array(
                    "ID" => $arSection["ID"],
                    "NAME" => $arSection["NAME"],
                    "SECTION_PAGE_URL" => $arSection["SECTION_PAGE_URL"],
                );

                if (defined("BX_COMP_MANAGED_CACHE")) {
                    global $CACHE_MANAGER;
                    $CACHE_MANAGER->RegisterTag("iblock_id_" . $this->iblockId);
                }
            }

            if (defined("BX_COMP_MANAGED_CACHE")) {
                global $CACHE_MANAGER;
                $CACHE_MANAGER->EndTagCache();
            }

            $obCache->EndDataCache($aMenuLinksExt);
        }
        if (!isset($aMenuLinksExt)) {
            $aMenuLinksExt = [];
        }

        foreach ($aMenuLinksExt as &$item) {
            $item["SELECTED"] = $this->arParams["SECTION_ID"] == $item["ID"];
        }

        $this->arResult['REGIONS'] = $aMenuLinksExt;
    }

    protected function getHotels(): void
    {
        $arFilter = array(
            "IBLOCK_ID" => $this->iblockId,
            "ACTIVE" => "Y",
            "SECTION_ID" => $this->arParams["SECTION_ID"],
            "INCLUDE_SUBSECTIONS" => "Y",
        );

        $obCache = new \CPHPCache();
        if ($obCache->InitCache(static::CACHE_TIME, serialize($arFilter), "/menu/hotels/hotel")) {
            $aMenuLinksExt = $obCache->GetVars();
        } elseif ($obCache->StartDataCache()) {
            $aMenuLinksExt = array();

            $res = \CIBlockElement::GetList(array("name" => "asc"), $arFilter, false, false, array('ID', 'NAME', 'DETAIL_PAGE_URL', 'PROPERTY_RATING'));

            if (defined("BX_COMP_MANAGED_CACHE")) {
                global $CACHE_MANAGER;
                $CACHE_MANAGER->StartTagCache("/menu/hotels/hotel");
            }

            while ($arFields = $res->GetNext()) {
                $aMenuLinksExt[] = [
                    'ID' => $arFields['ID'],
                    'NAME' => $arFields['NAME'],
                    'DETAIL_PAGE_URL' => $arFields['DETAIL_PAGE_URL'],
                    'RATING' => $arFields['PROPERTY_RATING_VALUE'],
                ];

                if (defined("BX_COMP_MANAGED_CACHE")) {
                    global $CACHE_MANAGER;
                    $CACHE_MANAGER->RegisterTag("iblock_id_" . $this->iblockId);
                }
            }

            if (defined("BX_COMP_MANAGED_CACHE")) {
                global $CACHE_MANAGER;
                $CACHE_MANAGER->EndTagCache();
            }

            $obCache->EndDataCache($aMenuLinksExt);
        }
        if (!isset($aMenuLinksExt)) {
            $aMenuLinksExt = [];
        }

        $this->arResult['HOTELS'] = $aMenuLinksExt;
    }

    protected function executeMain(): void
    {
        $this->iblockId = intval(Helper\Iblock::getIblockId('hotels'));
        if ($this->iblockId == 0) {
            throw new \Exception('Инфоблок не найден.');
        }

        if ($this->arParams["SECTION_ID"] == 0) {
            throw new \Exception('Раздел не найден.');
        }

        $this->getRegions();

        if ($this->arParams['HIDE_HOTELS'] != 'Y') {
            $this->getHotels();
        }
    }

    public function executeComponent()
    {
        try {
            $this->includeModule();
            $this->executeMain();
            $this->includeComponentTemplate();
        } catch (\Exception $e) {
            ShowError($e->getMessage());
        }
    }
}
