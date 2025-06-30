<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Localization\Loc;

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<?php if (isset($arResult['DISPLAY_PROPERTIES']['RATING'])) { ?>
    <div class="rating-block">
        <div class="rating" style="width: <?php echo ($arResult['DISPLAY_PROPERTIES']['RATING']['VALUE'] * 20); ?>%"></div>
    </div>
<?php } ?>

<?php if (isset($arResult['DISPLAY_PROPERTIES']['GALLERY'])) { ?>
    <div class="details-section__slider">
        <?php
        if (count($arResult['DISPLAY_PROPERTIES']['GALLERY']['VALUE']) == 1) {
            $arResult['DISPLAY_PROPERTIES']['GALLERY']['FILE_VALUE'] = [$arResult['DISPLAY_PROPERTIES']['GALLERY']['FILE_VALUE']];
        }
        ?>
        <div class="slider-images-big swiper">
            <div class="swiper-wrapper">
                <?php foreach ($arResult['DISPLAY_PROPERTIES']['GALLERY']['FILE_VALUE'] as $file) { ?>
                    <div class="swiper-slide">
                        <picture class="picture">
                            <a href="<?php echo $file['SRC']; ?>" data-fancybox="foto"></a>
                            <img src="<?php echo $file['SRC']; ?>" alt="<?php echo $file['DESCRIPTION'] ?: $file['ORIGINAL_NAME']; ?>">
                        </picture>
                    </div>
                <?php } ?>
            </div>
            <button class="swiper-button-prev btn-arrow-circle btn-arrow-circle--left"></button>
            <button class="swiper-button-next btn-arrow-circle btn-arrow-circle--right"></button>
        </div>
        <div class="slider-images-small swiper">
            <div class="swiper-wrapper">
                <?php foreach ($arResult['DISPLAY_PROPERTIES']['GALLERY']['FILE_VALUE'] as $file) { ?>
                    <div class="swiper-slide">
                        <picture class="picture">
                            <a href="javascript:;"></a>
                            <img src="<?php echo $file['SRC']; ?>" alt="<?php echo $file['DESCRIPTION'] ?: $file['ORIGINAL_NAME']; ?>">
                        </picture>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($arResult["PREVIEW_TEXT"] <> '' || $arResult["DETAIL_TEXT"] <> '') {
    if ($arResult["PREVIEW_TEXT"] == '') {
        $arResult["PREVIEW_TEXT"] = $arResult["DETAIL_TEXT"];
        $arResult["DETAIL_TEXT"] = '';
    }
    ?>
    <div class="text-simple">
        <?php echo $arResult["PREVIEW_TEXT"]; ?>

        <?php if ($arResult["DETAIL_TEXT"] <> '') { ?>
            <div class="hidden-text">
                <?php echo $arResult["DETAIL_TEXT"]; ?>
            </div>
            <a href="javascript:;" class="btn btn-more-text">
                <?php echo Loc::getMessage('CP_PROGRAMS_MORE_TEXT'); ?>
            </a>
        <?php } ?>
    </div>
<?php } ?>

<?php if (isset($arResult['DISPLAY_PROPERTIES']['PROGRAM'])) {
    if (count($arResult['DISPLAY_PROPERTIES']['PROGRAM']['VALUE']) == 1) {
        $arResult['DISPLAY_PROPERTIES']['PROGRAM']['DISPLAY_VALUE'] = [$arResult['DISPLAY_PROPERTIES']['PROGRAM']['DISPLAY_VALUE']];
    }
    ?>
    <div class="tabs">
        <a href="javascript:;" class="tabs-arrow tabs-arrow--left btn-arrow btn-arrow--left"></a>
        <a href="javascript:;" class="tabs-arrow tabs-arrow--right btn-arrow btn-arrow--right"></a>

        <ul class="tabs-links">
            <?php foreach ($arResult['DISPLAY_PROPERTIES']['PROGRAM']['DISPLAY_VALUE'] as $key => $value) {
                $day = $arResult['DISPLAY_PROPERTIES']['PROGRAM']['DESCRIPTION'][$key];
                ?>
                <li>
                    <a href="#tab<?php echo $key; ?>" class="tabs-link">
                        <?php echo $day; ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
        <?php foreach ($arResult['DISPLAY_PROPERTIES']['PROGRAM']['DISPLAY_VALUE'] as $key => $value) { ?>
            <div class="tabs-body" id="tab<?php echo $key; ?>">
                <div class="text-simple">
                    <?php echo $value; ?>
                </div>
            </div>
        <?php } ?>
    </div>

    <div class="tabs-mobile">
        <?php foreach ($arResult['DISPLAY_PROPERTIES']['PROGRAM']['DISPLAY_VALUE'] as $key => $value) {
            $day = $arResult['DISPLAY_PROPERTIES']['PROGRAM']['DESCRIPTION'][$key];
            ?>
            <div class="tabs-mobile__item">
                <span class="head">
                    <?php echo $day; ?>
                </span>
                <div class="body">
                    <div class="text-simple">
                        <?php echo $value; ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
<?php }
