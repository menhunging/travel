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

<div class="text-page__text">
    <?php echo $arResult["DETAIL_TEXT"]; ?>
    <a href="javascript:;" class="btn js-popup-opener" data-action="application" data-title="<?php echo Loc::getMessage('CM_AGENCIES_BTN_FORM'); ?>">
        <?php echo Loc::getMessage('CM_AGENCIES_BTN_FORM'); ?>
    </a>
</div>

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

<?php $this->SetViewTarget('agencies_files'); ?>
    <?php if (isset($arResult['DISPLAY_PROPERTIES']['FILES'])) {
        if (count($arResult['DISPLAY_PROPERTIES']['FILES']['VALUE']) == 1) {
            $arResult['DISPLAY_PROPERTIES']['FILES']['FILE_VALUE'] = [$arResult['DISPLAY_PROPERTIES']['FILES']['FILE_VALUE']];
        }
        ?>
        <div class="text-block">
            <div class="container">
                <div class="text-block__line">
                    <ol class="doc-list">
                        <?php foreach ($arResult['DISPLAY_PROPERTIES']['FILES']['FILE_VALUE'] as $file) {
                            $pathParts = pathinfo($file['ORIGINAL_NAME']);
                            ?>
                            <li data-file="<?php echo $pathParts['extension']; ?>">
                                <?php echo $file['DESCRIPTION'] ?: $pathParts['filename']; ?>
                                <a href="<?php echo $file['SRC']; ?>" download>
                                    <?php echo Loc::getMessage('CM_AGENCIES_DOWNLOAD'); ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ol>

                    <h3><?php echo Loc::getMessage('CM_AGENCIES_DOCS'); ?></h3>
                </div>
            </div>
        </div>
    <?php } ?>
<?php $this->EndViewTarget();
