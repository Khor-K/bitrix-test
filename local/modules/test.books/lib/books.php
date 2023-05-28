<?php
namespace Test\Books;

use Bitrix\Main,
    Bitrix\Main\ORM,
    Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

class BooksTable extends Main\Entity\DataManager
{
    public static function getTableName()
    {
        return 'test_books';
    }

    public static function getMap()
    {
        return array(
            'ID' => new ORM\Fields\IntegerField('ID', array(
                'primary' => true,
                'autocomplete' => true
            )),
            'TITLE' => new ORM\Fields\StringField('TITLE', array(
                'required' => true,
            )),
        );
    }
}