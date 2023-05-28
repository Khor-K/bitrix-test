<?php
namespace Test\Books;

use Bitrix\Main,
    Bitrix\Main\ORM,
    Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

/**
 * Class BooksAuthorsTable
 *
 * Fields:
 * <ul>
 * <li> ID int mandatory
 * <li> BOOK_ID int mandatory
 * <li> AUTHOR_ID int mandatory
 * </ul>
 *
 */
class BooksAuthorsTable extends Main\Entity\DataManager
{
    public static function getTableName()
    {
        return 'books_authors';
    }

    public static function getMap()
    {
        return array(
            'ID' => new ORM\Fields\IntegerField('ID', array(
                'primary' => true,
                'autocomplete' => true
            )),
            'BOOK_ID' => new ORM\Fields\IntegerField('BOOK_ID', array(
                'required' => true,
            )),
            'AUTHOR_ID' => new ORM\Fields\IntegerField('AUTHOR_ID', array(
                'required' => true,
            )),
            'BOOK' => new ORM\Fields\Relations\Reference(
                'BOOK',
                'BooksTable',
                ORM\Query\Join::on('this.BOOK_ID', 'ref.ID')
            ),
            'AUTHOR' => new ORM\Fields\Relations\Reference(
                'AUTHOR',
                'AuthorsTable',
                ORM\Query\Join::on('this.AUTHOR_ID', 'ref.ID')
            ),
        );
    }
}