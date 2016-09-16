<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
//pre($arResult);

$arIds = array();
$arPictureIds = array();

foreach($arResult['ORDERS'] as $key_order=>&$arOrders)
{
	$db_props = CSaleOrderPropsValue::GetOrderProps($arOrders["ORDER"]["ID"]);
	while ($arProps = $db_props->Fetch())
	{
		if($arProps["CODE"] == "FACT_SUMMA"){
			$arResult['ORDERS'][$key_order]["ORDER"]["FACT_SUMMA"] = $arProps["VALUE"];
		}
	}
	
	foreach($arOrders['BASKET_ITEMS'] as &$arItem)
	{
		$arIds[] = $arItem['PRODUCT_ID'];
	}
}
/**
 * Получить только уникальные значения
 */
$arIds = array_unique($arIds);

unset($arItem, $arOrders);

/**
 * Получить тип товара
 */
$arSort = array(
	"SORT"=>"ASC"
);
$arSelect = array(
	"ID",
	"NAME",
	"PROPERTY_TIPTOVARA"
);
$arFilter = array(
	"IBLOCK_ID" => CATALOG_IBLOCK_ID,
	"ID" => $arIds
);

$rsElements = CIBlockElement::GetList(
	$arSort,
	$arFilter,
	false,
	false,
	$arSelect
);

$arElements = array();
while ($arItem = $rsElements->GetNext())
{
	$arElements[$arItem['ID']] = $arItem['PROPERTY_TIPTOVARA_VALUE'];
}

//pre($arElements);

/**
 * Поместить в массив $arResult
 */
foreach($arResult['ORDERS'] as &$arOrders)
{
	foreach($arOrders['BASKET_ITEMS'] as &$arItem)
	{
		$arItem['PROPERTIES']['TIPTOVARA']['VALUE'] = $arElements[$arItem['PRODUCT_ID']];
	}
}
unset($arItem, $arOrders);

/**
 * Определение параметров товара
 */
$typeElement      = '';
$arTypeElement    = $GLOBALS["typeElement"];
$arMeasureElement = $GLOBALS["measureElement"];
$arMeasurePriceElement = $GLOBALS["measurePriceElement"];
$arStepElement    = $GLOBALS["stepElement"];

foreach($arResult['ORDERS'] as &$arOrders)
{
	foreach($arOrders['BASKET_ITEMS'] as &$arItem)
	{
		/**
		 * Определить тип товара
		 */
		foreach($arTypeElement as $type=>$value)
		{
			if($type == $arItem['PROPERTIES']['TIPTOVARA']['VALUE'])
			{
				$typeElement = $type;
				$arItem['PROPERTIES']['TIPTOVARA']['TYPE'] = $value;
				break;
			}
		}

		/**
		 * Определить меру товара
		 */
		$arItem['PROPERTIES']['TIPTOVARA']['MEASURE'] = $arMeasureElement[$arItem['PROPERTIES']['TIPTOVARA']['TYPE']];
		$arItem['PROPERTIES']['TIPTOVARA']['MEASURE_PRICE'] = $arMeasurePriceElement[$arItem['PROPERTIES']['TIPTOVARA']['TYPE']];

		/**
		 * Определить количество грамм
		 */
		$arItem['PROPERTIES']['TIPTOVARA']['STEP'] = $arStepElement[$typeElement];

		unset($typeElement);
	}
}

?>