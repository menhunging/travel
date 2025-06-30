<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/** @var array $arParams */
/** @var array $arResult */
/** @global \CMain $APPLICATION */
/** @global \CUser $USER */
/** @global \CDatabase $DB */
/** @var \CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var array $templateData */
/** @var \CBitrixComponent $component */
$this->setFrameMode(true);

$countByColumn = 10;
?>

<div class="country-links">
    <div class="country-menu">
        <div class="country-menu__line">
            <span class="caption caption--h4">
        <?php echo Loc::getMessage('CP_MENU_HOTELS_CHINA_TITLE'); ?>
    </span>

            <?php if (!empty($arResult['REGIONS'])) { ?>
                <ul class="country-links__menu">
                    <?php foreach ($arResult['REGIONS'] as $key => $item) { ?>
                        <?php if ($item['SELECTED']) { ?>
                            <li>
                                <a href="<?php echo $item['SECTION_PAGE_URL']; ?>" class="active">
                                    <?php echo $item['NAME']; ?>
                                </a>
                            </li>
                        <?php } else { ?>
                            <li>
                                <a href="<?php echo $item['SECTION_PAGE_URL']; ?>">
                                    <?php echo $item['NAME']; ?>
                                </a>
                            </li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            <?php } ?>
        </div>
        <?php if (!empty($arResult['HOTELS'])) {?>
    <div class="country-menu__line">
            <span class="country-menu__title">
                <?php echo Loc::getMessage('CP_MENU_HOTELS_HOTEL_TITLE'); ?>
            </span>
        <?php
            $count = count($arResult['HOTELS']);
            $column = ceil($count / $countByColumn);
            ?>
            <div class="country-menu__row">
                <div class="country-menu__col visible">
                    <ul>
                        <?php foreach ($arResult['HOTELS'] as $key => $item) {
                            if ($key >= $countByColumn) break;
                            ?>
                            <li>
                                <a href="<?php echo $item['DETAIL_PAGE_URL']; ?>">
                                    <?php echo $item['NAME']; ?>
                                    <?php if ($item['RATING']) { ?>
                                        <span class="num"><?php echo $item['RATING']; ?>*</span>
                                    <?php } ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="slider-links swiper">
                    <div class="swiper-wrapper">
                        <?php for ($i = 0; $i < $column; $i++) { ?>
                            <div class="swiper-slide">
                                <div class="country-menu__col">
                                    <ul>
                                        <?php for ($j = 0; $j < $countByColumn; $j++) {
                                            $key = ($i * $countByColumn) + $j;
                                            if (!isset($arResult['HOTELS'][$key])) break;

                                            $item = $arResult['HOTELS'][$key];
                                            ?>
                                            <li>
                                                <a href="<?php echo $item['DETAIL_PAGE_URL']; ?>">
                                                    <?php echo $item['NAME']; ?>
                                                    <?php if ($item['RATING']) { ?>
                                                        <span class="num"><?php echo $item['RATING']; ?>*</span>
                                                    <?php } ?>
                                                </a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="swiper-controls">
                        <button
                                class="swiper-button-prev  btn-arrow btn-arrow--left--gold"></button>
                        <button
                                class="swiper-button-next  btn-arrow btn-arrow--right--gold"></button>
                    </div>
                </div>
            </div>
            <a href="javascript:;" class="country-menu__more link link--arrow" data-opened="<?php echo Loc::getMessage('CP_MENU_HOTELS_LESS'); ?>"
               data-text="<?php echo Loc::getMessage('CP_MENU_HOTELS_MORE'); ?>"><?php echo Loc::getMessage('CP_MENU_HOTELS_MORE'); ?></a>

    </div><?php } ?>
    </div>
</div>
