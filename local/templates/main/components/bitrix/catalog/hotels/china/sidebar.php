<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div class="china-fonts qwe">
    <?php $APPLICATION->IncludeComponent(
        "internet.team:menu.hotels",
        "",
        Array(
            "SECTION_ID" => $arCurSection['ID'],
            "IBLOCK_SECTION_ID" => $arCurSection['IBLOCK_SECTION_ID'],
            "HIDE_HOTELS" => 'N',
            "SECTION_SORT_FIELD" => "sort",
            "SECTION_SORT_ORDER" => "asc",
        )
    );?>
</div>
