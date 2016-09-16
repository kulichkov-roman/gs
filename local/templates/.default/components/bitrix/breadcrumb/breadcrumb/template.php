<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//delayed function must return a string
global $USER;
if($USER->isAdmin())
{
	//pre($arResult);
}

if(empty($arResult))
	return "";
	
$strReturn = '<div class="breadcrumbs">';

$num_items = count($arResult);
for($index = 0, $itemSize = $num_items; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);

	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
	{
		$strReturn .= '<a class="breadcrumbs__item" href="'.$arResult[$index]["LINK"].'" title="'.$title.'">'.$title.'</a>';
	}
	else
	{
		if(htmlspecialcharsbx($_GET["set_filter"]) <> ''){
			$strReturn .= '<a class="breadcrumbs__item" href="'.$arResult[$index]["LINK"].'" title="'.$title.'">'.$title.'</a>';
		} else {
			$strReturn .= '<a class="breadcrumbs__item" href="javascript:void(0)">'.$title.'</a>';
		}
	}
}

$strReturn .= '</div>';

return $strReturn;
?>