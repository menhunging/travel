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
    <div class="our-values">
        <?php if ($arResult["DESCRIPTION"]) { ?>
            <?php echo $arResult["DESCRIPTION"]; ?>
        <?php } ?>
        <ul>
            <?php foreach ($arResult["ITEMS"] as $arItem) { ?>
                <?php
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <li id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <?php if (isset($arItem['DISPLAY_PROPERTIES']['ICON'])) { ?>
                        <picture class="picture">
                            <img src="<?php echo $arItem['DISPLAY_PROPERTIES']['ICON']['FILE_VALUE']['SRC']; ?>" alt="<?php echo $arItem["NAME"]; ?>">
                        </picture>
                    <?php } ?>
                    <div class="our-values__text">
                        <span class="our-values__title">
                            <?php echo $arItem["NAME"]; ?>
                        </span>
                        <?php if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arItem["PREVIEW_TEXT"]) { ?>
                            <p><?php echo $arItem["PREVIEW_TEXT"];?></p>
                        <?php } ?>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>
<?php }
