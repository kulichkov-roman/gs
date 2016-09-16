<?
CModule::IncludeModule('iblock');

//заказ оформлен и корзина пуста (confirm.php)
if($arResult["ORDER"]["ID"] && !$arResult["BASKET_ITEMS"]){
    $rsBasketItems = CSaleBasket::GetList(
        array(),
        array(
            "ORDER_ID" => $arResult["ORDER"]["ID"] 
        )    
    );
    while($arBasketItem = $rsBasketItems -> Fetch()){
    	$arResult["BASKET_ITEMS"][$arBasketItem["ID"]] = $arBasketItem;
    }

    $arResult["DELIVERY"] = CSaleDelivery::GetByID($arResult["ORDER"]["DELIVERY_ID"]);
}

$arProductId = array();
foreach($arResult["BASKET_ITEMS"] as $key => $arBasketItem){
	$arProductId[] = $arBasketItem["PRODUCT_ID"];
}
$arProducts = array();

if($arProductId){
	$arFilter = array(
	    "IBLOCK_ID" => CATALOG_IBLOCK_ID,
	    "ACTIVE"    => "Y",
	    "ID"		=> $arProductId
	);
	$rsElements = CIBlockElement::GetList(
	    array(),
	    $arFilter
	);
	while($obElement = $rsElements->GetNextElement()) {
		$arElement = $obElement -> GetFields();
		$arElement["PROPERTIES"] = $obElement -> GetProperties();
		$arProducts[$arElement["ID"]] = $arElement;
	}
}

$arResult["PRODUCTS"] = $arProducts;

/**
 * Получить тип товара
 */
$arIds = array();

foreach($arResult["BASKET_ITEMS"] as &$arItem)
{
	$arIds[] = $arItem['PRODUCT_ID'];
}
unset($arItem);

if(sizeof($arIds))
{
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
	foreach ($arResult["BASKET_ITEMS"] as &$arItem)
	{
		$arItem['PROPERTIES']['TIPTOVARA']['VALUE'] = $arElements[$arItem['PRODUCT_ID']];
	}
	unset($arElement);

	//pre($arResult["BASKET_ITEMS"]);

	/**
	 * Определение параметров товара
	 */
	$typeElement      = '';
	$arTypeElement    = $GLOBALS["typeElement"];
	$arMeasureElement = $GLOBALS["measureElement"];
	$arMeasurePriceElement = $GLOBALS["measurePriceElement"];
	$arStepElement    = $GLOBALS["stepElement"];
	foreach ($arResult["BASKET_ITEMS"] as &$arItem)
	{
		if ($arItem["DELAY"] == "N" && $arItem["CAN_BUY"] == "Y")
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
	unset($arItem);
}
?>