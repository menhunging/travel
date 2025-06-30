<?php

namespace Bquadro\Fos\Dto;

class FormDTO extends BaseFormDTO
{
    public function __construct()
    {
        parent::__construct();

        $data = $this->getFosData();
        $this->setData($data);
    }

    private function setData($data): void
    {
        $res = [];

        if (isset($data['IBLOCK_CODE'])) {
            $this->iblockCode = $data['IBLOCK_CODE'];
            $this->iblockId = $this->getIBlockByCodeId($data['IBLOCK_CODE']);
        }
        $fieldsAdd = $this->getFormFields([]);
        $this->setAddData($fieldsAdd, $data);

        $fieldsEmail = $this->getEmailFields();
        $res['emailData'] = $this->setEmailData($fieldsEmail, $data);
        $this->data = $res;
    }
}
