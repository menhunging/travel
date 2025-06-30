<?php

namespace Bquadro\Fos\Dto;

use Bitrix\Main\LoaderException;

class FabricaDto
{
    /**
     * @throws LoaderException
     * @throws \Exception
     */
    public static function getFosDto($code = 'form'): FormDTOInterface
    {
        switch ($code) {
            case 'form':
                return new FormDto();
            default:
                throw new \Exception('Модель для ИБ ' . $code . ' не найдена');
        }
    }
}