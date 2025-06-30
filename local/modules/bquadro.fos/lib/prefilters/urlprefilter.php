<?php

namespace Bquadro\Fos\Prefilters;

use Bitrix\Main\Context;
use Bitrix\Main\Error;
use Bitrix\Main\Event;
use Bitrix\Main\EventResult;

class UrlPrefilter extends \Bitrix\Main\Engine\ActionFilter\Base
{
    public function onBeforeAction(Event $event): ?EventResult
    {
        $referer = Context::getCurrent()->getServer()->get('HTTP_REFERER');

        if (!$referer) {
            $this->addError(new Error('Url error. Get out of here. Who are you'));

            return new EventResult(EventResult::ERROR, null, null, $this);
        }

        return null;
    }
}