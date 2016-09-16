<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arIds = array();
$arPictureIds = array();

foreach($arResult["GRID"]["ROWS"] as &$arItem)
{
	$arIds[] = $arItem['PRODUCT_ID'];
	if($arItem["PREVIEW_PICTURE"] <> "")
    {
        $arPictureIds[] = $arItem["PREVIEW_PICTURE"];
    }
}
unset($arItem);

if(sizeof($arPictureIds) > 0)
{
    $strIds = implode(",", $arPictureIds);

    $fl = new CFile;

    $arOrder = array();
    $arFilter = array(
        "MODULE_ID" => "iblock",
        "@ID" => $strIds
    );

    $arPreviewPicture = array();

    $rsFile = $fl->GetList($arOrder, $arFilter);
    while($arItem = $rsFile->GetNext())
    {
        $arPreviewPicture[$arItem["ID"]] = $arItem;
        $urlPreviewPicture = itc\Resizer::get($arItem["ID"], 'basketList');

        $arPreviewPicture[$arItem["ID"]]["SRC"] = $urlPreviewPicture;
    }

    foreach($arResult["GRID"]["ROWS"] as &$arItem)
    {
        if($arItem["PREVIEW_PICTURE"] <> "")
        {
            $arItem["PREVIEW_PICTURE"] = array("SRC" => $arPreviewPicture[$arItem["PREVIEW_PICTURE"]]["SRC"]);
        }
        else
        {
            $arItem["PREVIEW_PICTURE"] = array("SRC" => itc\Resizer::get(NO_PH_CRT_DM, 'basketList'));
        }
    }
    unset($arItem);
}
else
{
    foreach($arResult["GRID"]["ROWS"] as &$arItem)
    {
        $arItem["PREVIEW_PICTURE"]["SRC"] = itc\Resizer::get(NO_PHOTO_NEWS_ID, 'basketList');
    }
    unset($arItem);
}

/*
 * Если есть хотя бы 1 товар в корзине
 */
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
		"PROPERTY_TIPTOVARA",
		"PROPERTY_MIN_LIMIT"
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
	$arLimited = array();
	while ($arItem = $rsElements->GetNext())
	{
		$arElements[$arItem['ID']] = $arItem['PROPERTY_TIPTOVARA_VALUE'];
		$arLimited[$arItem['ID']] = $arItem['PROPERTY_MIN_LIMIT_VALUE'];
	}

	//pre($arElements);

	/**
	 * Поместить в массив $arResult
	 */
	foreach ($arResult["GRID"]["ROWS"] as &$arItem)
	{
		$arItem['PROPERTIES']['TIPTOVARA']['VALUE'] = $arElements[$arItem['PRODUCT_ID']];
		$arItem['PROPERTIES']['MIN_LIMIT']['VALUE'] = $arLimited[$arItem['PRODUCT_ID']];
	}
	unset($arElement);

	/**
	 * Определение параметров товара
	 */
	$typeElement      = '';
	$arTypeElement    = $GLOBALS["typeElement"];
	$arMeasureElement = $GLOBALS["measureElement"];
	$arMeasurePriceElement = $GLOBALS["measurePriceElement"];
	$arStepElement    = $GLOBALS["stepElement"];
	foreach ($arResult["GRID"]["ROWS"] as &$arItem)
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

			/**
			 * Сформировать строку data-item, которая подставится в element.php
			 */

			$price = 0;
			if($arResult['PRICES'][PRICE_BASE_TYPE_CODE]['DISCOUNT_VALUE'] > 0)
			{
				//$price = multiplyPrice($arResult['PRICES'][PRICE_BASE_TYPE_CODE]['DISCOUNT_VALUE'], $arResult['PROPERTIES']['TIPTOVARA']['VALUE']);
				$price = multiplyPrice($arResult['PRICES'][PRICE_BASE_TYPE_CODE]['DISCOUNT_VALUE'], $arResult['PROPERTIES']['TIPTOVARA']['VALUE']);
			}
			else
			{
				//$price = multiplyPrice($arResult['PRICES'][PRICE_BASE_TYPE_CODE]['VALUE'], $arResult['PROPERTIES']['TIPTOVARA']['VALUE']);
				$price = multiplyPrice($arResult['PRICES'][PRICE_BASE_TYPE_CODE]['VALUE'], $arResult['PROPERTIES']['TIPTOVARA']['VALUE']);
			}

			$arDataItemScript = array(
				"img" => $arItem["PREVIEW_PICTURE"]["SRC"],
				"name" => $arItem['NAME'],
				"price" => $arItem['CATALOG_PRICE_1'],
			);

			//$arItem["DATA_ITEM_FOR_SCRIPT"] = CUtil::PhpToJSObject($arDataItemScript);
			$arItem["DATA_ITEM_FOR_SCRIPT"] = json_encode($arDataItemScript);
		}
	}
}
?>