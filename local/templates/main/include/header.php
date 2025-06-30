<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use App\Helper\Site;
?>

<header class="header <?php $APPLICATION->AddBufferContent([App\Helper\Site::class, 'getClassByProperty'], 'class_header'); ?>">
    <div class="header__inner">
        <div class="logo">
            <a href="/"></a>
            <img src="<?php echo SITE_TEMPLATE_PATH; ?>/img/logo.png" alt="Premium CLub Travel">
        </div>
        <?php if ($arSiteContacts['CITY'] || $arSiteContacts['ADDRESS']) { ?>
            <div class="header-adress">
                <svg class="header-adress__icon" width="15" height="15" viewBox="0 0 15 15" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <g opacity="0.5">
                        <path
                            d="M7.5 7C8.32843 7 9 6.32843 9 5.5C9 4.67157 8.32843 4 7.5 4C6.67157 4 6 4.67157 6 5.5C6 6.32843 6.67157 7 7.5 7Z"
                            fill="#5184C4"/>
                        <path
                            d="M7.5 7.51095e-09C6.05079 -7.90421e-05 4.66011 0.623817 3.63023 1.73609C2.60035 2.84836 2.01449 4.35911 2 5.93998C2 10.05 6.84688 14.625 7.05313 14.82C7.17765 14.9361 7.33613 15 7.5 15C7.66387 15 7.82235 14.9361 7.94687 14.82C8.1875 14.625 13 10.05 13 5.93998C12.9855 4.35911 12.3997 2.84836 11.3698 1.73609C10.3399 0.623817 8.94921 -7.90421e-05 7.5 7.51095e-09ZM7.5 8.24997C7.02409 8.24997 6.55886 8.09602 6.16316 7.80758C5.76745 7.51914 5.45904 7.10918 5.27691 6.62952C5.09479 6.14987 5.04714 5.62207 5.13999 5.11287C5.23283 4.60367 5.462 4.13594 5.79852 3.76883C6.13504 3.40172 6.5638 3.15171 7.03056 3.05043C7.49733 2.94914 7.98115 3.00113 8.42083 3.19981C8.86052 3.39849 9.23632 3.73494 9.50072 4.16661C9.76513 4.59829 9.90625 5.10581 9.90625 5.62498C9.90625 6.32117 9.65273 6.98885 9.20148 7.48113C8.75022 7.97341 8.13818 8.24997 7.5 8.24997Z"
                            fill="#5184C4"/>
                    </g>
                </svg>
                <p>
                    <?php echo implode(', ', array_filter([
                        $arSiteContacts['CITY'] ?: '',
                        $arSiteContacts['ADDRESS'] ?: '',
                    ], function ($item) {
                        return $item;
                    })); ?>
                </p>
            </div>
        <?php } ?>

        <div class="header-info">
            <?php if ($arSiteContacts['EMAIL']) { ?>
                <a href="mailto:<?php echo $arSiteContacts['EMAIL']; ?>" class="link-mail">
                    <?php echo $arSiteContacts['EMAIL']; ?>
                </a>
            <?php } ?>
            <?php if ($arSiteContacts['PHONE']) { ?>
                <div class="phone-block">
                    <a href="tel:<?php echo Site::linkPhone($arSiteContacts['PHONE'][0]); ?>" class="phone">
                        <?php echo $arSiteContacts['PHONE'][0]; ?>
                    </a>
                    <span class="phone-block__arrow">
                        <svg width="14" height="10" viewBox="0 0 14 10" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M7 6.11394L12.4447 0.916585L14 2.40124L7 9.08325L-5.8416e-07 2.40124L1.55531 0.916586L7 6.11394Z"
                                    fill="#5184C4"/>
                        </svg>
                    </span>
                    <div class="phone-block__invis">
                        <ul>
                            <?php foreach ($arSiteContacts['PHONE'] as $value) { ?>
                                <li>
                                    <a href="tel:<?php echo Site::linkPhone($value); ?>">
                                        <?php echo $value; ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            <?php } ?>
            <a href="javascript:;" class="btn js-popup-opener" data-action="application">
                оставить заявку

                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M8.73281 0.560003C9.09191 0.201033 9.57891 -0.000582021 10.0867 -0.000488249C10.5944 -0.000394477 11.0813 0.2014 11.4403 0.560503C11.7993 0.919606 12.0009 1.4066 12.0008 1.91436C12.0007 2.42211 11.7989 2.90903 11.4398 3.268L10.7068 4L10.9698 4.262C11.1323 4.42451 11.2612 4.61743 11.3492 4.82977C11.4372 5.0421 11.4824 5.26967 11.4824 5.4995C11.4824 5.72933 11.4372 5.95691 11.3492 6.16924C11.2612 6.38157 11.1323 6.5745 10.9698 6.737L9.85381 7.853C9.76005 7.94689 9.63284 7.99969 9.50016 7.99978C9.36748 7.99988 9.24019 7.94726 9.14631 7.8535C9.05242 7.75975 8.99962 7.63254 8.99953 7.49986C8.99943 7.36717 9.05205 7.23989 9.14581 7.146L10.2628 6.03C10.3325 5.96035 10.3878 5.87765 10.4255 5.78663C10.4632 5.6956 10.4826 5.59803 10.4826 5.4995C10.4826 5.40097 10.4632 5.30341 10.4255 5.21238C10.3878 5.12135 10.3325 5.03865 10.2628 4.969L9.99981 4.708L4.04481 10.662C3.86393 10.8428 3.64345 10.9791 3.40081 11.06L0.657806 11.975C0.569685 12.0043 0.475142 12.0085 0.384773 11.9871C0.294405 11.9657 0.211783 11.9196 0.146167 11.8538C0.0805516 11.7881 0.0345356 11.7054 0.0132768 11.615C-0.00798204 11.5246 -0.00364357 11.4301 0.0258059 11.342L0.939806 8.6C1.02077 8.35739 1.15702 8.13692 1.33781 7.956L8.73281 0.560003Z"
                        fill="white"/>
                </svg>
            </a>
        </div>
    </div>
    <button class="btn-menu"></button>
    <div class="menu-invis">
        <?php $APPLICATION->IncludeComponent(
            "bitrix:menu",
            "top",
            Array(
                "ALLOW_MULTI_SELECT" => "N",
                "CHILD_MENU_TYPE" => "left",
                "DELAY" => "N",
                "MAX_LEVEL" => "1",
                "MENU_CACHE_GET_VARS" => array(0=>"",),
                "MENU_CACHE_TIME" => "3600",
                "MENU_CACHE_TYPE" => "A",
                "MENU_CACHE_USE_GROUPS" => "N",
                "ROOT_MENU_TYPE" => "top",
                "USE_EXT" => "N"
            )
        ); ?>

        <?php if ($arSiteContacts['CITY'] || $arSiteContacts['ADDRESS']) { ?>
            <div class="header-adress">
                <svg class="header-adress__icon" width="15" height="15" viewBox="0 0 15 15" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <g opacity="0.5">
                        <path
                            d="M7.5 7C8.32843 7 9 6.32843 9 5.5C9 4.67157 8.32843 4 7.5 4C6.67157 4 6 4.67157 6 5.5C6 6.32843 6.67157 7 7.5 7Z"
                            fill="#5184C4"/>
                        <path
                            d="M7.5 7.51095e-09C6.05079 -7.90421e-05 4.66011 0.623817 3.63023 1.73609C2.60035 2.84836 2.01449 4.35911 2 5.93998C2 10.05 6.84688 14.625 7.05313 14.82C7.17765 14.9361 7.33613 15 7.5 15C7.66387 15 7.82235 14.9361 7.94687 14.82C8.1875 14.625 13 10.05 13 5.93998C12.9855 4.35911 12.3997 2.84836 11.3698 1.73609C10.3399 0.623817 8.94921 -7.90421e-05 7.5 7.51095e-09ZM7.5 8.24997C7.02409 8.24997 6.55886 8.09602 6.16316 7.80758C5.76745 7.51914 5.45904 7.10918 5.27691 6.62952C5.09479 6.14987 5.04714 5.62207 5.13999 5.11287C5.23283 4.60367 5.462 4.13594 5.79852 3.76883C6.13504 3.40172 6.5638 3.15171 7.03056 3.05043C7.49733 2.94914 7.98115 3.00113 8.42083 3.19981C8.86052 3.39849 9.23632 3.73494 9.50072 4.16661C9.76513 4.59829 9.90625 5.10581 9.90625 5.62498C9.90625 6.32117 9.65273 6.98885 9.20148 7.48113C8.75022 7.97341 8.13818 8.24997 7.5 8.24997Z"
                            fill="#5184C4"/>
                    </g>
                </svg>
                <p>
                    <?php echo implode(', ', array_filter([
                        $arSiteContacts['CITY'] ?: '',
                        $arSiteContacts['ADDRESS'] ?: '',
                    ], function ($item) {
                        return $item;
                    })); ?>
                </p>
            </div>
        <?php } ?>

        <?php if ($arSiteContacts['EMAIL']) { ?>
            <div class="header-link">
                <?php foreach ($arSiteContacts['EMAIL'] as $value) { ?>
                    <a href="mailto:<?php echo $value; ?>" class="link-mail">
                        <?php echo $value; ?>
                    </a>
                <?php } ?>
            </div>
        <?php } ?>

        <?php if ($arSiteContacts['PHONE']) { ?>
            <div class="phone-block">
                <?php foreach ($arSiteContacts['PHONE'] as $value) { ?>
                    <a href="tel:<?php echo Site::linkPhone($value); ?>" class="phone">
                        <?php echo $value; ?>
                    </a>
                <?php } ?>
            </div>
        <?php } ?>

        <div class="mobile-call">
            <a href="javascript:;" class="btn js-popup-opener" data-action="application">
                оставить заявку
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M8.73281 0.560003C9.09191 0.201033 9.57891 -0.000582021 10.0867 -0.000488249C10.5944 -0.000394477 11.0813 0.2014 11.4403 0.560503C11.7993 0.919606 12.0009 1.4066 12.0008 1.91436C12.0007 2.42211 11.7989 2.90903 11.4398 3.268L10.7068 4L10.9698 4.262C11.1323 4.42451 11.2612 4.61743 11.3492 4.82977C11.4372 5.0421 11.4824 5.26967 11.4824 5.4995C11.4824 5.72933 11.4372 5.95691 11.3492 6.16924C11.2612 6.38157 11.1323 6.5745 10.9698 6.737L9.85381 7.853C9.76005 7.94689 9.63284 7.99969 9.50016 7.99978C9.36748 7.99988 9.24019 7.94726 9.14631 7.8535C9.05242 7.75975 8.99962 7.63254 8.99953 7.49986C8.99943 7.36717 9.05205 7.23989 9.14581 7.146L10.2628 6.03C10.3325 5.96035 10.3878 5.87765 10.4255 5.78663C10.4632 5.6956 10.4826 5.59803 10.4826 5.4995C10.4826 5.40097 10.4632 5.30341 10.4255 5.21238C10.3878 5.12135 10.3325 5.03865 10.2628 4.969L9.99981 4.708L4.04481 10.662C3.86393 10.8428 3.64345 10.9791 3.40081 11.06L0.657806 11.975C0.569685 12.0043 0.475142 12.0085 0.384773 11.9871C0.294405 11.9657 0.211783 11.9196 0.146167 11.8538C0.0805516 11.7881 0.0345356 11.7054 0.0132768 11.615C-0.00798204 11.5246 -0.00364357 11.4301 0.0258059 11.342L0.939806 8.6C1.02077 8.35739 1.15702 8.13692 1.33781 7.956L8.73281 0.560003Z"
                        fill="white"/>
                </svg>
            </a>
        </div>
    </div>
</header>
