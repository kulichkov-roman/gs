<?
use Bitrix\Main\Type\Collection;
use Bitrix\Currency\CurrencyTable;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$arSectionNames = array();
$arSectionId = array();
foreach($arResult["ITEMS"] as $arItem){
	$arSectionId[] = $arItem["IBLOCK_SECTION_ID"];
}

if($arSectionId){
	CModule::IncludeModule('iblock');
	$arFilter = array(
	    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
	    "ACTIVE"    => "Y",
	    "ID" => $arSectionId
	);
	$rsSections = CIBlockSection::GetList(
	    array(),
	    $arFilter
	);
	while($arSection = $rsSections->GetNext()) {
		$sectionId = $arSection["ID"];
		if($arSection["DEPTH_LEVEL"] == 2){
			$arParentSection = CIBlockSection::GetByID($arSection["IBLOCK_SECTION_ID"]) -> GetNext();
			$arSection["NAME"] = $arParentSection["NAME"];
			$arSection["ID"] = $arParentSection["ID"];
		}
	    
	    $arResult["SECTION_INFO"][$sectionId] = array(
	    	"NAME" => $arSection["NAME"],
	    	"ID" => $arSection["ID"]
	    );
	}
}
?>