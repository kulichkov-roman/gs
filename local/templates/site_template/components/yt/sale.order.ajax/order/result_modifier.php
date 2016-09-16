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
			$arItem['NAME'] = htmlspecialcharsBack(TruncateText($arItem["NAME"], 40));
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
// if( $_COOKIE['ITC'] == 'Y') 
{
	//
	if( $_COOKIE['ITC'] == 'Y') {
		// AddMessage2Log($_REQUEST);
	}

	if(empty($arResult["ORDER_PROP"]["USER_PROFILES"]) && !isset($_REQUEST["confirmorder"]) && $GLOBALS["USER"] -> IsAuthorized())
	{
		$userId = $GLOBALS["USER"]->GetId();
		$arUser = CUser::GetByID($userId) -> Fetch();
		if(!$arResult["ORDER_PROP"]["USER_PROPS_Y"][4]["VALUE"])
		{
			$arResult["ORDER_PROP"]["USER_PROPS_Y"][4]["VALUE"] = $arUser["EMAIL"];
			$arResult["ORDER_PROP"]["USER_PROPS_Y"][4]["VALUE_FORMATTED"] = $arUser["EMAIL"];
		}
		if(!$arResult["ORDER_PROP"]["USER_PROPS_Y"][7]["VALUE"])
		{
			$arResult["ORDER_PROP"]["USER_PROPS_Y"][7]["VALUE"] = $arUser["NAME"] . " " . $arUser["LAST_NAME"];
			$arResult["ORDER_PROP"]["USER_PROPS_Y"][7]["VALUE_FORMATTED"] = $arUser["NAME"] . " " . $arUser["LAST_NAME"];
		}		
		if(!$arResult["ORDER_PROP"]["USER_PROPS_Y"][8]["VALUE"])
		{
			$arResult["ORDER_PROP"]["USER_PROPS_Y"][8]["VALUE"] = $arUser["NAME"] . " " . $arUser["LAST_NAME"];
			$arResult["ORDER_PROP"]["USER_PROPS_Y"][8]["VALUE_FORMATTED"] = $arUser["NAME"] . " " . $arUser["LAST_NAME"];
		}
		
		if(!$arResult["ORDER_PROP"]["USER_PROPS_Y"][21]["VALUE"])
		{
			$arResult["ORDER_PROP"]["USER_PROPS_Y"][21]["VALUE"] = $arUser["EMAIL"];
			$arResult["ORDER_PROP"]["USER_PROPS_Y"][21]["VALUE_FORMATTED"] = $arUser["EMAIL"];
		}
		if(!$arResult["ORDER_PROP"]["USER_PROPS_Y"][24]["VALUE"])
		{
			$arResult["ORDER_PROP"]["USER_PROPS_Y"][24]["VALUE"] = $arUser["NAME"] . " " . $arUser["LAST_NAME"];
			$arResult["ORDER_PROP"]["USER_PROPS_Y"][24]["VALUE_FORMATTED"] = $arUser["NAME"] . " " . $arUser["LAST_NAME"];
		}		
		if(!$arResult["ORDER_PROP"]["USER_PROPS_Y"][25]["VALUE"])
		{
			$arResult["ORDER_PROP"]["USER_PROPS_Y"][25]["VALUE"] = $arUser["NAME"] . " " . $arUser["LAST_NAME"];
			$arResult["ORDER_PROP"]["USER_PROPS_Y"][25]["VALUE_FORMATTED"] = $arUser["NAME"] . " " . $arUser["LAST_NAME"];
		}
		
		if(!$arResult["ORDER_PROP"]["USER_PROPS_Y"][38]["VALUE"])
		{
			$arResult["ORDER_PROP"]["USER_PROPS_Y"][38]["VALUE"] = $arUser["EMAIL"];
			$arResult["ORDER_PROP"]["USER_PROPS_Y"][38]["VALUE_FORMATTED"] = $arUser["EMAIL"];
		}
		if(!$arResult["ORDER_PROP"]["USER_PROPS_Y"][41]["VALUE"])
		{
			$arResult["ORDER_PROP"]["USER_PROPS_Y"][41]["VALUE"] = $arUser["NAME"] . " " . $arUser["LAST_NAME"];
			$arResult["ORDER_PROP"]["USER_PROPS_Y"][41]["VALUE_FORMATTED"] = $arUser["NAME"] . " " . $arUser["LAST_NAME"];
		}		
		if(!$arResult["ORDER_PROP"]["USER_PROPS_Y"][42]["VALUE"])
		{
			$arResult["ORDER_PROP"]["USER_PROPS_Y"][42]["VALUE"] = $arUser["NAME"] . " " . $arUser["LAST_NAME"];
			$arResult["ORDER_PROP"]["USER_PROPS_Y"][42]["VALUE_FORMATTED"] = $arUser["NAME"] . " " . $arUser["LAST_NAME"];
		}
		
		if(!$arResult["ORDER_PROP"]["USER_PROPS_Y"][5]["VALUE"])
		{
			$arResult["ORDER_PROP"]["USER_PROPS_Y"][5]["VALUE"] = $arUser["PERSONAL_PHONE"];
			$arResult["ORDER_PROP"]["USER_PROPS_Y"][5]["VALUE_FORMATTED"] = $arUser["PERSONAL_PHONE"];
		}
		if(!$arResult["ORDER_PROP"]["USER_PROPS_Y"][22]["VALUE"])
		{
			$arResult["ORDER_PROP"]["USER_PROPS_Y"][22]["VALUE"] = $arUser["PERSONAL_PHONE"];
			$arResult["ORDER_PROP"]["USER_PROPS_Y"][22]["VALUE_FORMATTED"] = $arUser["PERSONAL_PHONE"];
		}
		if(!$arResult["ORDER_PROP"]["USER_PROPS_Y"][39]["VALUE"])
		{
			$arResult["ORDER_PROP"]["USER_PROPS_Y"][39]["VALUE"] = $arUser["PERSONAL_PHONE"];
			$arResult["ORDER_PROP"]["USER_PROPS_Y"][39]["VALUE_FORMATTED"] = $arUser["PERSONAL_PHONE"];
		}
		
	}
}

