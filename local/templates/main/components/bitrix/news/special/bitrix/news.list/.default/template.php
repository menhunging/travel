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

<?php if (!empty($arResult["ITEMS"])) { ?>
    <div class="slider-default__list">
        <?php foreach ($arResult["ITEMS"] as $arItem) { ?>
            <?php
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="slider-default__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <a href="<?php echo $arItem["DETAIL_PAGE_URL"]; ?>"></a>
                <picture class="picture">
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
                    <?php if (isset($arItem['DISPLAY_PROPERTIES']['PRICE'])) { ?>
                        <span class="slider-default__price">
                            <?php echo Loc::getMessage('CP_SPECIAL_PRICE', ['#PRICE#' => Site::currencyFormat($arItem['DISPLAY_PROPERTIES']['PRICE']['VALUE'])]); ?>
                        </span>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
<?php } ?>

<?php if ($arParams["DISPLAY_BOTTOM_PAGER"]) { ?>
    <?php echo $arResult["NAV_STRING"]; ?>
<?php }
