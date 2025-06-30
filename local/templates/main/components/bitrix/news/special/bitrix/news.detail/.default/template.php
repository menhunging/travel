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

<?php if (
    isset($arResult['DISPLAY_PROPERTIES']['GALLERY'])
    || isset($arResult['DISPLAY_PROPERTIES']['DISCOUNT'])
) { ?>
    <div class="details-section__slider">
        <?php if (isset($arResult['DISPLAY_PROPERTIES']['GALLERY'])) {
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
        <?php } ?>

        <?php if (isset($arResult['DISPLAY_PROPERTIES']['DISCOUNT'])) { ?>
            <span class="sale">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_1103_1939)">
                        <path
                            d="M12 0C5.4 0 0 5.4 0 12C0 18.6 5.4 24 12 24C18.6 24 24 18.6 24 12C24 5.4 18.6 0 12 0ZM8.196 6.06C9.372 6.06 10.32 7.008 10.32 8.196C10.32 9.372 9.372 10.32 8.196 10.32C7.008 10.32 6.06 9.372 6.06 8.196C6.06 7.008 7.008 6.06 8.196 6.06ZM15.864 18C14.688 18 13.74 17.04 13.74 15.864C13.74 14.688 14.688 13.74 15.864 13.74C17.04 13.74 18 14.688 18 15.864C18 17.04 17.04 18 15.864 18ZM7.8 18.036L6 16.236L16.236 6L18.036 7.8L7.8 18.036Z"
                            fill="white" />
                    </g>
                    <defs>
                        <clipPath id="clip0_1103_1939">
                            <rect width="24" height="24" fill="white" />
                        </clipPath>
                    </defs>
                </svg>
                <?php echo Loc::getMessage('CP_SPECIAL_DISCOUNT', ['#DISCOUNT#' => $arResult['DISPLAY_PROPERTIES']['DISCOUNT']['VALUE']]); ?>
            </span>
        <?php } ?>
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
                <?php echo Loc::getMessage('CP_SPECIAL_MORE_TEXT'); ?>
            </a>
        <?php } ?>
    </div>
<?php }
