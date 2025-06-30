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

<style>
	.followind-block .followind-block__inner::before {
	    background-image: url(<?=$arResult["DETAIL_PICTURE"]["SRC"]?>);
	}
	
	.followind-block .followind-block__inner::after {
	    background-image: url(<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>);
	}
</style>

<div class="container">
    <div class="followind-block__inner">
        <h2 class="caption caption--h4"><?=$arResult["NAME"];?></h2>
  
        <div class="followind-block__list">
            <div class="followind-block__item">
               <span class="followind-block__tit">Позвоните по телефону:</span>
                <a href="tel:<?=$arResult['PROPERTIES']['PHONE']['VALUE']?>" class="phone"><?=$arResult['PROPERTIES']['PHONE']['VALUE']?></a>
            </div>

            <div class="followind-block__item">
                <span class="followind-block__tit">Напишите на электронную почту</span>
                 <a href="mailto:<?=$arResult['PROPERTIES']['EMAIL']['VALUE']?>" class="mail"><?=$arResult['PROPERTIES']['EMAIL']['VALUE']?></a>
             </div>
			
			 <?if($arResult['PROPERTIES']['FORM']['VALUE']):?>
	             <div class="followind-block__item">
	                <span class="followind-block__tit">Заполните форму обратной связи</span>
	                 <a href="javascript:;" class="link btn-arrow--right js-popup-opener" data-action="<?=$arResult['PROPERTIES']['FORM']['VALUE']?>">Заполнить форму</a>
	             </div>
             <?endif;?>
        </div>
		
		<?if($arResult['PROPERTIES']['LINK']['VALUE']):?>
       	 <div class="followind-block__bottom">
            <span>Договор комплексного обслуживания:</span>
            <a href="<?=CFile::GetPath($arResult['PROPERTIES']['LINK']['VALUE'])?>" class="btn" download="">Скачать</a>
        </div>
        <?endif;?>
		
        
    </div>
</div>
