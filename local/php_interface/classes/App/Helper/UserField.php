<?php

namespace App\Helper;

class UserField
{
    public static function getById($id):array|false
    {
        $id = intval($id);

        if ($id > 0) {
            $rsField = \CUserFieldEnum::GetList(array(), array(
                "ID" => $id,
            ));
            if ($arField = $rsField->GetNext()) {
                return $arField;
            }
        }

        return false;
    }
}