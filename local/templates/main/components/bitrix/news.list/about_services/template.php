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
?>

<?php if (!empty($arResult["ITEMS"])) { ?>
    <section class="types-services">
        <div class="container">
            <?php if ($arResult["DESCRIPTION"]) { ?>
                <h2 class="caption caption--h2">
                    <?php echo $arResult["DESCRIPTION"]; ?>
                </h2>
            <?php } ?>
            <div class="types-services__slider swiper">
                <div class="types-services__list swiper-wrapper">
                    <?php foreach ($arResult["ITEMS"] as $arItem) { ?>
                        <?php
                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                        ?>
                        <div class="types-services__item swiper-slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                            <picture class="picture">
                                <?php if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])) {
                                    $file = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], array('width' => 506, 'height' => 602), BX_RESIZE_IMAGE_EXACT, true);
                                    ?>
                                    <img src="<?php echo $file["src"]; ?>"
                                         width="<?php echo $file["width"]; ?>"
                                         height="<?php echo $file["height"]; ?>"
                                         alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
                                         title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>">
                                <?php } ?>
                            </picture>
                            <div class="types-services__content">
                                <span class="types-services__name">
                                    <?php echo $arItem["NAME"]; ?>
                                </span>
                                <?php if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arItem["PREVIEW_TEXT"]) { ?>
                                    <p><?php echo $arItem["PREVIEW_TEXT"];?></p>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <button class="swiper-button-prev btn-arrow-circle btn-arrow-circle--left"></button>
                <button class="swiper-button-next btn-arrow-circle btn-arrow-circle--right"></button>
            </div>

        </div>
    </section>
<?php }
