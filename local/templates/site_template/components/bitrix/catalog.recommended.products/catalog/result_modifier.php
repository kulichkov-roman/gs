<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */

/**
 * получить свойства хиты, акции, новинки
 */
$arIds = array();
foreach($arResult['ITEMS'] as &$arItem)
{
    $arIds[] = $arItem['ID'];

}
unset($arItem);

/**
 * Передача ID товаров в component_epilog.php, потому иначе выгрузка идёт не конкретным вариантам, а по всем товарам.
 */
$this->__component->arResult['IDS'] = $arIds;
$this->__component->SetResultCacheKeys(array('IDS'));

if(sizeof($arIds) > 0)
{
    $arSort = array();
    $arSelect = array(
        "ID",
        "NAME",
        "PROPERTY_NOVINKA",
        "PROPERTY_AKTSII",
        "PROPERTY_KHIT",
    );
    $arFilter = array(
        "IBLOCK_ID" => CATALOG_IBLOCK_ID,
        "ACTIVE" => "Y",
        "ID" => $arIds
    );

    $rsElements = CIBlockElement::GetList(
        $arSort,
        $arFilter,
        false,
        false,
        $arSelect
    );

    $arRecommended = array();
    while ($arItem = $rsElements->GetNext())
    {
        $arRecommended[$arItem['ID']] = array(
            'PROPERTY_NOVINKA' => $arItem['PROPERTY_NOVINKA_VALUE'],
            'PROPERTY_AKTSII'  => $arItem['PROPERTY_AKTSII_VALUE'],
            'PROPERTY_KHIT'    => $arItem['PROPERTY_KHIT_VALUE']
        );
    }

    if(sizeof($arRecommended))
    {
        foreach($arResult['ITEMS'] as $key => &$arItem)
        {
            $arItem['PROPERTY_NOVINKA'] = $arRecommended[$arItem['ID']]['PROPERTY_NOVINKA'];
            $arItem['PROPERTY_AKTSII']  = $arRecommended[$arItem['ID']]['PROPERTY_AKTSII'];
            $arItem['PROPERTY_KHIT']    = $arRecommended[$arItem['ID']]['PROPERTY_KHIT'];
        }
        unset($arItem);
    }
}
unset($arIds);

/**
 * уменьшить изображение
 **/
$arIds = array();
$typeElement      = '';
$arTypeElement    = $GLOBALS["typeElement"];
$arMeasureElement = $GLOBALS["measureElement"];
$arMeasurePriceElement = $GLOBALS["measurePriceElement"];
$arStepElement    = $GLOBALS["stepElement"];
foreach($arResult["ITEMS"] as &$arItem)
{
    if(is_array($arItem["PREVIEW_PICTURE"]))
    {
        $arIds[] = $arItem["PREVIEW_PICTURE"]["ID"];
    }

	/**
	 * Получить TIPTOVARA
	 */
	$arSort = array();
	$arSelect = array(
		"ID",
		"NAME",
		"PROPERTY_TIPTOVARA",
		"PROPERTY_SHOW_MAIN_PAGE",
		"PROPERTY_MIN_LIMIT"
	);
	$arFilter = array(
		"IBLOCK_ID" => CATALOG_IBLOCK_ID,
		"ID" => $arItem["ID"]
	);

	$rsElements = CIBlockElement::GetList(
		$arSort,
		$arFilter,
		false,
		false,
		$arSelect
	);

	if ($arElement = $rsElements->Fetch())
	{
		if($USER->isAdmin())
		{
			//pre($arElement);
		}

		$arElement['PROPERTY_TIPTOVARA_VALUE'];

		$arItem['PROPERTIES']['TIPTOVARA']['VALUE'] = $arElement['PROPERTY_TIPTOVARA_VALUE'];

		/**
		 * Минимальное ограничение
		 */
		$arItem['PROPERTIES']['MIN_LIMIT']['VALUE'] = $arElement['PROPERTY_MIN_LIMIT_VALUE'];

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
		$arDataItemScript = array(
			"img" => $arItem["PREVIEW_PICTURE"]["SRC"],
			"name" => $arItem['NAME'],
			"price" => $arItem['CATALOG_PRICE_1'],
		);

		//$arItem["DATA_ITEM_FOR_SCRIPT"] = CUtil::PhpToJSObject($arDataItemScript);
		$arItem["DATA_ITEM_FOR_SCRIPT"] = json_encode($arDataItemScript);
	}
}
unset($arItem);

if(sizeof($arIds) > 0)
{
    $strIds = implode(",", $arIds);

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
        $urlPreviewPicture = itc\Resizer::get($arItem["ID"], 'catalogList');

        $arPreviewPicture[$arItem["ID"]]["SRC"] = $urlPreviewPicture;
    }

    foreach($arResult["ITEMS"] as &$arItem)
    {
        if(!$arItem["PREVIEW_PICTURE"]["SRC"] == "")
        {
            $arItem["PREVIEW_PICTURE"]["SRC"] = $arPreviewPicture[$arItem["PREVIEW_PICTURE"]["ID"]]["SRC"];

        }
        else
        {
            $arItem["PREVIEW_PICTURE"]["SRC"] = itc\Resizer::get(NO_PHOTO_NEWS_ID, 'catalogList');
        }
    }
    unset($arItem);
}
else
{
	foreach($arResult["ITEMS"] as &$arItem)
	{
		$arItem["PREVIEW_PICTURE"]["SRC"] = itc\Resizer::get(NO_PHOTO_NEWS_ID, 'catalogList');
	}
	unset($arItem);
}

/**
 * распределить по 3
 */
$arResult["ITEMS"] = array_chunk($arResult["ITEMS"], 3);
?>