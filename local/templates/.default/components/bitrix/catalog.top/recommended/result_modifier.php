<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */

/**
 * Получить TIPTOVARA
 */
$arSort = array(
	"SORT"=>"ASC"
);
$arSelect = array(
	"ID",
	"NAME",
	"PROPERTY_TIPTOVARA",
	"PROPERTY_SHOW_MAIN_PAGE"
);
$arFilter = array(
	"IBLOCK_ID" => CATALOG_IBLOCK_ID,
	"PROPERTY_SHOW_MAIN_PAGE_VALUE" => "Y"
);

$rsElements = CIBlockElement::GetList(
	$arSort,
	$arFilter,
	false,
	false,
	$arSelect
);

while ($arElement = $rsElements->Fetch())
{
	foreach($arResult['ITEMS'] as &$arItem)
	{
		$arItem['PROPERTIES'] = array(
			'TIPTOVARA' => array(
				'VALUE' => $arElement['PROPERTY_TIPTOVARA_VALUE']
			)
		);
	}
	unset($arItem);
}

/**
 * Параметры товара
 */
$arIds = array();
$typeElement      = '';
$arTypeElement    = $GLOBALS["typeElement"];
$arMeasureElement = $GLOBALS["measureElement"];
$arMeasurePriceElement = $GLOBALS["measurePriceElement"];
$arStepElement    = $GLOBALS["stepElement"];
foreach($arResult['ITEMS'] as &$arItem)
{
    $arIds[] = $arItem['ID'];

	/**
	 * Определить тип товара
	 */
	foreach($arTypeElement as $type=>$value)
	{
		if($type == $arItem['DISPLAY_PROPERTIES']['TIPTOVARA']['VALUE'])
		{
			$typeElement = $type;
			$arItem['PROPERTIES']['TIPTOVARA']['TYPE'] = $value;
			break;
		}
	}

	/**
	 * Минимальное ограничение
	 */
	$arItem['PROPERTIES']['MIN_LIMIT']['VALUE'] = $arItem['DISPLAY_PROPERTIES']['MIN_LIMIT']['VALUE'];

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
unset($arItem);

/**
 * Получить свойства хиты, акции, новинки
 */
if(sizeof($arIds) > 0)
{
    $arSort = array();
    $arSelect = array(
        "ID",
        "NAME",
        "PROPERTY_NOVINKA",
        "PROPERTY_AKTSII",
        "PROPERTY_KHIT"
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

/**
 * уменьшить изображение
 **/

$arIds = array();
foreach($arResult["ITEMS"] as &$arItem)
{
    if(is_array($arItem["PREVIEW_PICTURE"]))
    {
        $arIds[] = $arItem["PREVIEW_PICTURE"]["ID"];
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
            $arItem["PREVIEW_PICTURE"]["SRC"] = itc\Resizer::get(NO_PH_CAT_PV, 'catalogList');
        }
    }
    unset($arItem);
}
else
{
	foreach($arResult["ITEMS"] as &$arItem)
	{
		$arItem["PREVIEW_PICTURE"]["SRC"] = itc\Resizer::get(NO_PH_CAT_PV, 'catalogList');
	}
	unset($arItem);
}

/**
 * распределить по 3
 */
$arResultNew = array();

$arResult["ITEMS"] = array_chunk($arResult["ITEMS"], 3);
?>