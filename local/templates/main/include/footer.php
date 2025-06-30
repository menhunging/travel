<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use App\Helper\Site;
use App\Helper;

global $arSiteContacts;
?>

<footer class="footer">
    <div class="footer__top">
        <div class="footer-col">
            <?php $APPLICATION->IncludeComponent(
                "bitrix:menu",
                "bottom",
                array(
                    "ALLOW_MULTI_SELECT" => "N",
                    "CHILD_MENU_TYPE" => "left",
                    "DELAY" => "N",
                    "MAX_LEVEL" => "1",
                    "MENU_CACHE_GET_VARS" => array(""),
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_TYPE" => "A",
                    "MENU_CACHE_USE_GROUPS" => "N",
                    "ROOT_MENU_TYPE" => "bottom",
                    "USE_EXT" => "N"
                )
            ); ?>
        </div>

        <div class="footer-col">
            <span class="footer-title">
                <?php $APPLICATION->IncludeFile(SITE_DIR . "include/footer/registry.php", array(), array('NAME' => 'Реестр туроператоров')); ?>
        </span>

            <div class="footer-col__content">
                <div class="footer-tourism">
                    <?php $APPLICATION->IncludeFile(SITE_DIR . "include/footer/tourism.php", array(), array('NAME' => 'Международный туризм')); ?>
                </div>
            </div>
        </div>

        <div class="footer-col">
            <?php if ($arSiteContacts['PHONE'] || $arSiteContacts['EMAIL']) { ?>
                <span class="footer-title">
                    <?php $APPLICATION->IncludeFile(SITE_DIR . "include/footer/contacts.php", array(), array('NAME' => 'Телефоны и почта')); ?>
                </span>

                <div class="footer-col__content">
                    <?php if ($arSiteContacts['PHONE']) { ?>
                        <div class="header-info">
                            <div class="phone-block">
                                <?php foreach ($arSiteContacts['PHONE'] as $value) { ?>
                                    <a href="tel:<?php echo Site::linkPhone($value); ?>" class="phone">
                                        <?php echo $value; ?>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if ($arSiteContacts['EMAIL']) { ?>
                        <a href="mailto:<?php echo $arSiteContacts['EMAIL']; ?>" class="link-mail">
                            <?php echo $arSiteContacts['EMAIL']; ?>
                        </a>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
        <?/*?>
        <div class="footer-col">
            <span class="footer-title">
                <?php $APPLICATION->IncludeFile(SITE_DIR . "include/footer/messengers.php", array(), array('NAME' => 'Мессенджеры')); ?>
            </span>

            <?php $APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "messengers",
                Array(
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "N",
                    "CACHE_TIME" => "36000000",
                    "CACHE_TYPE" => "A",
                    "CHECK_DATES" => "N",
                    "DETAIL_URL" => "",
                    "DISPLAY_BOTTOM_PAGER" => "N",
                    "DISPLAY_DATE" => "N",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "N",
                    "DISPLAY_PREVIEW_TEXT" => "N",
                    "DISPLAY_TOP_PAGER" => "N",
                    "FIELD_CODE" => array(0=>"",1=>"",),
                    "FILTER_NAME" => "",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "IBLOCK_ID" => Helper\Iblock::getIblockId('directory_messengers'),
                    "IBLOCK_TYPE" => "directory",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "MESSAGE_404" => "",
                    "NEWS_COUNT" => "5",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => ".default",
                    "PAGER_TITLE" => "Новости",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "PROPERTY_CODE" => array(0=>"LINK",1=>"CLASS",2=>"",),
                    "SET_BROWSER_TITLE" => "N",
                    "SET_LAST_MODIFIED" => "N",
                    "SET_META_DESCRIPTION" => "N",
                    "SET_META_KEYWORDS" => "N",
                    "SET_STATUS_404" => "N",
                    "SET_TITLE" => "N",
                    "SHOW_404" => "N",
                    "SORT_BY1" => "SORT",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER1" => "ASC",
                    "SORT_ORDER2" => "ASC",
                    "STRICT_SECTION_CHECK" => "N"
                )
            ); ?>
        </div>
<?*/ ?>
        <div class="footer-col">
            <?php if ($arSiteContacts['CITY'] || $arSiteContacts['ADDRESS']) { ?>
                <span class="footer-title">
                    <?php $APPLICATION->IncludeFile(SITE_DIR . "include/footer/office.php", array(), array('NAME' => 'Офис')); ?>
                </span>

                <div class="footer-col__content">
                    <div class="header-adress">
                        <span>
                            <?php if ($arSiteContacts['CITY']) { ?><strong><?php echo $arSiteContacts['CITY']; ?></strong><?php } ?><?php echo $arSiteContacts['ADDRESS'] ? (($arSiteContacts['CITY'] ? ', ' : '') . $arSiteContacts['ADDRESS']) : ''; ?>
                        </span>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="footer-col">
            <?php if ($arSiteContacts['SCHEDULE']) { ?>
                <span class="footer-title">
                    <?php $APPLICATION->IncludeFile(SITE_DIR . "include/footer/schedule.php", array(), array('NAME' => 'Режим работы')); ?>
                </span>
            <?php } ?>

            <div class="footer-col__content">
                <?php if ($arSiteContacts['SCHEDULE']) { ?>
                    <div class="timeWork">
                        <?php foreach ($arSiteContacts['SCHEDULE']['VALUE'] as $key => $value) { ?>
                            <span><strong><?php echo $value; ?>, </strong><?php echo $arSiteContacts['SCHEDULE']['DESCRIPTION'][$key]; ?></span>
                        <?php } ?>
                    </div>
                <?php } ?>

                <a href="javascript:;" class="btn js-popup-opener" data-action="application">
                    оставить заявку

                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8.73281 0.560003C9.09191 0.201033 9.57891 -0.000582021 10.0867 -0.000488249C10.5944 -0.000394477 11.0813 0.2014 11.4403 0.560503C11.7993 0.919606 12.0009 1.4066 12.0008 1.91436C12.0007 2.42211 11.7989 2.90903 11.4398 3.268L10.7068 4L10.9698 4.262C11.1323 4.42451 11.2612 4.61743 11.3492 4.82977C11.4372 5.0421 11.4824 5.26967 11.4824 5.4995C11.4824 5.72933 11.4372 5.95691 11.3492 6.16924C11.2612 6.38157 11.1323 6.5745 10.9698 6.737L9.85381 7.853C9.76005 7.94689 9.63284 7.99969 9.50016 7.99978C9.36748 7.99988 9.24019 7.94726 9.14631 7.8535C9.05242 7.75975 8.99962 7.63254 8.99953 7.49986C8.99943 7.36717 9.05205 7.23989 9.14581 7.146L10.2628 6.03C10.3325 5.96035 10.3878 5.87765 10.4255 5.78663C10.4632 5.6956 10.4826 5.59803 10.4826 5.4995C10.4826 5.40097 10.4632 5.30341 10.4255 5.21238C10.3878 5.12135 10.3325 5.03865 10.2628 4.969L9.99981 4.708L4.04481 10.662C3.86393 10.8428 3.64345 10.9791 3.40081 11.06L0.657806 11.975C0.569685 12.0043 0.475142 12.0085 0.384773 11.9871C0.294405 11.9657 0.211783 11.9196 0.146167 11.8538C0.0805516 11.7881 0.0345356 11.7054 0.0132768 11.615C-0.00798204 11.5246 -0.00364357 11.4301 0.0258059 11.342L0.939806 8.6C1.02077 8.35739 1.15702 8.13692 1.33781 7.956L8.73281 0.560003Z"
                            fill="white" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
    <div class="footer__bottom">
        <div class="copyRight">
            &copy; <?php $APPLICATION->IncludeFile(SITE_DIR . "include/footer/copyright.php", array(), array('NAME' => 'Авторские права')); ?> / <span class="thisYear"></span>
        </div>

        <div class="footer__logo">
            <img src="<?php echo SITE_TEMPLATE_PATH; ?>/img/pic-footer-bottom.png" alt="Ассоциация туроператоров России">
        </div>

        <div class="developer">
            <span class="developer__title">
                <?php $APPLICATION->IncludeFile(SITE_DIR . "include/footer/development.php", array(), array('NAME' => 'Разработка сайта')); ?>:
            </span>
            <?php $APPLICATION->IncludeFile(SITE_DIR . "include/footer/site_development.php", array(), array('NAME' => 'Сайт разработчика')); ?>
        </div>
    </div>
</footer>