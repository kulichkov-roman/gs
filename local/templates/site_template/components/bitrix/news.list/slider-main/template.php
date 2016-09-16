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
<section data-interval="5000" class="header-slider">
	<ul class="header-slider__list">
		<?$first = true;?>
		<?foreach($arResult["ITEMS"] as $arItem){?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<li style="background-image: url(<?=$arItem['PREVIEW_PICTURE']['SRC']?>)" class="header-slider__item <?=$first ? '_active' : ''?>"></li>
			<?$first = false;?>
		<?}?>
	</ul>
</section>
<section class="header-slider-content">
	<div class="header-slider-content__inner">
		<div class="header-slider-content__box">
			<ul class="header-slider-content__box-list">
				<?$first = true;?>
				<?foreach($arResult["ITEMS"] as $arItem){?>
					<li class="header-slider-content__box-item <?=$first ? '_active' : '';?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
						<h3 class="header-slider-content__title">
							<span class="header-slider-content__title-text">
								<?=TruncateText($arItem['NAME'], 23)?>
							</span>
						</h3>
						<div class="header-slider-content__text">
							<?if($arItem['PREVIEW_TEXT']){?>
								<?=$arItem['PREVIEW_TEXT']?>
							<?}?>
						</div>
					</li>
					<?$first = false;?>
				<?}?>
			</ul>
			<div class="header-slider-content__nav">
				<?$first = true;?>
				<?foreach($arResult["ITEMS"] as $arItem){?>
					<button type="button" class="header-slider-content__nav-btn <?=$first ? '_active' : '';?>"></button>
					<?$first = false;?>
				<?}?>
			</div>
		</div>
	</div>
</section>
