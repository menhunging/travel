<?php

namespace Bquadro\Fos\Models\Action;

use Bitrix\Main\Result;

abstract class Base
{
    protected $data = [];
    protected Result $result;

    public function __construct()
    {
        $this->result = new Result();
    }

    protected function getResult(): Result
    {
        $this->result->setData($this->data);

        return $this->result;
    }
}