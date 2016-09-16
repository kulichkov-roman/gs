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

<div class="newslist">
	<ul class="newslist__list">
		<?if($arParams["DISPLAY_TOP_PAGER"]){?>
			<?=$arResult["NAV_STRING"]?><br />
		<?}?>
		<?foreach($arResult["ITEMS"] as $arItem){
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<li class="newslist__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<div class="newslist__pic-wrap"><img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" class="newslist__pic"></div>
				<div class="newslist__main">
					<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]){?>
						<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])){?>
							<a class="newslist__header" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><b><?=$arItem["NAME"]?></b></a>
						<?} else {?>
							<b><?=$arItem["NAME"]?></b>
						<?}?>
					<?}?>
					<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]){?>
						<div class="newslist__date"><?=$arItem["DISPLAY_ACTIVE_FROM"]?></div>
					<?}?>
					<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]){?>
						<div class="newslist__text"><?=$arItem["PREVIEW_TEXT"];?></div>
					<?}?>
				</div>
			</li>
		<?}?>
	</ul>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]){?>
    <br /><?=$arResult["NAV_STRING"]?>
<?}?>