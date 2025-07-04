<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
    <div class="footer-col__content">
        <div class="social">
            <ul>
                <?php foreach ($arResult["ITEMS"] as $arItem) { ?>
                    <?php
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <li id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                        <a href="<?php echo $arItem['DISPLAY_PROPERTIES']['LINK']['VALUE']; ?>"
                           target="_blank"
                           class="social-link icon-<?php echo $arItem['PROPERTIES']['CLASS']['VALUE']; ?>">
                            <span class="social-link__text"><?php echo $arItem['NAME']; ?></span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
<?php }
