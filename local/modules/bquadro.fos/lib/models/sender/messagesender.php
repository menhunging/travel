<?php

namespace Bquadro\Fos\Models\Sender;

interface MessageSender
{
    public function send(array $params);
}