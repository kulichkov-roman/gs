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
	//pre($arResult['ITEMS']);
}
?>

<?if (!empty($arResult['ITEMS'])){?>
	<div class="catalog__list">
		<?foreach($arResult['ITEMS'] as $arItem){
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT'));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));?>
			<div
				class="offer-item"
				data-product-id="<?=$arItem['ID']?>"
				id="<?=$this->GetEditAreaId($arItem['ID']);?>"
				>
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="offer-item__link">
					<?if(
						$arItem["PROPERTIES"]["NOVINKA"]["VALUE"] == "Y" ||
						$arItem["PROPERTIES"]["AKTSII"]["VALUE"] == "Y"  ||
						$arItem["PROPERTIES"]["KHIT"]["VALUE"] == "Y"
					){?>
						<div class="offer-item__bar-box">
							<?if($arItem["PROPERTIES"]["NOVINKA"]["VALUE"] == "Y"){?>
								<img src="/images/label-new.png" class="offer-item__label">
							<?}?>
							<?if($arItem["PROPERTIES"]["AKTSII"]["VALUE"] == "Y"){?>
								<img src="/images/label-promo.png" class="offer-item__label">
							<?}?>
							<?if($arItem["PROPERTIES"]["KHIT"]["VALUE"] == "Y"){?>
								<img src="/images/label-hit.png" class="offer-item__label">
							<?}?>
						</div>
					<?}?>
					<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="" class="offer-item__pic">
					<div class="offer-item__descr">
						<span class="offer-item__name"><?=$arItem["NAME"]?></span>
						<?
						/**
						 * Цены и скидки вынесены в некешируемые области.
						 */
						itc\CUncachedArea::show('showElementGoodsPrice'.$arItem['ID']);
						?>
					</div>
				</a>
				<div class="offer-item__add">
					<div class="offer-item__form">
						<span class="offer-item__less"></span>
						<input readonly="readonly" <?if($arItem["PROPERTIES"]["MIN_LIMIT"]["VALUE"] <> ''){?>data-min="<?=$arItem["PROPERTIES"]["MIN_LIMIT"]["VALUE"]?>"<?} else {?><?=$arItem['PROPERTIES']['TIPTOVARA']['STEP'] <> '' ? 'data-min="'.$arItem['PROPERTIES']['TIPTOVARA']['STEP'].'"' : "";?><?}?> <?=$arItem['PROPERTIES']['TIPTOVARA']['STEP'] <> '' ? 'data-step="'.$arItem['PROPERTIES']['TIPTOVARA']['STEP'].'"' : "";?> <?=$arItem['PROPERTIES']['TIPTOVARA']['TYPE'] <> '' ? 'data-type="'.$arItem['PROPERTIES']['TIPTOVARA']['TYPE'].'"' : "";?> type="text" <?itc\CUncachedArea::show('showBasketQuantity'.$arItem['ID']);?> maxlength="5" class="offer-item__field">
						<span class="offer-item__form-text"><?=$arItem['PROPERTIES']['TIPTOVARA']['MEASURE'] <> "" ? $arItem['PROPERTIES']['TIPTOVARA']['MEASURE'] : '';?></span>
						<span class="offer-item__more"></span>
					</div>
					<div class="offer-item__cart"><span class="offer-item__cart-pic"></span></div>
				</div>
			</div>
		<?}?>
	</div>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"] && !isset($_GET['SHOWALL_1'])){?>
		<?=$arResult["NAV_STRING"]?>
	<?}?>
<?}?>