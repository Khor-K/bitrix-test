<?php
namespace Test\Books;

use Bitrix\Main\Entity\ReferenceField;
use Bitrix\Main\ORM\Fields\ExpressionField;
use Bitrix\Main\ORM\Query\Result as QueryResult;

class FilterGridController {
    static function getBooksWithAuthorsList($filterValues, $pageNavigation, $sorting) {
        // Настройка выборки
        $parameters = [
            'select' => [
                'ID',
                'TITLE',
                'AUTHORS' => new ExpressionField(
                    'AUTHORS',
                    'GROUP_CONCAT(%s SEPARATOR \', \')',
                    'Author.NAME'
                ),
            ],
            'runtime' => [
                new ReferenceField(
                    'BookAuthor',
                    'Test\Books\BooksAuthorsTable',
                    ['=this.ID' => 'ref.BOOK_ID'],
                    ['join_type' => 'left']
                ),
                new ReferenceField(
                    'Author',
                    'Test\Books\AuthorsTable',
                    ['=this.BookAuthor.AUTHOR_ID' => 'ref.ID'],
                    ['join_type' => 'left']
                )
            ],
            'group' => ['ID', 'TITLE'],
            'order' => $sorting["sort"],
            'limit' => $pageNavigation->getLimit(),
            'offset' => $pageNavigation->getOffset(),
            'count_total' => true,
        ];

        // Применение фитров
        if (!empty($filterValues['TITLE'])) {
            $parameters['filter']['%=TITLE'] = '%'.$filterValues['TITLE'].'%';
        }
        if (!empty($filterValues['FIND'])) {
            $parameters['filter']['%=TITLE'] = '%'.$filterValues['FIND'].'%';
        }
        if (!empty($filterValues['AUTHOR'])) {
            $parameters['filter']['@BookAuthor.AUTHOR_ID'] = $filterValues['AUTHOR'];
        }

        $booksList = BooksTable::getList($parameters);
        $pageNavigation->setRecordCount($booksList->getCount()); // Отображение кол-ва записей

        return $booksList;
    }

    static function getFilterFields()
    {
        return [
            [
                'id' => 'TITLE',
                'name' => 'Название книги',
                'type' => 'text',
                'default' => true,
            ],
            [
                'id' => 'AUTHOR',
                'name' => 'Авторы',
                'type' => 'list',
                'items' => static::getAuthorsFilterList(),
                'params' => ['multiple' => 'Y'],
                'default' => true,
            ],
        ];
    }

    protected static function getAuthorsFilterList()
    {
        // Выборка всех авторов и возврат их в формате ['id' => 'name']
        $authorsList = AuthorsTable::getList([
            'filter' => ['ID', 'NAME'],
            'order' => ['NAME' => 'ASC']
        ]);

        $authors = [];
        while ($author = $authorsList->fetch()) {
            $authors[$author['ID']] = $author['NAME'];
        }

        return $authors;
    }

    static function getBooksWithAuthorsGridRows(QueryResult $booksList) {
        $rows = $booksList->fetchAll();
        $result = [];

        // Создание массива записей для грида
        foreach ($rows as $row) {
            $result[] = [
                'id' => $row['ID'],
                'data' => [
                    'ID' => $row['ID'],
                    'TITLE' => $row['TITLE'],
                    'AUTHORS' => $row['AUTHORS'],
                ],
                'actions' => [],
                'columns' => [],
                'editable' => false,
            ];
        }

        return $result;
    }
}