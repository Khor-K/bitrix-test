<?php

use Bitrix\Main\Loader;
use Bitrix\Main\Grid\Options as GridOptions;
use Bitrix\Main\UI\Filter\Options as FilterOptions;
use Bitrix\Main\UI\PageNavigation;
use Test\Books\FilterGridController;

class BooksAuthorsComponent extends CBitrixComponent
{
    protected string $gridId = "books_authors_grid";

    public function onPrepareComponentParams($arParams)
    {
        Loader::includeModule('test.books');

        return parent::onPrepareComponentParams($arParams);
    }

    public function executeComponent()
    {
        $this->setGrid($this->getFilterValues());

        $this->includeComponentTemplate();
    }

    protected function getFilterValues() {
        $this->arResult['FILTER_ID'] = $this->gridId;
        $this->arResult['FILTER_FIELDS'] = FilterGridController::getFilterFields();

        $filterOptions = new FilterOptions($this->arResult['FILTER_ID']);
        return $filterOptions->getFilter($this->arResult['FILTER_FIELDS']);
    }

    protected function setGrid($filterValues)
    {
        $this->arResult['GRID_ID'] = $this->gridId;

        // Настройки грида
        $gridOptions = new GridOptions($this->arResult['GRID_ID']);
        $sorting = $gridOptions->getSorting(array("sort" => array("ID" => "ASC")));

        // Получение объекта навигации
        $navParams = $gridOptions->GetNavParams();
        $pageSize = $navParams['nPageSize'];
        $pageNavigation = new PageNavigation("page");
        $pageNavigation->allowAllRecords(false)
            ->setPageSize($pageSize)
            ->initFromUri();

        // получение QueryResult для установки параметров грида
        $booksList = FilterGridController::getBooksWithAuthorsList($filterValues, $pageNavigation, $sorting);

        // установка параметров грида
        $this->arResult["ROWS_COUNT"] = $booksList->getCount();
        $this->arResult["NAV_OBJECT"] = $pageNavigation;
        $this->arResult["SORT"] = $sorting["sort"];

        // установка строк в нужном для грида формате
        $this->arResult['ROWS'] = FilterGridController::getBooksWithAuthorsGridRows($booksList);
    }

}
