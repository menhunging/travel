<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

global $APPLICATION, $USER;

$arSiteContacts = App\Models\SiteContact::getContacts();

$curDir = $APPLICATION->GetCurDir();
$curPage = $APPLICATION->GetCurPage(false);

$arJsCore = [
    "fx",
    "jquery",
    "swiper",
    "selectric",
    "micromodal",
    "tabslet",
    "fancybox",
    "inputmask",
    "moment",
    "daterangepicker",
];
CJSCore::Init($arJsCore);

$asset = Bitrix\Main\Page\Asset::getInstance();
$asset->addCss(SITE_TEMPLATE_PATH . "/fonts/stylesheet.css");
$asset->addCss(SITE_TEMPLATE_PATH . "/css/style.css");
$asset->addJs(SITE_TEMPLATE_PATH . "/js/main.js");
$asset->addJs(SITE_TEMPLATE_PATH . "/js/form.js");
$asset->addJs(SITE_TEMPLATE_PATH . "/js/custom.js");
?>

<!DOCTYPE html>
<html lang="<?= LANGUAGE_ID; ?>-<?= strtoupper(LANGUAGE_ID); ?>">

<head>
    <?php $APPLICATION->ShowHead(); ?>
    <meta name="viewport" content="width=device-width, user-scalable=no, viewport-fit=cover"/>
    <title><?php $APPLICATION->ShowTitle(); ?></title>
<?/*?>
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo SITE_TEMPLATE_PATH; ?>/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo SITE_TEMPLATE_PATH; ?>/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo SITE_TEMPLATE_PATH; ?>/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?php echo SITE_TEMPLATE_PATH; ?>/img/favicon/site.webmanifest">
    <link rel="mask-icon" href="<?php echo SITE_TEMPLATE_PATH; ?>/img/favicon/safari-pinned-tab.svg" color="#030e2c">
    <?*/?>
    <meta name="msapplication-TileColor" content="#030e2c">
    <meta name="theme-color" content="#030e2c">
</head>

<body class="<?php $APPLICATION->AddBufferContent([App\Helper\Site::class, 'getClassByProperty'], 'class_body'); ?>">
<?php $APPLICATION->ShowPanel(); ?>

<div class="site-wrapper">
    <?php include_once __DIR__ . "/include/header.php"; ?>

    <?php $APPLICATION->AddBufferContent([App\Helper\Site::class, 'showMainBegin']); ?>
        <?php $APPLICATION->IncludeComponent(
            "bitrix:breadcrumb",
            "main",
            Array(
                "PATH" => "",
                "SITE_ID" => "s1",
                "START_FROM" => "0"
            )
        ); ?>

        <?php $APPLICATION->AddBufferContent([App\Helper\Site::class, 'textPageBegin']); ?>
        <?php $APPLICATION->AddBufferContent([App\Helper\Site::class, 'showTitle']); ?>
        <?php $APPLICATION->AddBufferContent([App\Helper\Site::class, 'textPageTextBegin']); ?>
        <?php $APPLICATION->IncludeFile(str_replace(".php", ".before.php", $_SERVER["SCRIPT_NAME"]), array(), array("SHOW_BORDER" => false)); ?>
