<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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

$templateData = [
    'LINK_NEWS' => $arResult['LINK_NEWS'],
];
?>

<?php if ($arResult["DETAIL_TEXT"] <> '') { ?>
    <?php echo $arResult["DETAIL_TEXT"]; ?>
<?php } else { ?>
    <?php echo $arResult["PREVIEW_TEXT"]; ?>
<?php } ?>

<?php if (isset($arResult['DISPLAY_PROPERTIES']['GALLERY'])) {
    if (count($arResult['DISPLAY_PROPERTIES']['GALLERY']['VALUE']) == 1) {
        $arResult['DISPLAY_PROPERTIES']['GALLERY']['FILE_VALUE'] = [$arResult['DISPLAY_PROPERTIES']['GALLERY']['FILE_VALUE']];
    }
    ?>
    <div class="details-section__slider">
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
<?php }
