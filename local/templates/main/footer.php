<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

global $APPLICATION, $USER;
$page404 = defined('ERROR_404') && ERROR_404 == 'Y' || CHTTP::GetLastStatus() == "404 Not Found";
?>

<?php $APPLICATION->IncludeFile(str_replace(".php", ".after.php", $_SERVER["SCRIPT_NAME"]), array(), array("SHOW_BORDER" => false)); ?>
<?php $APPLICATION->AddBufferContent([App\Helper\Site::class, 'textPageTextEnd']); ?>
<?php $APPLICATION->AddBufferContent([App\Helper\Site::class, 'textPageEnd']); ?>
<?php $APPLICATION->AddBufferContent([App\Helper\Site::class, 'showMainEnd']); ?>
<?php if (!$page404) { ?>
    <?php include_once __DIR__ . "/include/footer.php"; ?>
<?php } ?>
</div> <?php // site-wrapper ?>

<?php include_once __DIR__ . "/include/modal.php"; ?>

</body>
</html>

<?php
$APPLICATION->SetPageProperty("keywords", "");
