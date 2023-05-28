<?php

use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Test\Books\AuthorsTable;
use Test\Books\BooksAuthorsTable;
use Test\Books\BooksTable;

Loc::loadMessages(__FILE__);

class test_books extends CModule
{
    public function __construct()
    {
        $arModuleVersion = array();
        
        include __DIR__ . '/version.php';

        if (is_array($arModuleVersion) && array_key_exists('VERSION', $arModuleVersion))
        {
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        }
        
        $this->MODULE_ID = 'test.books';
        $this->MODULE_NAME = Loc::getMessage('TEST_BOOKS_MODULE_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('TEST_BOOKS_MODULE_DESCRIPTION');
        $this->MODULE_GROUP_RIGHTS = 'N';
        $this->PARTNER_NAME = Loc::getMessage('TEST_BOOKS_MODULE_PARTNER_NAME');
        $this->PARTNER_URI = 'http://khordomain.ru';
    }

    public function doInstall()
    {
        ModuleManager::registerModule($this->MODULE_ID);
        $this->installDB();
    }

    public function doUninstall()
    {
        $this->uninstallDB();
        ModuleManager::unRegisterModule($this->MODULE_ID);
    }

    public function installDB()
    {
        if (Loader::includeModule($this->MODULE_ID))
        {
            BooksTable::getEntity()->createDbTable();
            AuthorsTable::getEntity()->createDbTable();
            BooksAuthorsTable::getEntity()->createDbTable();
        }
    }

    public function uninstallDB()
    {
        if (Loader::includeModule($this->MODULE_ID))
        {
            $connection = Application::getInstance()->getConnection();
            $connection->dropTable(BooksTable::getTableName());
            $connection->dropTable(AuthorsTable::getTableName());
            $connection->dropTable(BooksAuthorsTable::getTableName());
        }
    }
}
