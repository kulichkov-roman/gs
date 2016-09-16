<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
foreach($arResult["ITEMS"] as &$arItem)
{
	$flag = false;
	if ($arItem["PROPERTY_TYPE"] == "L")
	{
		if(
			$arItem["CODE"] == "NOVINKA" ||
			$arItem["CODE"] == "AKTSII"  ||
			$arItem["CODE"] == "KHIT"
		)
		{
			$class = '';

			if(sizeof($arItem['VALUES']) > 0)
			{
				$flag = true;
			}

			switch($arItem["CODE"])
			{
				case 'NOVINKA':
					$class = '_new';
					break;
				case 'AKTSII':
					$class = '_promo';
					break;
				case 'KHIT':
					$class = '_hit';
					break;
			}

			foreach($arItem["VALUES"] as $val => &$ar)
			{
				$ar['LINK_CLASS'] = $class;
				$ar['FILTER_LINK'] = '?'.$ar["CONTROL_NAME"]."=Y&set_filter=Показать";
			}

			if($flag)
			{
				$arResult["SHOW_HIT"] = true;
			}
			else
			{
				$arResult["SHOW_HIT"] = false;
			}
		}
	}
}
unset($arItem, $ar);
?>