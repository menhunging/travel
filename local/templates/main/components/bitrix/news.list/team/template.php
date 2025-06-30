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

<?if($arResult["ITEMS"]):?>
	
	<div class="teams-new__left">
        <h2 class="caption caption--h3">
        	<?
					$APPLICATION->IncludeComponent(
					    "bitrix:main.include",
					    "",
					    array(
					        "AREA_FILE_SHOW" => "file",
					        "PATH" => $templateFolder."/title.php"
					    ),
					    false,
					    array(
				            "HIDE_ICONS" => "N"
				        )
					);
				?>
		</h2>
        <div class="teams-new__list">
            <?foreach($arResult["ITEMS"] as $key => $arItem):?>
	        	<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
	            <div 
	            	<?if($arParams["SHOW_VISIBLE"] && $key >= $arParams["SHOW_VISIBLE"]):?>style="display: none;"<?endif;?>
	            	class="teams-new__item <?if($arItem['PROPERTIES']['HIGHLIGHT']['VALUE']):?>teams-new__item--people<?endif;?>" 
	            	id="<?=$this->GetEditAreaId($arItem['ID']);?>">
	                <div class="picture-block">
	                    <picture>
	                    	<?if($arItem["PREVIEW_PICTURE"]):?>
	                        	<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="">
	                        <?else:?>
	                        	<img src="<?=SITE_TEMPLATE_PATH?>/img/picteam0.png" alt="">
	                        <?endif;?>
	                    </picture>
	                </div>
	                <div class="teams-new__content">
	                    <span class="teams-new__name"><?=$arItem["NAME"]?></span>
	                    <p><?=$arItem["~PREVIEW_TEXT"]?></p>
	                    <?if($arItem['PROPERTIES']['EMAIL']['VALUE']):?>
	                    	<a href="mailto:<?=$arItem['PROPERTIES']['EMAIL']['VALUE']?>"><?=$arItem['PROPERTIES']['EMAIL']['VALUE']?></a>
	                    <?endif;?>
	                </div>
	            </div>
            <?endforeach;?>
            
        </div>
        <?if($arParams["SHOW_VISIBLE"] && count($arResult["ITEMS"]) > $arParams["SHOW_VISIBLE"]):?>
        	<a href="#" class="btn more-team-btn">Показать полностью</a>
        <?endif;?>
    </div>
<?endif;?>