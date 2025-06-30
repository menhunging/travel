<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<?php if (!empty($arResult)) { ?>
    <ul class="footer__links">
        <?php foreach ($arResult as $arItem) {
            if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
                continue;
            ?>
            <?php if ($arItem["SELECTED"]) { ?>
                <li><a href="<?= $arItem["LINK"] ?>" class="link selected"><?= $arItem["TEXT"] ?></a></li>
            <?php } else { ?>
                <li><a href="<?= $arItem["LINK"] ?>" class="link"><?= $arItem["TEXT"] ?></a></li>
            <?php } ?>
        <?php } ?>
    </ul>
<?php }
