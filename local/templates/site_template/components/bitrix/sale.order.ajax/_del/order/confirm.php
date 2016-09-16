<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$APPLICATION -> SetTitle("Мой заказ");
$APPLICATION -> SetPageProperty("title", "Мой заказ");

if($arResult["ORDER"]){?>
	<div class="myorder">
	    <p class="myorder__header">Ваш заказ оформлен.</p>
	    <p class="myorder__text">В течение 5 минут наши операторы свяжутся с вами по указанному телефону.</p>
		<div class="myorder__warning"><strong class="myorder__warning-title">Обратите внимание!</strong>
			<p class="myorder__warning-text">Стоимость весового товара указана с учетом выбранного вами веса. Итоговая стоимость может отличаться и будет согласована с вами оператором при подтверждении заказа по телефону.</p>
		</div>
	    <p class="myorder__number">Заказ №<?=$arResult["ORDER"]["ID"]?></p>
	    <?if($arResult["BASKET_ITEMS"]){?>
		    <ul class="myorder__list">
		    	<?foreach($arResult["BASKET_ITEMS"] as $arBasket){?>
			        <li class="myorder__item">
			            <div class="myorder__item-name"><?=$arBasket["NAME"]?></div>
			            <div class="myorder__item-price"><?=getPrintFormatPrice(multiplyPrice($arBasket["PRICE"], $arBasket['PROPERTIES']['TIPTOVARA']['VALUE']), 'руб./кг')?></div>
			            <div class="myorder__item-weight"><?=$arBasket["QUANTITY"] * $arBasket['PROPERTIES']['TIPTOVARA']["STEP"]?> <?=$arBasket['PROPERTIES']['TIPTOVARA']['MEASURE']?></div>
			            <div class="myorder__item-summ"><?=getPrintFormatPrice($arBasket["QUANTITY"] * $arBasket["PRICE"])?></div>
			            <?$arResult["ORDER_PRICE_FORMATED"] += $arBasket["QUANTITY"] * $arBasket["PRICE"];?>
			        </li>
		        <?}?>
		    </ul>
	    <?}?>
	    <div class="myorder__separator"></div>
	    <div class="myorder__sale">Скидка (-3%):</div>
	    <div class="myorder__sale-summ">44.90 руб.</div>
		<div class="myorder__total"><?=$arResult["DELIVERY"]["NAME"]?>:</div>
		<div class="myorder__total-summ"><?if($arResult["DELIVERY"]["PRICE"] != "0.00"){?><?=getPrintFormatPrice($arResult["DELIVERY"]["PRICE"], 'руб.')?><?}else{?>бесплатно<?}?></div>
	    <div class="myorder__total">К оплате:</div>
	    <div class="myorder__total-summ"><?=getPrintFormatPrice($arResult["ORDER_PRICE_FORMATED"], 'руб.')?></div><a href="/catalog/" class="myorder__link _wanna">Хочу еще!</a><a href="/" class="myorder__link">Главная</a>
	</div>
<?}?>