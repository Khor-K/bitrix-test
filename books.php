<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Книги");

$APPLICATION->IncludeComponent(
	"test:books.grid.filter",
	"",
Array(),
false
);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");