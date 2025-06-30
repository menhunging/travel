<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use App\Helper\Site;

$this->setFrameMode(true);

if (!empty($arResult['NAV_RESULT'])) {
    $navParams = array(
        'NavPageCount' => $arResult['NAV_RESULT']->NavPageCount,
        'NavPageNomer' => $arResult['NAV_RESULT']->NavPageNomer,
        'NavNum' => $arResult['NAV_RESULT']->NavNum
    );
} else {
    $navParams = array(
        'NavPageCount' => 1,
        'NavPageNomer' => 1,
        'NavNum' => $this->randString()
    );
}

$showTopPager = false;
$showBottomPager = false;

if ($arParams['PAGE_ELEMENT_COUNT'] > 0 && $navParams['NavPageCount'] > 1) {
    $showTopPager = $arParams['DISPLAY_TOP_PAGER'];
    $showBottomPager = $arParams['DISPLAY_BOTTOM_PAGER'];
}

$elementEdit = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT');
$elementDelete = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE');
$elementDeleteParams = array('CONFIRM' => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));
?>

<?php if (!empty($arResult['ITEMS'])) { ?>
    <div class="hotels-block">
        <h3 class="caption caption--h3">
            <?php echo Loc::getMessage('CP_HOTEL_TITLE'); ?>
        </h3>

        <div class="hotels-block__list">
            <?php foreach ($arResult["ITEMS"] as $arItem) {
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $elementEdit);
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $elementDelete, $elementDeleteParams);
                ?>
                <div class="hotels-block__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <picture class="picture">
                        <a href="<?php echo $arItem["DETAIL_PAGE_URL"]; ?>"></a>
                        <?php if ($arItem["PREVIEW_PICTURE"]["ID"]) {
                            $file = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], array('width' => 305, 'height' => 377), BX_RESIZE_IMAGE_EXACT, true);
                            ?>
                            <img src="<?php echo $file["src"]; ?>"
                                 width="<?php echo $file["width"]; ?>"
                                 height="<?php echo $file["height"]; ?>"
                                 alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
                                 title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>">
                        <?php } ?>
                    </picture>

                    <?php if (isset($arItem['DISPLAY_PROPERTIES']['RATING'])) { ?>
                        <div class="rating-block">
                            <div class="rating" style="width: <?php echo ($arItem['DISPLAY_PROPERTIES']['RATING']['VALUE'] * 20); ?>%"></div>
                        </div>
                    <?php } ?>

                    <a href="<?php echo $arItem["DETAIL_PAGE_URL"]; ?>" class="hotels-block__link">
                        <?php echo $arItem["NAME"]; ?>
                    </a>

                    <?php if (
                        isset($arItem['DISPLAY_PROPERTIES']['COUNTRY'])
                        || isset($arItem['DISPLAY_PROPERTIES']['REGION'])
                    ) { ?>
                        <span class="hotels-block__country">
                            <?php echo implode(', ', array_filter([
                                $arItem['DISPLAY_PROPERTIES']['COUNTRY']['DISPLAY_VALUE'] ?? '',
                                $arItem['DISPLAY_PROPERTIES']['REGION']['DISPLAY_VALUE'] ?? '',
                            ], function ($item) {
                                return $item;
                            })); ?>
                        </span>
                    <?php } ?>

                    <?php if (isset($arItem['DISPLAY_PROPERTIES']['PRICE'])) { ?>
                        <span class="hotels-block__price">
                            <?php echo Loc::getMessage('CP_HOTEL_PRICE', ['#PRICE#' => Site::currencyFormat($arItem['DISPLAY_PROPERTIES']['PRICE']['VALUE'])]); ?>
                        </span>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>

        <?php if ($showBottomPager) { ?>
            <?php echo $arResult["NAV_STRING"]; ?>
        <?php } ?>
    </div>
<?php }
