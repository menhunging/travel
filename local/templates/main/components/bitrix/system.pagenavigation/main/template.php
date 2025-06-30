<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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

if (!$arResult["NavShowAlways"]) {
    if (0 == $arResult["NavRecordCount"] || (1 == $arResult["NavPageCount"] && false == $arResult["NavShowAll"]))
        return;
}
if ('' != $arResult["NavTitle"])
    $arResult["NavTitle"] .= ' ';
?>

<ul class="pagination">
    <?
    if (true === $arResult["bDescPageNumbering"]) {
        ?>
        <li class="pagination__arrow"><?
        if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]) {
            ?><a class="btn-arrow btn-arrow--left"
            href="<?= $arResult['sUrlPathParams']; ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>"></a><?
        } else {
            ?><a class="btn-arrow btn-arrow--left" href="javascript:;"></a><?
        }
        ?></li><?
        $NavRecordGroup = $arResult["NavPageCount"];
        while ($NavRecordGroup >= 1) {
            $NavRecordGroupPrint = $arResult["NavPageCount"] - $NavRecordGroup + 1;
            $strTitle = GetMessage(
                'nav_page_num_title',
                array('#NUM#' => $NavRecordGroupPrint)
            );
            if ($NavRecordGroup == $arResult["NavPageNomer"]) {
                ?>
                <li>
                <a class="pagination__link active" href="javascript:;"
                   title="<? echo GetMessage('nav_page_current_title'); ?>"><? echo $NavRecordGroupPrint; ?></a></li><?
            } elseif ($NavRecordGroup == $arResult["NavPageCount"] && $arResult["bSavePage"] == false) {
                ?>
                <li>
                <a class="pagination__link" href="<?= $arResult['sUrlPathParams']; ?>"
                   title="<? echo $strTitle; ?>"><?= $NavRecordGroupPrint ?></a></li><?
            } else {
                ?>
                <li>
                <a class="pagination__link" href="<?= $arResult['sUrlPathParams']; ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $NavRecordGroup ?>"
                   title="<? echo $strTitle; ?>"><?= $NavRecordGroupPrint ?></a></li><?
            }
            if (1 == ($arResult["NavPageCount"] - $NavRecordGroup) && 2 < ($arResult["NavPageCount"] - $arResult["nStartPage"])) {
                $middlePage = floor(($arResult["nStartPage"] + $NavRecordGroup) / 2);
                $NavRecordGroupPrint = $arResult["NavPageCount"] - $middlePage + 1;
                $strTitle = GetMessage(
                    'nav_page_num_title',
                    array('#NUM#' => $NavRecordGroupPrint)
                );
                ?>
                <li>
                <a class="pagination__toh" href="<?= $arResult['sUrlPathParams']; ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $middlePage ?>"
                   title="<? echo $strTitle; ?>">...</a></li><?
                $NavRecordGroup = $arResult["nStartPage"];
            } elseif ($NavRecordGroup == $arResult["nEndPage"] && 3 < $arResult["nEndPage"]) {
                $middlePage = ceil(($arResult["nEndPage"] + 2) / 2);
                $NavRecordGroupPrint = $arResult["NavPageCount"] - $middlePage + 1;
                $strTitle = GetMessage(
                    'nav_page_num_title',
                    array('#NUM#' => $NavRecordGroupPrint)
                );
                ?>
                <li>
                <a class="pagination__toh" href="<?= $arResult['sUrlPathParams']; ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $middlePage ?>"
                   title="<? echo $strTitle; ?>">...</a></li><?
                $NavRecordGroup = 2;
            } else {
                $NavRecordGroup--;
            }
        }
        ?>
        <li class="pagination__arrow"><?
        if ($arResult["NavPageNomer"] > 1) {
            ?><a class="btn-arrow btn-arrow--right"
            href="<?= $arResult['sUrlPathParams']; ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>"></a><?
        } else {
            ?><a class="btn-arrow btn-arrow--right" href="javascript:;"></a><?
        }
        ?></li><?
    } else {
        ?>
        <li class="pagination__arrow"><?
        if (1 < $arResult["NavPageNomer"]) {
            ?><a class="btn-arrow btn-arrow--left"
            href="<?= $arResult['sUrlPathParams']; ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>"></a><?
        } else {
            ?><a class="btn-arrow btn-arrow--left" href="javascript:;"></a><?
        }
        ?></li><?
        $NavRecordGroup = 1;
        while ($NavRecordGroup <= $arResult["NavPageCount"]) {
            $strTitle = GetMessage(
                'nav_page_num_title',
                array('#NUM#' => $NavRecordGroup)
            );
            if ($NavRecordGroup == $arResult["NavPageNomer"]) {
                ?>
                <li>
                <a class="pagination__link active" href="javascript:;"
                   title="<? echo GetMessage('nav_page_current_title'); ?>"><? echo $NavRecordGroup; ?></a></li><?
            } elseif ($NavRecordGroup == 1 && $arResult["bSavePage"] == false) {
                ?>
                <li>
                <a class="pagination__link" href="<?= $arResult['sUrlPathParams']; ?>"
                   title="<? echo $strTitle; ?>"><?= $NavRecordGroup ?></a></li><?
            } else {
                ?>
                <li>
                <a class="pagination__link" href="<?= $arResult['sUrlPathParams']; ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $NavRecordGroup ?>"
                   title="<? echo $strTitle; ?>"><?= $NavRecordGroup ?></a></li><?
            }
            if ($NavRecordGroup == 2 && $arResult["nStartPage"] > 3 && $arResult["nStartPage"] - $NavRecordGroup > 1) {
                $middlePage = ceil(($arResult["nStartPage"] + $NavRecordGroup) / 2);
                $strTitle = GetMessage(
                    'nav_page_num_title',
                    array('#NUM#' => $middlePage)
                );
                ?>
                <li>
                <a class="pagination__toh" href="<?= $arResult['sUrlPathParams']; ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $middlePage ?>"
                   title="<? echo $strTitle; ?>">...</a></li><?
                $NavRecordGroup = $arResult["nStartPage"];
            } elseif ($NavRecordGroup == $arResult["nEndPage"] && $arResult["nEndPage"] < ($arResult["NavPageCount"] - 2)) {
                $middlePage = floor(($arResult["NavPageCount"] + $arResult["nEndPage"] - 1) / 2);
                $strTitle = GetMessage(
                    'nav_page_num_title',
                    array('#NUM#' => $middlePage)
                );
                ?>
                <li>
                <a class="pagination__toh" href="<?= $arResult['sUrlPathParams']; ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $middlePage ?>"
                   title="<? echo $strTitle; ?>">...</a></li><?
                $NavRecordGroup = $arResult["NavPageCount"] - 1;
            } else {
                $NavRecordGroup++;
            }
        }
        ?>
        <li class="pagination__arrow"><?
        if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]) {
            ?><a class="btn-arrow btn-arrow--right"
            href="<?= $arResult['sUrlPathParams']; ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>"></a><?
        } else {
            ?><a class="btn-arrow btn-arrow--right" href="javascript:;"></a><?
        }
        ?></li><?
    }
    ?>
</ul>