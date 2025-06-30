<?php

namespace Bquadro\Fos\Events;

use Bitrix\Main\Page\Asset;
use COption;

class HandlerEvents
{
    public static function OnProlog()
    {
        if (!empty(COption::GetOptionString('bquadro.fos', 'BQ_MODULE_FOS_BOT_PROTECT_SETTING_RECAPTCHA_ENABLE'))) {
            $recapchKey = COption::GetOptionString('bquadro.fos', 'BQ_MODULE_FOS_BOT_PROTECT_SETTING_RECAPCHA_KEY');
            if (!empty($recapchKey)) {
                Asset::getInstance()->addJs('https://www.google.com/recaptcha/api.js?render=' . $recapchKey);
            }
        }
    }
}