<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Type\DateTime;
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

<?php if (!empty($arResult["ITEMS"])) { ?>
    <section class="slider-section">
        <div class="container">
            <div class="slider-section__head">
                <h2 class="caption caption--h2">
                    <?php Site::includeArea(SITE_DIR . "include/pages/exclusive_programs_front.php"); ?>
                </h2>
                <a href="/exclusive-programs/" class="link link--arrow">
                    <?php Site::includeArea(SITE_DIR . "include/pages/exclusive_programs_front_more.php"); ?>
                </a>
            </div>
            <div class="slider-section__body">
                <div class="slider-default swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($arResult["ITEMS"] as $arItem) { ?>
                            <?php
                            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                            ?>
                            <div class="swiper-slide">
                                <div class="slider-default__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                                    <a href="<?php echo $arItem["DETAIL_PAGE_URL"]; ?>"></a>
                                    <picture class="picture">
                                        <?php if ($arParams["DISPLAY_DATE"] != "N" && $arItem["DISPLAY_ACTIVE_FROM"]) {
                                            $objDateTime = new DateTime($arItem["ACTIVE_FROM"]);
                                            ?>
                                            <div class="date">
                                                <span class="day"><?php echo $objDateTime->format("d"); ?> <span class="mon"><?php echo $objDateTime->format("m.y"); ?></span></span>
                                            </div>
                                        <?php } ?>
                                        <?php if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])) {
                                            $file = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], array('width' => 307, 'height' => 362), BX_RESIZE_IMAGE_EXACT, true);
                                            ?>
                                            <img src="<?php echo $file["src"]; ?>"
                                                 width="<?php echo $file["width"]; ?>"
                                                 height="<?php echo $file["height"]; ?>"
                                                 alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
                                                 title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>">
                                        <?php } ?>
                                    </picture>
                                    <div class="slider-default__content">
                                        <a href="<?php echo $arItem["DETAIL_PAGE_URL"]; ?>" class="slider-default__link">
                                            <?php echo $arItem["NAME"]; ?>
                                        </a>
                                        <?php if (isset($arItem['DISPLAY_PROPERTIES']['TEXT'])) { ?>
                                            <p><?php echo $arItem['DISPLAY_PROPERTIES']['TEXT']['DISPLAY_VALUE']; ?></p>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="swiper-pagination"></div>
                    <button class="swiper-button-prev btn-arrow-circle btn-arrow-circle--left"></button>
                    <button class="swiper-button-next btn-arrow-circle btn-arrow-circle--right"></button>
                </div>
            </div>
        </div>
    </section>
<?php }
