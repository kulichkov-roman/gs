<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

/*
 * получить список изображений для разделов каталога
 */
$arSort = array();
$arSelect = array(
    'ID',
    'NAME',
    'PREVIEW_PICTURE',
    'PROPERTY_LINK_SECTION',
);
$arFilter = array("IBLOCK_ID" => CATALOG_SECTION_IMG_ID);

$rsElements = CIBlockElement::GetList(
    $arSort,
    $arFilter,
    false,
    false,
    $arSelect
);

$arElement = array();
while ($arItem = $rsElements->GetNext())
{
    $arElement[$arItem['PROPERTY_LINK_SECTION_VALUE']] = $arItem;
}

foreach($arResult["SECTIONS"] as &$arSection)
{
    $arSection['PICTURE'] = $arElement[$arSection['ID']];
}
unset($arSection);

/*
 * уменьшить изображения разделов каталога
 * */
$arIds = array();
foreach($arResult["SECTIONS"] as &$arSection)
{
    if(is_array($arSection["PICTURE"]) && $arSection["PICTURE"]["PREVIEW_PICTURE"])
    {
        $arIds[] = $arSection["PICTURE"]["PREVIEW_PICTURE"];
    }
}
unset($arSection);

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
        $urlPreviewPicture = itc\Resizer::get($arItem["ID"], 'catalogMainList');

        $arPreviewPicture[$arItem["ID"]]["SRC"] = $urlPreviewPicture;
    }

    foreach($arResult["SECTIONS"] as &$arSection)
    {
        if(is_array($arSection["PICTURE"]))
        {
            $arSection["PICTURE"]["SRC"] = $arPreviewPicture[$arSection["PICTURE"]["PREVIEW_PICTURE"]]["SRC"];
        }
        else
        {
            $arSection["PICTURE"]["SRC"] = itc\Resizer::get(NO_PH_CAT_GP, 'catalogMainList');
        }
    }
    unset($arSection);
}
else
{
    foreach($arResult["SECTIONS"] as &$arSection)
    {
        $arSection["PICTURE"]["SRC"] = itc\Resizer::get(NO_PH_CAT_GP, 'catalogMainList');
    }
    unset($arSection);
}
?>