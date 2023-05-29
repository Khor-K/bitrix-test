<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$APPLICATION->IncludeComponent(
    'bitrix:main.ui.filter',
    '',
    [
        'GRID_ID' => $arResult['GRID_ID'],
        'FILTER_ID' => $arResult['FILTER_ID'],
        'FILTER' => $arResult['FILTER_FIELDS'],
        'ENABLE_LIVE_SEARCH' => true,
        'ENABLE_LABEL' => true,
    ]
);

$APPLICATION->IncludeComponent(
    'bitrix:main.ui.grid',
    '',
    [
        'GRID_ID' => $arResult['GRID_ID'],
        'COLUMNS' => [
            [
                'id' => 'ID',
                'name' => 'ID',
                'sort' => 'ID',
                'default' => true,
            ],
            [
                'id' => 'TITLE',
                'name' => 'Книга',
                'sort' => 'TITLE',
                'default' => true,
            ],
            [
                'id' => 'AUTHORS',
                'name' => 'Авторы',
                'sort' => 'AUTHORS',
                'default' => true,
            ],
        ],
        'ROWS' => $arResult['ROWS'],
        'TOTAL_ROWS_COUNT' => $arResult['ROWS_COUNT'],
        'NAV_OBJECT' => $arResult['NAV_OBJECT'],
        'SORT' => $arResult['SORT'],
        'AJAX_MODE' => 'Y',
        'ALLOW_COLUMNS_SORT' => true,
        'ALLOW_SORT' => true,
        'ALLOW_PIN_HEADER' => true,
        'SHOW_CHECK_ALL_CHECKBOXES' => false,
        'SHOW_ROW_CHECKBOXES' => false,
        'SHOW_ROW_ACTIONS_MENU' => true,
        'SHOW_GRID_SETTINGS_MENU' => true,
        'SHOW_NAVIGATION_PANEL' => true,
        'SHOW_SELECTED_COUNTER' => false,
        'SHOW_TOTAL_COUNTER' => true,
        'SHOW_PAGINATION' => true,
        'SHOW_PAGESIZE' => true,
        'PAGE_SIZES' => [
            ['NAME' => '10', 'VALUE' => '10'],
            ['NAME' => '20', 'VALUE' => '20'],
            ['NAME' => '50', 'VALUE' => '50'],
            ['NAME' => '100', 'VALUE' => '100'],
        ],
    ]
);
