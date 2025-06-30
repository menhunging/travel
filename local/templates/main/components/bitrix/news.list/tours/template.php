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
    <div class="exlusive-programs">
        <?php foreach ($arResult["ITEMS"] as $arItem) { ?>
            <?php
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="exlusive-programs__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <picture class="picture">
                    <a href="<?php echo $arItem["DETAIL_PAGE_URL"]; ?>"></a>
                    <?php if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])) {
                        $file = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], array('width' => 300, 'height' => 300), BX_RESIZE_IMAGE_EXACT, true);
                        ?>
                        <img src="<?php echo $file["src"]; ?>"
                             width="<?php echo $file["width"]; ?>"
                             height="<?php echo $file["height"]; ?>"
                             alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
                             title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>">
                    <?php } ?>
                </picture>
                <a href="<?php echo $arItem["DETAIL_PAGE_URL"]; ?>" class="exlusive-programs__link">
                    <?php echo $arItem["NAME"]; ?>
                </a>
                <?php if (isset($arItem['DISPLAY_PROPERTIES']['TEXT'])) { ?>
                    <p><?php echo $arItem['DISPLAY_PROPERTIES']['TEXT']['DISPLAY_VALUE']; ?></p>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
<?php } ?>

<?php if ($arParams["DISPLAY_BOTTOM_PAGER"]) { ?>
    <?php echo $arResult["NAV_STRING"]; ?>
<?php }
