<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);	?>
<?if($arResult["ITEMS"]){?>
<h2 class="section__header"><?=GetMessage("OUR_CAR_PARK")?></h2>
<div class="catalog">
	<ul class="catalog__list">
		<?foreach($arResult["ITEMS"] as $arItem){
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>
		<li class="catalog__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<div class="catalog__content">
				<div class="catalog__img-wrap">
					<img src="<?=$arItem["DISPLAY_PREVIEW_PICTURE"]["src"]?>" alt="<?=$arItem["NAME"]?>" class="catalog__img">
				</div>
				<div class="catalog__description">
					<div class="catalog__title"><?=$arItem["NAME"]?></div>
					<div class="catalog__properties">
						<?foreach($arItem["DISPLAY_PROPERTIES"] as $arProperty){?>
							<?=$arProperty["NAME"]?>: <?=$arProperty["VALUE"]?><br />
						<?}?>
					</div>
					<span class="catalog__price"><?=$arItem["PROPERTIES"]["PRICE"]["VALUE"]?></span>
				</div>
			</div>
		</li>
		<?}?>
	</ul>
</div>
<?}?>