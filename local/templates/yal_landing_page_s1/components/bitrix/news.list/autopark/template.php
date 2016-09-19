<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);	?>

<div class="catalog">
	<ul class="catalog__list">
		<?foreach($arResult["ITEMS"] as $arItem){
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>
			<li class="catalog__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<div class="catalog__content">
					<div class="catalog__title">
						<?=$arItem["NAME"]?>
						<?if($arItem["PROPERTIES"]["PRICE"]["VALUE"]){?>
							<span class="catalog__price">
								<?=$arItem["PROPERTIES"]["PRICE"]["VALUE"]?>
							</span>
						<?}?>
					</div>
					<div class="catalog__img-wrap">
						<img src="<?=$arItem["DISPLAY_PREVIEW_PICTURE"]["src"]?>" alt="" class="catalog__img">
					</div>
					<div class="catalog__description">
						<div class="catalog__properties">
							<ul class="list2">
								<?foreach($arItem["DISPLAY_PROPERTIES"] as $arProperty){?>
									<li><?=$arProperty["NAME"]?>: <?=$arProperty["VALUE"]?></li>
								<?}?>
							</ul>
						</div>
						<?if($arItem["PROPERTIES"]["FILE"]["VALUE"]){?>
							<a target="_blank" href="<?=CFile::GetPath($arItem["PROPERTIES"]["FILE"]["VALUE"]);?>">Технические характеристики в pdf</a><br><br>
						<?}?>
						<input type="submit" class="form__submit btn2" value="Заказать">
					</div>
				</div>
			</li>
		<?}?>
	</ul>
</div>
