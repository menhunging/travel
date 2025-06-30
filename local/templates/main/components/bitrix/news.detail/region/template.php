<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

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

<?php if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arResult["DETAIL_PICTURE"])) { ?>
    <picture class="picture">
        <img
            src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
            width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>"
            height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>"
            alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
            title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>">
    </picture>
<?php } ?>

<?php if ($arResult["PREVIEW_TEXT"] <> '' || $arResult["DETAIL_TEXT"] <> '') {
    if ($arResult["PREVIEW_TEXT"] == '') {
        $arResult["PREVIEW_TEXT"] = $arResult["DETAIL_TEXT"];
        $arResult["DETAIL_TEXT"] = '';
    }
    ?>
    <?php echo $arResult["PREVIEW_TEXT"]; ?>

    <?php if ($arResult["DETAIL_TEXT"] <> '') { ?>
        <div class="hidden-text">
            <?php echo $arResult["DETAIL_TEXT"]; ?>
        </div>
        <a href="javascript:;" class="btn btn-more-text">
            <?php echo Loc::getMessage('CP_REGION_MORE_TEXT'); ?>
        </a>
    <?php } ?>
<?php } ?>

<?php $this->SetViewTarget('country_gallery'); ?>
<?php if (isset($arResult['DISPLAY_PROPERTIES']['GALLERY'])) {
    if (count($arResult['DISPLAY_PROPERTIES']['GALLERY']['VALUE']) == 1) {
        $arResult['DISPLAY_PROPERTIES']['GALLERY']['FILE_VALUE'] = [$arResult['DISPLAY_PROPERTIES']['GALLERY']['FILE_VALUE']];
    }
    ?>
    <section class="country-gallery">
        <div class="container">
            <h2 class="caption caption--h2">
                <?php echo Loc::getMessage('CP_REGION_GALLERY'); ?>
            </h2>

            <div class="slider-gallery swiper">
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
                <div class="swiper-button-prev btn-arrow-circle btn-arrow-circle--left"></div>
                <div class="swiper-button-next btn-arrow-circle btn-arrow-circle--right"></div>
            </div>
        </div>
    </section>
<?php } ?>
<?php $this->EndViewTarget();
