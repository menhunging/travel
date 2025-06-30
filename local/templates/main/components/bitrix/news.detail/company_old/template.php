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

<?php if ($arResult["DETAIL_TEXT"] <> '') { ?>
    <div class="text-page__text">
        <?php echo $arResult["DETAIL_TEXT"]; ?>
    </div>
<?php } ?>

<?php $this->SetViewTarget('teams'); ?>
    <section class="teams">
        <div class="container">
            <div class="teams__head">
                <?php if (isset($arResult['DISPLAY_PROPERTIES']['TEAMS_TITLE'])) { ?>
                    <h2 class="caption caption--h2">
                        <?php echo $arResult['DISPLAY_PROPERTIES']['TEAMS_TITLE']['DISPLAY_VALUE']; ?>
                    </h2>
                <?php } ?>
                <?php if (isset($arResult['DISPLAY_PROPERTIES']['TEAMS_TEXT'])) { ?>
                    <div class="teams__text">
                        <?php echo $arResult['DISPLAY_PROPERTIES']['TEAMS_TEXT']['DISPLAY_VALUE']; ?>
                    </div>
                <?php } ?>
                <div class="boss">
                    <?php if (isset($arResult['DISPLAY_PROPERTIES']['BOSS_PHOTO'])) {
                        $file = \CFile::ResizeImageGet($arResult['DISPLAY_PROPERTIES']['BOSS_PHOTO']['FILE_VALUE']['ID'], array('width' => 120, 'height' => 140), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                        ?>
                        <picture class="picture pic-boss">
                            <img src="<?php echo $file['src']; ?>"
                                 width="<?= $file['width'] ?>"
                                 height="<?= $file['height'] ?>"
                                 alt="<?php echo $arResult['DISPLAY_PROPERTIES']['BOSS']['DISPLAY_VALUE'] ?? ''; ?>">
                        </picture>
                    <?php } ?>
                    <?/*?>
                    <div class="boss__content">
                        <?php if (isset($arResult['DISPLAY_PROPERTIES']['BOSS'])) { ?>
                            <span class="boss__name">
                                <?php echo $arResult['DISPLAY_PROPERTIES']['BOSS']['DISPLAY_VALUE']; ?>
                            </span>
                        <?php } ?>
                        <?php if (isset($arResult['DISPLAY_PROPERTIES']['BOSS_TEXT'])) { ?>
                            <span class="boss__desc">
                                <?php echo $arResult['DISPLAY_PROPERTIES']['BOSS_TEXT']['DISPLAY_VALUE']; ?>
                            </span>
                        <?php } ?>
                        <a href="javascript:;" class="link link--arrow">
                            <?php echo Loc::getMessage('CP_COMPANY_BTN_FORM'); ?>
                        </a>
                    </div>
<?*/?>
                </div>
            </div>
            <?php if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arResult["DETAIL_PICTURE"])) { ?>
                <div class="teams__body">
                    <picture class="picture">
                        <img
                            src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>"
                            width="<?= $arResult["DETAIL_PICTURE"]["WIDTH"] ?>"
                            height="<?= $arResult["DETAIL_PICTURE"]["HEIGHT"] ?>"
                            alt="<?= $arResult["DETAIL_PICTURE"]["ALT"] ?>">
                    </picture>
                </div>
            <?php } ?>
        </div>
    </section>
<?php $this->EndViewTarget();
