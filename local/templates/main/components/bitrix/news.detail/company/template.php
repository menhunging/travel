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

<div class="text-page__text">
    <?=$arResult["PREVIEW_TEXT"]; ?>
    <div class="more-block"><?=$arResult["DETAIL_TEXT"]; ?></div>
    <a href="#" class="btn more-block-btn">Читать полностью</a>
</div>

<div class="quote-boss">
    <div class="boss">
        <div class="boss-media">
        	<?if($arResult['PROPERTIES']['BOSS_PHOTO']['VALUE']):?>
        		<?
        			$file = \CFile::ResizeImageGet($arResult['DISPLAY_PROPERTIES']['BOSS_PHOTO']['FILE_VALUE']['ID'], array('width' => 120, 'height' => 140), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                ?>
	            <picture class="picture pic-boss">
	                <img src="<?php echo $file['src']; ?>" alt="<?php echo $arResult['DISPLAY_PROPERTIES']['BOSS']['DISPLAY_VALUE'] ?? ''; ?>">
	            </picture>
            <?endif;?>
            <?/*<picture class="picture pic-bg">
                <source type="image/webp" srcset="../../img/pic-boss.webp">
                <img src="../../img/pic-boss.jpg" alt="">
            </picture>*/?>
        </div>
        <div class="boss__content">
            <span class="boss__name"><?=$arResult['PROPERTIES']['BOSS']['VALUE']?></span>
            <span class="boss__desc"><?=$arResult['PROPERTIES']['BOSS_POST']['VALUE']?></span>
            <?if($arResult['PROPERTIES']['BOSS_LINK']['VALUE']):?>
           	 <a href="<?=$arResult['PROPERTIES']['BOSS_LINK']['VALUE']?>" class="link link--arrow">Связаться</a>
            <?endif;?>
        </div>
    </div>
    <p>
        <?=$arResult['PROPERTIES']['BOSS_TEXT']['VALUE']?>
    </p>
</div>
