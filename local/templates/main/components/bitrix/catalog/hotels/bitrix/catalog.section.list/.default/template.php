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

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));
?>

<div class="hotels">
    <div class="container">
        <div class="hotels-list">
            <?php foreach ($arResult["LETTER"] as $letter) {
                $arItems = array_filter($arResult['SECTIONS'], function($item) use ($letter) {
                    $char = mb_substr($item['NAME'], 0, 1);
                    return $char == $letter;
                });
                ?>
                <div class="hotels-item">
                    <span class="letter"><?php echo $letter; ?></span>
                    <ul class="hotels__list">
                        <?php foreach ($arItems as $arSection) {
                            $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
                            $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
                            ?>
                            <li id="<?php echo $this->GetEditAreaId($arSection['ID']); ?>">
                                <a href="<?php echo $arSection['SECTION_PAGE_URL']; ?>">
                                    <?php echo $arSection['NAME']; ?>
                                </a>
                                <?php if (is_array($arSection['PICTURE'])) { ?>
                                    <picture class="picture">
                                        <img src="<?php echo $arSection['PICTURE']['SRC']; ?>" alt="<?php echo $arSection['PICTURE']['NAME']; ?>" />
                                    </picture>
                                <?php } ?>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
