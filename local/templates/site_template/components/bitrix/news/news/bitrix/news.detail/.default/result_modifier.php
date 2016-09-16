<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$id = "";
if(is_array($arResult["DETAIL_PICTURE"]))
{
    $id = $arResult["DETAIL_PICTURE"]["ID"];
}
else
{
    $arResult["DETAIL_PICTURE"]["SRC"] = itc\Resizer::get(NO_PH_NEW_BG, 'newsDetail');
    $arResult["DETAIL_PICTURE_BIG"]["SRC"] = itc\Resizer::get(NO_PH_NEW_BG, 'aboutCompanyListDetail');
}
if($id <> "")
{
    $fl = new CFile;

    $arOrder = array();
    $arFilter = array(
        "MODULE_ID" => "iblock",
        "@ID" => $id
    );

    $arDetailPicture = array();

    $rsFile = $fl->GetList($arOrder, $arFilter);

    if($arItem = $rsFile->GetNext())
    {
        $arDetailPicture[$arItem["ID"]] = $arItem;
        $urlDetailPicture = itc\Resizer::get($arItem["ID"], 'newsDetail');

	    $arResult["DETAIL_PICTURE"]["SRC"] = $urlDetailPicture;

	    $arDetailBigPicture[$arItem["ID"]] = $arItem;
	    $urlDetailBigPicture = itc\Resizer::get($arItem["ID"], 'aboutCompanyListDetail');

        $arResult["DETAIL_PICTURE_BIG"]["SRC"] = $urlDetailBigPicture;
    }
}
?>