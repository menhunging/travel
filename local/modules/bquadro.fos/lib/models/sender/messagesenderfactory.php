<?php

namespace Bquadro\Fos\Models\Sender;

class MessageSenderFactory
{
    public static function createSender($type)
    {
        switch ($type) {
            case 'email':
                return new EmailSender();
            default:
                throw new \Exception("Неизвестный тип отправителя сообщений: $type");
        }
    }
}