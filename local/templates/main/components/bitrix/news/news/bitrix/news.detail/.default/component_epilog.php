<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (!empty($templateData['LINK_NEWS'])) {
    global $arrFilterLinkNews;
    $arrFilterLinkNews = [
        'ID' => $templateData['LINK_NEWS'],
    ];

    $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "news_slider",
        [
            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            "NEWS_COUNT" => 6,
            "SORT_BY1" => $arParams["SORT_BY1"],
            "SORT_ORDER1" => $arParams["SORT_ORDER1"],
            "SORT_BY2" => $arParams["SORT_BY2"],
            "SORT_ORDER2" => $arParams["SORT_ORDER2"],
            "FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
            "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
            "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
            "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
            "IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
            "SET_TITLE" => 'N',
            "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
            "MESSAGE_404" => $arParams["MESSAGE_404"],
            "SET_STATUS_404" => 'N',
            "SHOW_404" => 'N',
            "FILE_404" => $arParams["FILE_404"],
            "INCLUDE_IBLOCK_INTO_CHAIN" => 'N',
            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
            "CACHE_TIME" => $arParams["CACHE_TIME"],
            "CACHE_FILTER" => 'Y',
            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
            "DISPLAY_TOP_PAGER" => 'N',
            "DISPLAY_BOTTOM_PAGER" => 'N',
            "PAGER_TITLE" => $arParams["PAGER_TITLE"],
            "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
            "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
            "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
            "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
            "PAGER_SHOW_ALL" => 'N',
            "PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
            "PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
            "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
            "DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
            "DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
            "PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
            "ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
            "USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
            "GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
            "FILTER_NAME" => 'arrFilterLinkNews',
            "HIDE_LINK_WHEN_NO_DETAIL" => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],
            "CHECK_DATES" => $arParams["CHECK_DATES"],
        ],
        $component,
        ['HIDE_ICONS' => 'Y']
    );
}
