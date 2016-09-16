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

<div class="rewards-slider">
	<div class="rewards-slider__inner">
		<?foreach($arResult["ITEMS"] as $arItem){?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<div class="rewards-slider__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<a
					href="<?=$arItem['DETAIL_PICTURE']['SRC']?>" rel="fancybox-rewards"
					data-header="<?=$arItem['NAME']?>"
					title="<?=$arItem['PREVIEW_TEXT']?>"
					class="rewards-slider__link _fancybox"
				>
					<img
						src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>"
						alt="<?=$arItem['NAME']?>"
						class="rewards-slider__img"
					>
					<strong class="rewards-slider__title">
						<?=$arItem['NAME']?>
					</strong>
					<?if($arItem['PREVIEW_TEXT']){?>
						<div class="rewards-slider__text">
							<?=$arItem['PREVIEW_TEXT']?>
						</div>
					<?}?>
					<?if($arItem['PROPERTIES']['DATE_CERT']['VALUE']){?>
						<span class="rewards-slider__date"><?=$arItem['PROPERTIES']['DATE_CERT']['VALUE']?></span>
					<?}?>
				</a>
			</div>
		<?}?>
	</div>
</div>
