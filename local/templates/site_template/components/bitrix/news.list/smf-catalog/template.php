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

<?$class = sizeof($arResult) % 2 == 0 ? '_odd' : '';?>
<div class="products <?=$class?>">
	<?foreach($arResult["ITEMS"] as $arItem){
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<article class="products-item _part-3" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<span class="products-item__corner"></span>
				<div class="products-item__img-h"><img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['DETAIL_PICTURE']['DESCRIPTION']?>" title="<?=$arItem['DETAIL_PICTURE']['DESCRIPTION']?>" class="products-item__img"></div>
				<div class="products-item__inner">
					<h3 class="products-item__title"><span class="products-item__title-text"><?=$arItem['NAME']?></span></h3>
					<div class="products-item-info">
						<?if($arItem['PROPERTIES']['PRICE_PICKUP']['VALUE']){?>
							<div class="products-item-info__item"><span class="products-item-info__item-text">Самовывоз -&#32;<span class="products-item-info__item-value"><?=$arItem['PROPERTIES']['PRICE_PICKUP']['VALUE']?></span>&#32;р/кг,</span></div>
						<?}?>
						<?if($arItem['PROPERTIES']['PRICE_DELIVERY']['VALUE']){?>
							<div class="products-item-info__item"><span class="products-item-info__item-text">Доставка -&#32;<span class="products-item-info__item-value"><?=$arItem['PROPERTIES']['PRICE_DELIVERY']['VALUE']?></span>&#32;р/кг</span>
								<?if($arItem['PROPERTIES']['PRICE_DELIVERY']['DESCRIPTION']){?>
									<span class="products-item-info__item-notice">&#32;(<?=$arItem['PROPERTIES']['PRICE_DELIVERY']['DESCRIPTION']?>)</span>
								<?}?>
							</div>
						<?}?>
					</div>
					<?if($arItem['PREVIEW_TEXT'] <> ''){?>
						<div class="products-item__description">
							<?=$arItem['PREVIEW_TEXT']?>
						</div>
					<?}?>
					<?if(is_array($arItem['PROPERTIES']['COMPOSITION']['VALUE']) && sizeof($arItem['PROPERTIES']['COMPOSITION']['VALUE'])){?>
						<div class="products-item-composition"><strong class="products-item-composition__title">Состав</strong>
							<ul class="products-item-composition__list">
								<?foreach($arItem['PROPERTIES']['COMPOSITION']['VALUE'] as $key => $value){?>
									<li class="products-item-composition__item"><span class="products-item-composition__item-value">- <?=$value?></span>
										<?if($arItem['PROPERTIES']['COMPOSITION']['DESCRIPTION'][$key]){?>
											<span class="products-item-composition__item-notice">(<?=$arItem['PROPERTIES']['COMPOSITION']['DESCRIPTION'][$key]?>)</span>
										<?}?>
									</li>
								<?}?>
							</ul>
						</div>
					<?}?>
				</div>
		</article>
	<?}?>
</div>
