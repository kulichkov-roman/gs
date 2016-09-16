<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

if($USER->isAdmin())
{
	//echo "<pre>"; var_dump($arResult["ITEMS"]); echo "</pre>";
}
?>

<div class="catalog__show">
	<?if($arResult["SHOW_HIT"]){?>
		<span class="catalog__sort-text">Показать  —  </span>
	<?}?>
	<?foreach($arResult["ITEMS"] as $arItem){
		if($arItem["PROPERTY_TYPE"] == "L"){
			if(
				$arItem["CODE"] == "NOVINKA" ||
				$arItem["CODE"] == "AKTSII"  ||
				$arItem["CODE"] == "KHIT"
			) {
				?>
				<?foreach($arItem["VALUES"] as $val => $ar) {?>
					<a href="<?=$ar['FILTER_LINK']?>" class="catalog__sort-text <?=$ar['LINK_CLASS']?> _link"><?=$arItem["NAME"];?></a>
					<?
				}
			}
		}
	}?>
</div>
