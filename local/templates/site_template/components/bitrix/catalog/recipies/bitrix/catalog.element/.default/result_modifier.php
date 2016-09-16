<?
use Bitrix\Main\Type\Collection;
use Bitrix\Currency\CurrencyTable;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

$arIconIds = $arResult["PROPERTIES"]["ICONS"]["VALUE"];

CModule::IncludeModule('iblock');

if($arIconIds){
	$arFilter = array(
	    "IBLOCK_ID" => RECIPE_ICONS_IBLOCK_ID,
	    "ACTIVE"    => "Y",
	    "ID" => $arIconIds
	);
	$rsElements = CIBlockElement::GetList(
	    array("SORT" => "ASC"),
	    $arFilter
	);
	$arIcons = array();
	while($obElement = $rsElements->GetNextElement()) {
		$arElement = $obElement -> GetFields();
		$arElement["PROPERTIES"] = $obElement -> GetProperties();

		$arIcons[ $arElement["ID"] ] = $arElement;
	}
}

$rsSection = CIBlockSection::GetNavChain($arParams["IBLOCK_ID"], $arResult["IBLOCK_SECTION_ID"]);
$arSections = array();
while($arSection = $rsSection -> GetNext()){
	$arSections[] = $arSection;
}

$arResult["CATEGORY"] = $arSections[0]["NAME"];
$arResult["BACK_URL"] = $arSections[0]["SECTION_PAGE_URL"];

$arResult["SUB_CATEGORY"] = $arResult["PROPERTIES"]["CUISINE"]["VALUE"]/*$arSections[1]["NAME"]*/;

$arResult["ICONS"] = $arIcons;
?>