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
?>

<div class="articleslist">
	<ul class="articleslist__list">
		<?foreach($arResult["ITEMS"] as $arItem){
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<li class="articleslist__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<h3 class="articleslist__header">
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="articleslist__header-link"><?=$arItem["NAME"]?></a>
				</h3>
				<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]){?>
					<div class="articleslist__text"><?=$arItem["PREVIEW_TEXT"];?></div>
				<?}?>
			</li>
		<?}?>
	</ul>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]){?>
	<br /><?=$arResult["NAV_STRING"]?>
<?}?>