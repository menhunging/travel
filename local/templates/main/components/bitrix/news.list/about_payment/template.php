<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

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

<?php if (!empty($arResult["ITEMS"])) { ?>
    <section class="payment-methods">
        <div class="container">
            <diov class="payment-methods__content">
                <div class="payment-methods__top">
                    <h3 class="caption caption--h3">
                        <?php echo Loc::getMessage('CP_ABOUT_PAYMENT_TITLE'); ?>
                    </h3>
                    <div class="payment-methods__list">
                        <?php foreach ($arResult["ITEMS"] as $arItem) { ?>
                            <?php
                            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                            ?>
                            <div class="payment-methods__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                                <?php if (isset($arItem['DISPLAY_PROPERTIES']['ICON'])) { ?>
                                    <picture class="picture">
                                        <img src="<?php echo $arItem['DISPLAY_PROPERTIES']['ICON']['FILE_VALUE']['SRC']; ?>" alt="<?php echo $arItem["NAME"]; ?>">
                                    </picture>
                                <?php } ?>

                                <div class="payment-methods__text">
                                    <span class="payment-methods__name">
                                        <?php echo $arItem["NAME"]; ?>
                                    </span>
                                    <?php if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arItem["PREVIEW_TEXT"]) { ?>
                                        <p><?php echo $arItem["PREVIEW_TEXT"];?></p>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <?php if ($arResult["DESCRIPTION"]) { ?>
                    <div class="payment-methods__bottom">
                        <?php echo $arResult["DESCRIPTION"];?>
                    </div>
                <?php } ?>
            </diov>
        </div>
    </section>
<?php }
