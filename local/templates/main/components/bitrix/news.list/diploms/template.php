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
	
	<div class="teams-new__right">
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
        <div class="our-awards">
        	
            
            <?foreach($arResult["ITEMS"] as $key => $arItem):?>
	        	<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
				<div class="our-awards__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
	                <div class="picture-block">
	                    <picture>
	                        <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="">
	                    </picture>
	                </div>
	            </div>
            <?endforeach;?>
        </div>
    </div>
	
<?endif;?>