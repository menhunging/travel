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
    <?php foreach ($arResult["ITEMS"] as $arItem) { ?>
        <?php
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <section class="grettings" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <?php if (isset($arItem['DISPLAY_PROPERTIES']['VIDEO'])) { ?>
                <video width="100%" height="100%" loop autoplay playsinline muted>
                    <source src="<?php echo $arItem['DISPLAY_PROPERTIES']['VIDEO']['FILE_VALUE']['SRC']; ?>" type="video/mp4" />
                </video>
            <?php } else { ?>
                <picture class="picture">
                    <?php if (is_array($arItem["PREVIEW_PICTURE"])) { ?>
                        <source media="(max-width: 767px)" srcset="<?php echo $arItem["PREVIEW_PICTURE"]["SRC"]; ?>"/>
                    <?php } ?>
                    <?php if (is_array($arItem["DETAIL_PICTURE"])) { ?>
                        <img src="<?php echo $arItem["DETAIL_PICTURE"]["SRC"]; ?>"
                             width="<?php echo $arItem["DETAIL_PICTURE"]["WIDTH"]; ?>"
                             height="<?php echo $arItem["DETAIL_PICTURE"]["HEIGHT"]; ?>"
                             alt="<?=$arItem["DETAIL_PICTURE"]["ALT"]?>">
                    <?php } ?>
                </picture>
            <?php } ?>
        </section>
    <?php } ?>
<?php }
