<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
$arIds = array();
if(is_array($arResult["PROPERTIES"]["MORE_PICTURE"]["VALUE"]))
{
    $index = 0;
    foreach($arResult["PROPERTIES"]["MORE_PICTURE"]["VALUE"] as $value)
    {
        $arIds[] = $value;
    }
    $index++;
}

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
    $arDetailPicture = array();

    $rsFile = $fl->GetList($arOrder, $arFilter);
    while($arItem = $rsFile->GetNext())
    {
        $arPreviewPicture[$arItem["ID"]] = $arItem;
        $urlPreviewPicture = itc\Resizer::get($arItem["ID"], 'aboutCompanyListPreview');

        $arPreviewPicture[$arItem["ID"]]['PREVIEW_PICTURE']["SRC"] = $urlPreviewPicture;

	    $arDetailPicture[$arItem["ID"]] = $arItem;
	    $urlDetailPicture = itc\Resizer::get($arItem["ID"], 'aboutCompanyListDetail');

	    $arDetailPicture[$arItem["ID"]]['DETAIL_PICTURE']["SRC"] = $urlDetailPicture;
    }

	//pre($arResult["PROPERTIES"]["MORE_PICTURE"]);

    foreach($arResult["PROPERTIES"]["MORE_PICTURE"]["VALUE"] as &$value)
    {
        $arResult["PROPERTIES"]["MORE_PICTURE"]["VALUE_SRC"][] =
	        array(
	            'PREVIEW_PICTURE' => array('SRC' => $arPreviewPicture[$value]['PREVIEW_PICTURE']["SRC"]),
	            'DETAIL_PICTURE'  => array('SRC' => $arDetailPicture[$value]['DETAIL_PICTURE']["SRC"])
	        );
    }
    unset($arItem);
}

$arResult["PROPERTIES"]["LOGOTYPE"]["VALUE_SRC"] =  itc\Resizer::get($arResult["PROPERTIES"]["LOGOTYPE"]["VALUE"], 'aboutCompanyLogoType');
?>