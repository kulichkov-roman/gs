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

//echo "<pre>"; var_dump($arResult); echo "</pre>";
?>
<h2 class="article__header"><?=$arResult['NAME']?></h2>
<div class="article__content">
	<?if($arResult['DETAIL_TEXT'] <> ""){?>
		<?=$arResult['DETAIL_TEXT']?>
	<?}?>
</div>
<?itc\CUncachedArea::show('showOtherArticles')?>