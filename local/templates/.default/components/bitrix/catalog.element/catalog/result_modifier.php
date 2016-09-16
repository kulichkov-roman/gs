<?
use Bitrix\Main\Type\Collection;
use Bitrix\Currency\CurrencyTable;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

if($USER->isAdmin())
{
    //pre($arResult);
}

/*
 * получить рецепт
 * */
if($arResult['PROPERTIES']['RECIPES']['VALUE'] <> "")
{
    $arSort = array();
    $arSelect = array(
        'ID',
        'NAME',
        'PREVIEW_PICTURE',
        'IBLOCK_SECTION_ID',
        'DETAIL_PAGE_URL'
    );
    $arFilter = array(
        "IBLOCK_ID" => RECIPE_IBLOCK_ID,
        "ACTIVE" => "Y",
        "ID" => $arResult['PROPERTIES']['RECIPES']['VALUE']
    );

    $rsElements = CIBlockElement::GetList(
        $arSort,
        $arFilter,
        false,
        false,
        $arSelect
    );

    if($arItem = $rsElements->GetNext())
    {
        if($USER->isAdmin())
        {
            //pre($arItem);
        }

        /**
         * получить название раздела
         */
        $arSort = array();
        $arFilter = array(
            "IBLOCK_ID" => RECIPE_IBLOCK_ID,
            "ACTIVE" => "Y",
            "ID" => $arItem['IBLOCK_SECTION_ID']
        );
        $arSelect = array(
            "ID",
            "NAME",
            "SECTION_PAGE_URL"
        );

        $rsSection = CIBlockSection::GetList(
            $arSort,
            $arFilter,
            false,
            $arSelect,
            false
        );

        if ($arSection = $rsSection->GetNext())
        {
            $arItem['SECTION'] = $arSection;
        }

        /*
         * получить изображение
         * */

        $id = "";
        if($arItem["PREVIEW_PICTURE"] <> "")
        {
            $id = $arItem["PREVIEW_PICTURE"];
        }

        if($id <> "")
        {
            $fl = new CFile;

            $arOrder = array();
            $arFilter = array(
                "MODULE_ID" => "iblock",
                "@ID" => $id
            );

            $arPreviewPicture = array();

            $rsFile = $fl->GetList($arOrder, $arFilter);

            if($arFile = $rsFile->GetNext())
            {
                $arPreviewPicture[$arFile["ID"]] = $arFile;

                $extension = GetFileExtension("/upload/".$arFile["SUBDIR"]."/".$arFile["FILE_NAME"]);
                $urlPreviewPicture = itc\Resizer::get($arFile["ID"], 'recipesElem');

                $arItem["PREVIEW_PICTURE"] = array('SRC' => $urlPreviewPicture);
            }
        }
    }
    $arResult['PROPERTIES']['RECIPES']['VALUE'] = $arItem;
}

/**
 * Уменьшить изображение
 */
$arPictIds = array();
$pictId = $arResult["DETAIL_PICTURE"]["ID"] <> '' ? $arResult["DETAIL_PICTURE"]["ID"] : $arResult["PREVIEW_PICTURE"]["ID"];
if(!$pictId){
    $pictId = NO_PH_CAT_BG;
}

	if($USER->isAdmin())
	{
		//pre($arResult["PROPERTIES"]["MORE_PHOTO"]);
	}

if($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"]){
    $arPictIds = array_merge((array)array($pictId), (array)$arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"]);
} else {
    $arPictIds = array($pictId);
}

	if($USER->isAdmin())
	{
		//pre($arPictIds);
	}

$arPictIds = array_unique($arPictIds);
foreach($arPictIds as $pictId){
    $smallPict = itc\Resizer::get($pictId, 'elementSmall');
    $middlePict = itc\Resizer::get($pictId, 'elementMiddle');
    $bigPict = itc\Resizer::get($pictId, 'elementBig');

    $arResult["SMALL_PICTS"][] = $smallPict;
    $arResult["MIDDLE_PICTS"][] = $middlePict;
    $arResult["BIG_PICTS"][] = $bigPict;

    $arResult["PICTS_FOR_SCRIPT"][] = array(
        "href" => $bigPict,
        "display" => $middlePict
    );
}

//$arResult["PICTS_FOR_SCRIPT"] = str_replace("'", "&quot;", (string)CUtil::PhpToJSObject($arResult["PICTS_FOR_SCRIPT"]));
$arResult["PICTS_FOR_SCRIPT"] = json_encode($arResult["PICTS_FOR_SCRIPT"]);

/**
 * Определить тип товара
 */
$typeElement = '';
$arTypeElement = $GLOBALS["typeElement"];
foreach($arTypeElement as $type=>$value)
{
	if($type == $arResult['PROPERTIES']['TIPTOVARA']['VALUE'])
	{
		$typeElement = $type;
		$arResult['PROPERTIES']['TIPTOVARA']['TYPE'] = $value;
		break;
	}
}

/**
 * Определить меру товара
 */
$arTypeElement = $GLOBALS["measureElement"];
$arResult['PROPERTIES']['TIPTOVARA']['MEASURE'] = $arTypeElement[$arResult['PROPERTIES']['TIPTOVARA']['TYPE']];

/**
 * Определить количество грамм
 */
$arStepElement = $GLOBALS["stepElement"];
$arResult['PROPERTIES']['TIPTOVARA']['STEP'] = $arStepElement[$typeElement];
unset($typeElement);

/**
 * Передать параметры в component_epilog.php
 */
$this->__component->arResult['MIDDLE_PICTS'] = $arResult['MIDDLE_PICTS'];
$this->__component->SetResultCacheKeys(array('MIDDLE_PICTS'));
?>