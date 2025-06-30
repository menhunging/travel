<?php

use Bitrix\Main\Loader;

Loader::includeModule('sprint.migration');

// автозагрузка
spl_autoload_register(
    function ($path) {
        if (preg_match('/\\\\/', $path)) {
            $path = str_replace('\\', DIRECTORY_SEPARATOR, $path);
        }

        $path = $_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/classes/" . $path . '.php';

        if (file_exists($path)) {
            require_once($path);
        }
    }
);

if (file_exists(__DIR__ . "/include/redirect.php")) {
    require_once(__DIR__ . "/include/redirect.php");
}

if (file_exists(__DIR__ . "/include/js.lib.php")) {
    require_once(__DIR__ . "/include/js.lib.php");
}

if (file_exists(__DIR__ . "/include/constants.php")) {
    require_once(__DIR__ . "/include/constants.php");
}

if (file_exists(__DIR__ . "/include/functions.php")) {
    require_once(__DIR__ . "/include/functions.php");
}

if (file_exists(__DIR__ . "/include/events.php")) {
    require_once(__DIR__ . "/include/events.php");
}
