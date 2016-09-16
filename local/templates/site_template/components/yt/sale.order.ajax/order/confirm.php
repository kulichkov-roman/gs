<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$APPLICATION -> SetTitle("Мой заказ");
$APPLICATION -> SetPageProperty("title", "Мой заказ");

if($USER->isAdmin())
{
	// pre($arResult["DELIVERY"]);
}

if($arResult["ORDER"]){?>
	<div class="myorder">
	    <p class="myorder__header">Ваш заказ оформлен.</p>
	    <p class="myorder__text">В течение 20 минут наши операторы свяжутся с вами по указанному телефону.</p>
		<div class="myorder__warning"><strong class="myorder__warning-title">Обратите внимание!</strong>
			<p class="myorder__warning-text">Стоимость весового товара указана с учетом выбранного вами веса. Итоговая стоимость может отличаться и будет согласована с вами оператором при подтверждении заказа по телефону.</p>
		</div>
	    <p class="myorder__number">Заказ №<?=$arResult["ORDER"]["ACCOUNT_NUMBER"]?></p>
	    <?if($arResult["BASKET_ITEMS"]){?>
		    <ul class="myorder__list">
		    	<?foreach($arResult["BASKET_ITEMS"] as $arBasket){?>
			        <li class="myorder__item">
			            <div class="myorder__item-name"><?=$arBasket["NAME"]?></div>
			            <div class="myorder__item-price"><?=getPrintFormatPrice(multiplyPrice($arBasket["PRICE"], $arBasket['PROPERTIES']['TIPTOVARA']['VALUE']), $currency = $arBasket['PROPERTIES']['TIPTOVARA']['MEASURE_PRICE'])?></div>
			            <div class="myorder__item-weight"><?=$arBasket["QUANTITY"] * $arBasket['PROPERTIES']['TIPTOVARA']["STEP"]?> <?=$arBasket['PROPERTIES']['TIPTOVARA']['MEASURE']?></div>
			            <div class="myorder__item-summ"><?=getPrintFormatPrice($arBasket["QUANTITY"] * $arBasket["PRICE"])?></div>
			            <?$arResult["ORDER_PRICE_FORMATED"] += $arBasket["QUANTITY"] * $arBasket["PRICE"];?>
			        </li>
		        <?}?>
		    </ul>
	    <?}?>
	    <div class="myorder__separator"></div>
		<?if($arResult["DISCOUNT_DIFF"] > 0) {?>
			<div class="myorder__sale">В том числе скидка (<?=$arResult['DISCOUNT_AVR']?>%):</div>
			<div class="myorder__sale-summ">-<?=getPrintFormatPrice($arResult["DISCOUNT_DIFF"], 'руб.')?></div>
		<?}?>
		<div class="myorder__total"><?=$arResult["DELIVERY"] <> "" ? $arResult["DELIVERY"]["DESCRIPTION"].' ' : '';?><?=$arResult["DELIVERY"]["NAME"]?>:</div>
		<div class="myorder__total-summ"><?if($arResult["DELIVERY"]["PRICE"] != "0.00"){?><?=getPrintFormatPrice($arResult["DELIVERY"]["PRICE"], 'руб.')?><?}else{?>бесплатно<?}?></div>
	    <div class="myorder__total">К оплате:</div>
	    <div class="myorder__total-summ"><?=getPrintFormatPrice($arResult["ORDER_PRICE_FORMATED"] + $arResult["DELIVERY"]["PRICE"], 'руб.')?></div><a href="/catalog/" class="myorder__link _wanna">Хочу еще!</a><a href="/" class="myorder__link">Главная</a>
	</div>
<?}?>
<?
/*if (!empty($arResult["ORDER"]))
{
	?>
	<b><?=GetMessage("SOA_TEMPL_ORDER_COMPLETE")?></b><br /><br />
	<table class="sale_order_full_table">
		<tr>
			<td>
				<?= GetMessage("SOA_TEMPL_ORDER_SUC", Array("#ORDER_DATE#" => $arResult["ORDER"]["DATE_INSERT"], "#ORDER_ID#" => $arResult["ORDER"]["ACCOUNT_NUMBER"]))?>
				<br /><br />
				<?= GetMessage("SOA_TEMPL_ORDER_SUC1", Array("#LINK#" => $arParams["PATH_TO_PERSONAL"])) ?>
			</td>
		</tr>
	</table>
	<?
	if (!empty($arResult["PAY_SYSTEM"]))
	{
		?>
		<br /><br />

		<table class="sale_order_full_table">
			<tr>
				<td class="ps_logo">
					<div class="pay_name"><?=GetMessage("SOA_TEMPL_PAY")?></div>
					<?=CFile::ShowImage($arResult["PAY_SYSTEM"]["LOGOTIP"], 100, 100, "border=0", "", false);?>
					<div class="paysystem_name"><?= $arResult["PAY_SYSTEM"]["NAME"] ?></div><br>
				</td>
			</tr>
			<?
			if (strlen($arResult["PAY_SYSTEM"]["ACTION_FILE"]) > 0)
			{
				?>
				<tr>
					<td>
						<?
						if ($arResult["PAY_SYSTEM"]["NEW_WINDOW"] == "Y")
						{
							?>
							<script language="JavaScript">
								window.open('<?=$arParams["PATH_TO_PAYMENT"]?>?ORDER_ID=<?=urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]))?>');
							</script>
							<?= GetMessage("SOA_TEMPL_PAY_LINK", Array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]))))?>
							<?
							if (CSalePdf::isPdfAvailable() && CSalePaySystemsHelper::isPSActionAffordPdf($arResult['PAY_SYSTEM']['ACTION_FILE']))
							{
								?><br />
								<?= GetMessage("SOA_TEMPL_PAY_PDF", Array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]))."&pdf=1&DOWNLOAD=Y")) ?>
								<?
							}
						}
						else
						{
							if (strlen($arResult["PAY_SYSTEM"]["PATH_TO_ACTION"])>0)
							{
								include($arResult["PAY_SYSTEM"]["PATH_TO_ACTION"]);
							}
						}
						?>
					</td>
				</tr>
				<?
			}
			?>
		</table>
		<?
	}
}
else
{
	?>
	<b><?=GetMessage("SOA_TEMPL_ERROR_ORDER")?></b><br /><br />

	<table class="sale_order_full_table">
		<tr>
			<td>
				<?=GetMessage("SOA_TEMPL_ERROR_ORDER_LOST", Array("#ORDER_ID#" => $arResult["ACCOUNT_NUMBER"]))?>
				<?=GetMessage("SOA_TEMPL_ERROR_ORDER_LOST1")?>
			</td>
		</tr>
	</table>
	<?
}*/
?>
