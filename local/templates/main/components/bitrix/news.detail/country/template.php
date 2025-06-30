<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use App\Helper\Site;

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

<?php echo $arResult["PREVIEW_TEXT"]; ?>

<?php if (
    isset($arResult['DISPLAY_PROPERTIES']['NOTIFICATION_TITLE'])
    && isset($arResult['DISPLAY_PROPERTIES']['NOTIFICATION_TEXT'])
) { ?>
    <div class="visa-block">
        <h4 class="caption caption--h4">
            <?php echo $arResult['DISPLAY_PROPERTIES']['NOTIFICATION_TITLE']['DISPLAY_VALUE']; ?>
        </h4>
        <p>
            <?php echo $arResult['DISPLAY_PROPERTIES']['NOTIFICATION_TEXT']['DISPLAY_VALUE']; ?>
        </p>
    </div>
<?php } ?>

<?php if (!empty($arResult['TRANSFERS'])) { ?>
    <div class="transfers-block">
        <h3 class="caption caption--h3">
            <?php echo Loc::getMessage('CP_COUNTRY_TRANSFERS_TITLE'); ?>
        </h3>
        <div class="transfers-list">
            <?php foreach ($arResult['TRANSFERS']['SECTION'] as $sectionId => $section) { ?>
                <div class="transfers-item">
                    <div class="transfers-item__head">
                        <?php echo $section['NAME']; ?>
                    </div>
                    <div class="transfers-item__body">
                        <div class="table-wrapper">
                            <div class="table">
                                <div class="thead">
                                    <div class="tr">
                                        <div class="th">
                                            <?php echo $section['UF_AIRPORT'] ?? ''; ?>
                                        </div>
                                        <div class="th">
                                            <?php echo Loc::getMessage('CP_COUNTRY_TRANSFERS_NUMBER'); ?>
                                        </div>
                                        <div class="th">
                                            <?php echo Loc::getMessage('CP_COUNTRY_TRANSFERS_PRICE'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="tbody">
                                    <?php foreach ($arResult['TRANSFERS']['ITEMS'] as $item) {
                                        if ($item['IBLOCK_SECTION_ID'] != $sectionId) {
                                            continue;
                                        }
                                        ?>
                                        <div class="tr">
                                            <div class="td">
                                                <span class="table-title-mobile">
                                                    <?php echo $section['UF_AIRPORT'] ?? ''; ?>
                                                </span>
                                                <?php echo $item['NAME']; ?>
                                            </div>
                                            <div class="td">
                                                <div class="table__count">
                                                    <?php if (isset($item['DISPLAY_PROPERTIES']['PRICE_LIST'])) {
                                                        if (count($item['DISPLAY_PROPERTIES']['PRICE_LIST']['VALUE']) == 1) {
                                                            $item['DISPLAY_PROPERTIES']['PRICE_LIST']['DISPLAY_VALUE'] = [$item['DISPLAY_PROPERTIES']['PRICE_LIST']['DISPLAY_VALUE']];
                                                        }
                                                        ?>
                                                        <?php foreach ($item['DISPLAY_PROPERTIES']['PRICE_LIST']['DISPLAY_VALUE'] as $value) { ?>
                                                            <span class="table-title-mobile">
                                                                <?php echo Loc::getMessage('CP_COUNTRY_TRANSFERS_NUMBER'); ?>
                                                            </span>
                                                            <span>
                                                                <?php echo $value; ?>
                                                            </span>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="td">
                                                <div class="table__price">
                                                    <?php if (isset($item['DISPLAY_PROPERTIES']['PRICE_LIST'])) { ?>
                                                        <?php foreach ($item['DISPLAY_PROPERTIES']['PRICE_LIST']['DISPLAY_VALUE'] as $key => $value) { ?>
                                                            <span class="table-title-mobile">
                                                                <?php echo Loc::getMessage('CP_COUNTRY_TRANSFERS_PRICE'); ?>
                                                            </span>
                                                            <span>
                                                                <?php echo $item['DISPLAY_PROPERTIES']['PRICE_LIST']['DESCRIPTION'][$key]
                                                                    ? Site::currencyFormat($item['DISPLAY_PROPERTIES']['PRICE_LIST']['DESCRIPTION'][$key])
                                                                    : Loc::getMessage('CP_COUNTRY_TRANSFERS_PRICE_EMPTY'); ?>
                                                            </span>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>

<?php echo $arResult["DETAIL_TEXT"]; ?>

<?php $this->SetViewTarget('country_gallery'); ?>
    <?php if (isset($arResult['DISPLAY_PROPERTIES']['GALLERY'])) {
        if (count($arResult['DISPLAY_PROPERTIES']['GALLERY']['VALUE']) == 1) {
            $arResult['DISPLAY_PROPERTIES']['GALLERY']['FILE_VALUE'] = [$arResult['DISPLAY_PROPERTIES']['GALLERY']['FILE_VALUE']];
        }
        ?>
        <section class="country-gallery">
            <div class="container">
                <h2 class="caption caption--h2">
                    <?php echo Loc::getMessage('CP_COUNTRY_GALLERY'); ?>
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
