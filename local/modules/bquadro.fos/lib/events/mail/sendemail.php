<?php

namespace Bquadro\Fos\Events\Mail;

use CEvent;

class SendEmail
{
    public static function BqFosSendEmail(string $eventName, array $params): void
    {
        CEvent::Send
        (
            $eventName,
            SITE_ID,
            $params
        );
    }
}