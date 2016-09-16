<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if($USER->isAdmin())
{
	//pre($arResult);
}

$arResult["ORDER_TOTAL_PRICE"] = str_replace(" ", "", $arResult["ORDER_TOTAL_PRICE_FORMATED"]);
?>
<div class="forming__box _goods">
	<div class="forming__header">Состав заказа</div>
	<table cellspacing="0" class="forming__list">
		<tr class="forming__list-head">
			<td class="forming__list-article">Арт</td>
			<td class="forming__list-name">Наименование</td>
			<td class="forming__list-cost">Цена</td>
			<td class="forming__list-weight">Количество</td>
			<td class="forming__list-sum">Стоимость</td>
		</tr>
		<?foreach($arResult["BASKET_ITEMS"] as $arBasket){
			$productId = $arBasket["PRODUCT_ID"];
			?>
			<tr class="forming__list-row">
				<td class="forming__list-article"><?=$arResult["PRODUCTS"][$productId]["PROPERTIES"]["CML2_ARTICLE"]["VALUE"]?></td>
				<td class="forming__list-name"><a href="<?=$arBasket["DETAIL_PAGE_URL"]?>"><?=$arBasket["NAME"]?></a></td>
				<td class="forming__list-cost">
					<?=getPrintFormatPrice(multiplyPrice($arBasket["PRICE"], $arBasket['PROPERTIES']['TIPTOVARA']['VALUE']), $arBasket['PROPERTIES']['TIPTOVARA']['MEASURE_PRICE'])?>
					<?if($arBasket['DISCOUNT_PRICE'] > 0) {?>
						<div class="forming__old-price">
							<?=getPrintFormatPrice(multiplyPrice($arBasket['DISCOUNT_PRICE'] * $arBasket['DISCOUNT_PRICE_PERCENT'], $arBasket['PROPERTIES']['TIPTOVARA']['VALUE']), $arBasket['PROPERTIES']['TIPTOVARA']['MEASURE_PRICE'])?>
						</div>
					<?}?>
				</td>
				<td class="forming__list-weight"><?=$arBasket["QUANTITY"] * $arBasket['PROPERTIES']['TIPTOVARA']["STEP"]?> <?=$arBasket['PROPERTIES']['TIPTOVARA']['MEASURE']?></td>
				<td class="forming__list-sum"><?=getPrintFormatPrice($arBasket["QUANTITY"] * $arBasket["PRICE"])?></td>
			</tr>
		<?}?>
	</table>
	<div class="forming__goods-separator"></div>
	<table cellspacing="0" class="forming__goods-bottom">
		<tr class="forming__result">
			<td class="forming__goods-bottom-name">Товаров на:</td>
			<td class="forming__goods-bottom-sum"><?=getPrintFormatPrice($arResult["ORDER_PRICE"], 'руб.', 'forming__goods-bottom-num')?></td>
		</tr>
		<tr class="forming__sale">
			<td class="forming__goods-bottom-name">Скидка по карте (n%):</td>
			<td class="forming__goods-bottom-sum"><span class="forming__goods-bottom-num">44,90</span> руб.</td>
		</tr>
		<?foreach($arResult['DELIVERY'] as $arItem){?>
			<?if($arItem['CHECKED'] == 'Y'){
				?>
				<tr class="forming__delivery">
					<td class="forming__goods-bottom-name"><a class="forming__delivery-link" href="<?=DELIVERY_PAYMENT_URL?>"><?=$arItem['NAME']?></a>:</td>
					<td class="forming__goods-bottom-sum"><?if($arItem["PRICE"] != "0.00"){?><?=getPrintFormatPrice($arItem['PRICE'], 'руб.')?><?}else{?>Бесплатно<?}?></td>
				</tr>
			<?}?>
		<?}?>
		<tr class="forming__final">
			<td class="forming__goods-bottom-name">Итого к оплате:</td>
			<td class="forming__goods-bottom-sum"><?=getPrintFormatPrice($arResult["ORDER_TOTAL_PRICE"], 'руб.', 'forming__goods-bottom-num')?></td>
		</tr>
	</table>
</div>
<div class="forming__box _addition">
	<div class="forming__header">Дополнительная информация</div>
	<div class="forming__field-wrapper">
		<p class="forming__field-text">Комментарии к заказу:</p>
		<textarea name="ORDER_DESCRIPTION" class="forming__area _big"><?=$arResult["USER_VALS"]["ORDER_DESCRIPTION"]?></textarea>
        <input type="hidden" name="" value="">
	</div>
</div>
