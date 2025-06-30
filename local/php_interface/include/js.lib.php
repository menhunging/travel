<?php

$arJsConfig = array(
    "jquery" => array(
        "js" => "/local/js.lib/jquery/jquery-3.7.1.min.js",
        "rel" => array(),
        "skip_core" => true,
    ),
    "swiper" => array(
        "js" => "/local/js.lib/swiper/swiper-bundle.min.js",
        "css" => "/local/js.lib/swiper/swiper-bundle.min.css",
        "rel" => array(),
        "skip_core" => true,
    ),
    "selectric" => array(
        "js" => "/local/js.lib/selectric/jquery.selectric.min.js",
        "css" => "/local/js.lib/selectric/selectric.css",
        "rel" => array(),
        "skip_core" => true,
    ),
    "micromodal" => array(
        "js" => "/local/js.lib/micromodal/micromodal.min.js",
        "css" => "/local/js.lib/micromodal/micromodal.css",
        "rel" => array(),
        "skip_core" => true,
    ),
    "tabslet" => array(
        "js" => "/local/js.lib/tabslet/jquery.tabslet.min.js",
        "rel" => array(),
        "skip_core" => true,
    ),
    "fancybox" => array(
        "js" => "/local/js.lib/fancybox/fancybox.umd.js",
        "css" => "/local/js.lib/fancybox/fancybox.css",
        "rel" => array(),
        "skip_core" => true,
    ),
    "inputmask" => array(
        "js" => "/local/js.lib/inputmask/jquery.inputmask.min.js",
        "rel" => array(),
        "skip_core" => true,
    ),
    "moment" => array(
        "js" => "/local/js.lib/daterangepicker/moment.min.js",
        "rel" => array(),
        "skip_core" => true,
    ),
    "daterangepicker" => array(
        "js" => "/local/js.lib/daterangepicker/daterangepicker.min.js",
        "css" => "/local/js.lib/daterangepicker/daterangepicker.css",
        "rel" => array(),
        "skip_core" => true,
    ),
);

foreach ($arJsConfig as $ext => $arExt) {
    \CJSCore::RegisterExt($ext, $arExt);
}
