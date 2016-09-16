<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
foreach($arResult["ITEMS"] as $key => $arItem){
	$arItem["DISPLAY_PREVIEW_PICTURE"] = CFile::ResizeImageGet(
		$arItem["PREVIEW_PICTURE"]["ID"],
		array(
			"width" => 475,
			"height" => 213
		),
		BX_RESIZE_IMAGE_EXACT
	);
	$arResult["ITEMS"][$key] = $arItem;
}?>
