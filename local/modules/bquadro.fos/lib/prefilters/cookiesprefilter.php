<?php

namespace Bquadro\Fos\Prefilters;

use Bitrix\Main\Context;
use Bitrix\Main\Error;
use Bitrix\Main\Event;
use Bitrix\Main\EventResult;

class CookiesPrefilter extends \Bitrix\Main\Engine\ActionFilter\Base
{
    public function onBeforeAction(Event $event): ?EventResult
    {
        $coockie = Context::getCurrent()->getRequest()->getCookieList();

        if (empty($coockie)) {
            $this->addError(new Error('Coockie error. Get out of here. Who are you.'));

            return new EventResult(EventResult::ERROR, null, null, $this);
        }

        return null;
    }
}