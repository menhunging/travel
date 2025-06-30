<?php

use Bitrix\Main\EventManager;
use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class bquadro_fos extends CModule
{
    public $MODULE_ID = "bquadro.fos";
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_NAME;
    public $MODULE_DESCRIPTION;

    function __construct()
    {
        $arModuleVersion = [];
        include(__DIR__ . "/version.php");
        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        $this->PARTNER_NAME = Loc::getMessage('BQ_MODULE_FOS_PARTNER');
        $this->PARTNER_URI = Loc::getMessage('BQ_PROJECT_MODULE_PARTNER_URI');
        $this->MODULE_NAME = Loc::getMessage('BQ_MODULE_FOS_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('BQ_MODULE_FOS_DESCRIPTION');

        return true;
    }

    function InstallDB()
    {
        return true;
    }

    function UnInstallDB($arParams = array())
    {
        return true;
    }

    function installEvents()
    {
        $eventManager = EventManager::getInstance();
        $eventManager->registerEventHandler(
            'main',
            'OnProlog',
            $this->MODULE_ID,
            '\Bquadro\Fos\Events\HandlerEvents',
            'OnProlog'
        );

        return $eventManager->findEventHandlers($this->MODULE_ID, 'OnPageStart');
    }

    function unInstallEvents()
    {
        $eventManager = EventManager::getInstance();
        $eventManager->unRegisterEventHandler(
            'main',
            'OnProlog',
            $this->MODULE_ID,
            '\Bquadro\Fos\Events\HandlerEvents',
            'OnProlog'
        );

        return $eventManager->findEventHandlers($this->MODULE_ID, 'OnPageStart');
    }

    function InstallFiles()
    {
        return true;
    }

    function UnInstallFiles()
    {
        return true;
    }

    /**
     * @throws \Bitrix\Main\LoaderException
     */
    function DoInstall()
    {
        $this->installEvents();
        $this->installComponents();

        RegisterModule($this->MODULE_ID);

        return true;
    }

    function installComponents()
    {
        CopyDirFiles(
            __DIR__ . "/components",
            $_SERVER["DOCUMENT_ROOT"] . "/local/components/bquadro/",
            true, // перезаписывает файлы
            true  // копирует рекурсивно
        );
    }

    function DoUninstall()
    {
        $this->unInstallEvents();
        $this->unInstallComponents();
        UnRegisterModule($this->MODULE_ID);

        return true;
    }

    function unInstallComponents()
    {
        if (is_dir($_SERVER["DOCUMENT_ROOT"] . "/local/components/bquadro/" . $this->MODULE_ID)) {
            // удаляет папка из указанной директории, функция работает рекурсивно
            DeleteDirFilesEx(
                "/local/components/bquadro/" . $this->MODULE_ID
            );
        }
    }
}
