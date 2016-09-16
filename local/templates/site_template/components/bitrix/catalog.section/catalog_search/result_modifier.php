 <?
use Bitrix\Main\Type\Collection;
use Bitrix\Currency\CurrencyTable;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

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
 * Определение параметров товара
 */
$typeElement      = '';
$arTypeElement    = $GLOBALS["typeElement"];
$arMeasureElement = $GLOBALS["measureElement"];
$arMeasurePriceElement = $GLOBALS["measurePriceElement"];
$arStepElement    = $GLOBALS["stepElement"];

foreach($arResult['ITEMS'] as &$arItem)
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
?>