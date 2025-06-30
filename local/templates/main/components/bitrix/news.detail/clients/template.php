<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

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

<?php if ($arResult["DETAIL_TEXT"] <> 0) { ?>
    <div class="text-page__text">
        <?php echo $arResult["DETAIL_TEXT"]; ?>
    </div>
<?php } ?>

<div class="text-block corporative-clients-block">
    <?php echo $arResult["PREVIEW_TEXT"]; ?>

    <a href="javascript:;" class="btn js-popup-opener" data-action="application">
        <?php echo Loc::getMessage('CM_CLIENTS_BTN_FORM'); ?>
        <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
             xmlns="http://www.w3.org/2000/svg">
            <path
                d="M8.73281 0.560003C9.09191 0.201033 9.57891 -0.000582021 10.0867 -0.000488249C10.5944 -0.000394477 11.0813 0.2014 11.4403 0.560503C11.7993 0.919606 12.0009 1.4066 12.0008 1.91436C12.0007 2.42211 11.7989 2.90903 11.4398 3.268L10.7068 4L10.9698 4.262C11.1323 4.42451 11.2612 4.61743 11.3492 4.82977C11.4372 5.0421 11.4824 5.26967 11.4824 5.4995C11.4824 5.72933 11.4372 5.95691 11.3492 6.16924C11.2612 6.38157 11.1323 6.5745 10.9698 6.737L9.85381 7.853C9.76005 7.94689 9.63284 7.99969 9.50016 7.99978C9.36748 7.99988 9.24019 7.94726 9.14631 7.8535C9.05242 7.75975 8.99962 7.63254 8.99953 7.49986C8.99943 7.36717 9.05205 7.23989 9.14581 7.146L10.2628 6.03C10.3325 5.96035 10.3878 5.87765 10.4255 5.78663C10.4632 5.6956 10.4826 5.59803 10.4826 5.4995C10.4826 5.40097 10.4632 5.30341 10.4255 5.21238C10.3878 5.12135 10.3325 5.03865 10.2628 4.969L9.99981 4.708L4.04481 10.662C3.86393 10.8428 3.64345 10.9791 3.40081 11.06L0.657806 11.975C0.569685 12.0043 0.475142 12.0085 0.384773 11.9871C0.294405 11.9657 0.211783 11.9196 0.146167 11.8538C0.0805516 11.7881 0.0345356 11.7054 0.0132768 11.615C-0.00798204 11.5246 -0.00364357 11.4301 0.0258059 11.342L0.939806 8.6C1.02077 8.35739 1.15702 8.13692 1.33781 7.956L8.73281 0.560003Z"
                fill="white"></path>
        </svg>
    </a>
</div>

<?php $this->SetViewTarget('clients_gallery'); ?>
    <?php if (isset($arResult['DISPLAY_PROPERTIES']['GALLERY'])) {
        if (count($arResult['DISPLAY_PROPERTIES']['GALLERY']['VALUE']) == 1) {
            $arResult['DISPLAY_PROPERTIES']['GALLERY']['FILE_VALUE'] = [$arResult['DISPLAY_PROPERTIES']['GALLERY']['FILE_VALUE']];
        }
        ?>
        <div class="portfolio-events">
            <div class="container">
                <?php if (isset($arResult['DISPLAY_PROPERTIES']['GALLERY_TITLE'])) { ?>
                    <h2 class="caption caption--h2">
                        <?php echo $arResult['DISPLAY_PROPERTIES']['GALLERY_TITLE']['DISPLAY_VALUE']; ?>
                    </h2>
                <?php } ?>

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
            </div>
        </div>
    <?php } ?>
<?php $this->EndViewTarget();