$userId = $GLOBALS["USER"]->GetId();
if(!$arUser && $userId){
	$arUser = CUser::GetByID($userId) -> Fetch();
}

$arResult["UF_DISCOUNT_CARD"] = $arUser["UF_DISCOUNT_CARD"];

/**
 * Получить средную скидку
 */
$price = 0.0;
$priceDiscount = 0.0;
$arResult["DISCOUNT_AVR"] = 0.0;
$arResult["DISCOUNT_DIFF"] = 0.0;
foreach($arResult["BASKET_ITEMS"] as $arBasket)
{
	$price += $arBasket["PRICE"] * $arBasket["QUANTITY"];
	$priceDiscount += $arBasket["QUANTITY"] * ($arBasket["PRICE"] + $arBasket['DISCOUNT_PRICE']);
}
//pre($price, $priceDiscount);
$arResult["DISCOUNT_AVR"] = round(100.0 - ($price * 100.0 / $priceDiscount));
if($priceDiscount > 0)
{
	$arResult["DISCOUNT_DIFF"] = $priceDiscount - $price;
}

//перемещаем "профиль по умолчанию" в начало и выбираем его
/*$defaultProfileId = getDefaultUserProfileId();
$defaultProfileKey = false;

foreach($arResult["ORDER_PROP"]["USER_PROFILES"] as $key => $arProfile){
	if(!$_POST["PROFILE_ID"]){
		if($arProfile["ID"] == $defaultProfileId){
			$arProfile["CHECKED"] = "Y";
			$arProfile["PROFILE_CHANGE"] = "Y";
			$arProfile["PROFILE_DEFAULT"] = "Y";
		} else {
			unset($arProfile["CHECKED"]);
			unset($arProfile["PROFILE_CHANGE"]);
			unset($arProfile["PROFILE_DEFAULT"]);
		}
		$arResult["ORDER_PROP"]["USER_PROFILES"][$key] = $arProfile;
	}
	if($arProfile["ID"] == $defaultProfileId){
		$defaultProfileKey = $key;
	}
}

if($defaultProfileKey){
	move_to_top($arResult["ORDER_PROP"]["USER_PROFILES"], $defaultProfileKey);
}*/

?>