<?php
namespace Test\Books;

use Bitrix\Main,
    Bitrix\Main\ORM,
    Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

class AuthorsTable extends Main\Entity\DataManager
{
    public static function getTableName()
    {
        return 'test_authors';
    }

    public static function getMap()
    {
        return array(
            'ID' => new ORM\Fields\IntegerField('ID', array(
                'primary' => true,
                'autocomplete' => true
            )),
            'NAME' => new ORM\Fields\StringField('NAME', array(
                'required' => true,
            )),
        );
    }
}