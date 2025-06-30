<?php

namespace Bquadro\Fos\Prefilters;

use Bitrix\Main\Context;
use Bitrix\Main\Error;
use Bitrix\Main\Event;
use Bitrix\Main\EventResult;
use COption;

class BotPrefilter extends \Bitrix\Main\Engine\ActionFilter\Base
{
    public function onBeforeAction(Event $event): ?EventResult
    {
        $isBot = $this->checkBot();

        if ($isBot) {
            $this->addError(new Error('Anti bot. Stop 120 sek'));

            return new EventResult(EventResult::ERROR, null, null, $this);
        }

        return null;
    }

    private function checkBot()
    {
        $timeLock = COption::GetOptionInt(
            'bquadro.fos',
            'BQ_MODULE_FOS',
            '120'
        );

        if (isset($_SESSION['chek_bot_time']) && (time() - $_SESSION['chek_bot_time']) < $timeLock) {
            return true;
        }

        $_SESSION['chek_bot_time'] = time();

        return false;
    }
}