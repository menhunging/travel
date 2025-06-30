<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<?php if (!empty($arResult)) { ?>
    <div class="menu-tabs-links">
        <div class="menu-tabs-links__list swiper">
            <div class="swiper-wrapper">
                <?php foreach ($arResult as $arItem) {
                    if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
                        continue;
                    ?>
                    <div class="swiper-slide">
                        <?php if ($arItem["SELECTED"]) { ?>
                            <a href="<?= $arItem["LINK"] ?>" class="active">
                                <?= $arItem["TEXT"] ?>
                            </a>
                        <?php } else { ?>
                            <a href="<?= $arItem["LINK"] ?>">
                                <?= $arItem["TEXT"] ?>
                            </a>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
            <div class="arrow-block arrow-left">
                <button class="swiper-button-prev btn-arrow btn-arrow--left"></button>
            </div>
            <div class="arrow-block arrow-right">
                <button class="swiper-button-next btn-arrow btn-arrow--right"></button>
            </div>
        </div>
    </div>
<?php }
