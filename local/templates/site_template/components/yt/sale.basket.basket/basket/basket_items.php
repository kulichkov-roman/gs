<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Sale\DiscountCouponsManager;

if($USER->isAdmin())
{
    //pre($arResult);
}
?>
<ul class="cart__list">
    <?foreach ($arResult["GRID"]["ROWS"] as $k => $arItem){
        if ($arItem["DELAY"] == "N" && $arItem["CAN_BUY"] == "Y"){?>
            <li data-product-id="<?=$arItem["PRODUCT_ID"]?>" data-product-quantity="<?=$arItem["QUANTITY"]?>" class="cart__item">
	            <a class="cart__item-delete" href="<?=str_replace("#ID#", $arItem["ID"], $arUrls["delete"])?>"></a>
                <div class="cart__item-pic-wrap">
	                <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
	                    <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" class="cart__item-pic">
		            </a>
                </div>
                <div class="cart__item-info">
	                <p class="cart__item-name">
						<span class="cart__item-name-inner">
							<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="cart__item-name-link"><?=htmlspecialcharsBack($arItem["NAME"]);?></a>
						</span>
	                </p>
	                <?
		            /**
		             * Если есть скидки
		             */
		            if(intval($arItem['DISCOUNT_PRICE_PERCENT']) > 0){?>
			            <p class="cart__item-price _new-price">
							<?=getPrintFormatPrice(multiplyPrice($arItem['PRICE'], $arItem['PROPERTIES']['TIPTOVARA']['VALUE']), $currency = $arItem['PROPERTIES']['TIPTOVARA']['MEASURE_PRICE'], $class = 'cart__item-main-price', 'wh_tenth')?>
			            </p>
			            <p class="cart__item-price _old-price">
							<?=getPrintFormatPrice(multiplyPrice($arItem['FULL_PRICE'], $arItem['PROPERTIES']['TIPTOVARA']['VALUE']), $currency = $arItem['PROPERTIES']['TIPTOVARA']['MEASURE_PRICE'], $class = 'cart__item-main-price', 'wh_tenth')?>
			            </p>
		            <?} else {?>
	                    <p class="cart__item-price">
			                <?
			                /**
			                 * Вариант без скидки
			                 */
			                if($arItem['PROPERTIES']['TIPTOVARA']['VALUE'] <> ""){?>
				                <?=getPrintFormatPrice(multiplyPrice($arItem['PRICE'], $arItem['PROPERTIES']['TIPTOVARA']['VALUE']), $currency = $arItem['PROPERTIES']['TIPTOVARA']['MEASURE_PRICE'], $class = 'cart__item-main-price', 'wh_tenth')?>
			                <?}?>
	                    </p>
		            <?}?>
                </div>
                <div class="cart__item-form">
	                <?
		            $ratio = $arItem["MEASURE_RATIO"] = $arItem['PROPERTIES']['TIPTOVARA']['STEP'] <> '' ? $arItem['PROPERTIES']['TIPTOVARA']['STEP'] : "0";

		            if (!isset($arItem["MEASURE_RATIO"])) {
			            $arItem["MEASURE_RATIO"] = $ratio;
		            }

		            if(floatval($arItem["MEASURE_RATIO"]) != 0){?>
	                    <a href="javascript:void(0);" class="cart__item-less"></a>
	                <?}?>
			        <input
		                type="text"
		                <?if($arItem["PROPERTIES"]["MIN_LIMIT"]["VALUE"] <> ''){?>data-min="<?=$arItem["PROPERTIES"]["MIN_LIMIT"]["VALUE"]?>"<?} else {?><?=$arItem['PROPERTIES']['TIPTOVARA']['STEP'] <> '' ? 'data-min="'.$arItem['PROPERTIES']['TIPTOVARA']['STEP'].'"' : "";?><?}?>
				        <?=$arItem['PROPERTIES']['TIPTOVARA']['STEP'] <> '' ? 'data-step="'.$arItem['PROPERTIES']['TIPTOVARA']['STEP'].'"' : "";?>
		                <?=$arItem['PROPERTIES']['TIPTOVARA']['TYPE'] <> '' ? 'data-type="'.$arItem['PROPERTIES']['TIPTOVARA']['TYPE'].'"' : "";?>
		                name="QUANTITY_INPUT_<?=$arItem["ID"]?>"
		                class="cart__item-field"
		                maxlength="5"
		                value="<?=$arItem['PROPERTIES']['TIPTOVARA']['STEP'] <> '' ? $arItem["QUANTITY"] * $arItem['PROPERTIES']['TIPTOVARA']['STEP'] : "0";?>"
		                readonly="readonly"
		            >
	                <span class="cart__item-form-text">
		                <?=$arItem['PROPERTIES']['TIPTOVARA']['MEASURE'] <> "" ? $arItem['PROPERTIES']['TIPTOVARA']['MEASURE'] : '';?>
	                </span>
	                <?if(floatval($arItem["MEASURE_RATIO"]) != 0){?>
		                <a href="javascript:void(0);" class="cart__item-more"></a>
	                <?}?>
	                <input type="hidden" id="QUANTITY_<?=$arItem['ID']?>" name="QUANTITY_<?=$arItem['ID']?>" value="<?=$arItem["QUANTITY"]?>" readonly="readonly"/>
                </div>
                <div class="cart__item-summ">
	                <?
		            /**
		             * Если есть скидки
		             */
		            //pre($arItem["MEASURE"] * $arItem['PRICE']);
		            if(intval($arItem['DISCOUNT_PRICE_PERCENT']) > 0){?>
                        <?
                        /**
                         * @todo $arItem['PROPERTIES']['TIPTOVARA']['MEASURE_PRICE'] - убрал из $currency по требованию Дениса
                         *       Задача оставить только руб.
                         */
                        ?>
				        <?=getPrintFormatPrice($arItem["QUANTITY"] * $arItem['PRICE'], $currency = ' руб', $class = 'cart__item-main-price', 'wh_tenth')?>
		            <?} else {?>
			            <?=getPrintFormatPrice($arItem["QUANTITY"] * $arItem["FULL_PRICE"], $currency = ' руб', $class = 'cart__item-main-price', 'wh_tenth')?>
		            <?}?>
                </div>
            </li>
        <?}?>
    <?}?>
</ul>
<input type="hidden" id="column_headers" value="<?=CUtil::JSEscape(implode($arHeaders, ","))?>" />
<input type="hidden" id="offers_props" value="<?=CUtil::JSEscape(implode($arParams["OFFERS_PROPS"], ","))?>" />
<input type="hidden" id="action_var" value="<?=CUtil::JSEscape($arParams["ACTION_VARIABLE"])?>" />
<input type="hidden" id="quantity_float" value="<?=$arParams["QUANTITY_FLOAT"]?>" />
<input type="hidden" id="count_discount_4_all_quantity" value="<?=($arParams["COUNT_DISCOUNT_4_ALL_QUANTITY"] == "Y") ? "Y" : "N"?>" />
<input type="hidden" id="price_vat_show_value" value="<?=($arParams["PRICE_VAT_SHOW_VALUE"] == "Y") ? "Y" : "N"?>" />
<input type="hidden" id="hide_coupon" value="<?=($arParams["HIDE_COUPON"] == "Y") ? "Y" : "N"?>" />
<input type="hidden" id="use_prepayment" value="<?=($arParams["USE_PREPAYMENT"] == "Y") ? "Y" : "N"?>" />
<div class="bx_ordercart_order_pay">
<div class="bx_ordercart_order_pay_left" id="coupons_block">
		<?
		if ($arParams["HIDE_COUPON"] != "Y")
		{
			$good_coupon = "";
		?>
			<div class="bx_ordercart_coupon">
				<span><?=GetMessage("STB_COUPON_PROMT")?></span><input type="text" id="coupon" name="COUPON" value="" onchange="enterCoupon();">
				
			</div><?

				if (!empty($arResult['COUPON_LIST']))
				{
					foreach ($arResult['COUPON_LIST'] as $oneCoupon)
					{
						$couponClass = 'disabled';
						switch ($oneCoupon['STATUS'])
						{
							case DiscountCouponsManager::STATUS_NOT_FOUND:
							case DiscountCouponsManager::STATUS_FREEZE:
								$couponClass = 'bad';
								break;
							case DiscountCouponsManager::STATUS_APPLYED:
								$couponClass = 'good';
								break;
						}
						?><div class="bx_ordercart_coupon"><input disabled readonly type="text" name="OLD_COUPON[]" value="<?=htmlspecialcharsbx($oneCoupon['COUPON']);?>" class="<? echo $couponClass; ?>"><span class="<? echo $couponClass; ?>" data-coupon="<? echo htmlspecialcharsbx($oneCoupon['COUPON']); ?>"></span><div class="bx_ordercart_coupon_notes"><?
						if (isset($oneCoupon['CHECK_CODE_TEXT']))
						{
							echo (is_array($oneCoupon['CHECK_CODE_TEXT']) ? implode('<br>', $oneCoupon['CHECK_CODE_TEXT']) : $oneCoupon['CHECK_CODE_TEXT']);
						}
						?></div></div><?
					}
					unset($couponClass, $oneCoupon);
				}
		}
		else
		{
			?>&nbsp;<?
		}
?>
</div>
</div>
<div style="clear: both;"></div>
<div class="cart__list-separator"></div>
<div class="cart__total-text">итого:</div>
<div class="cart__total" ><?=getPrintFormatPrice($arResult["allSum"], " руб", "cart__item-main-price", "wh_tenth")?><?//=str_replace(" ", "&nbsp;", $arResult["allSum_FORMATED"])?></div>
<button type="submit" class="cart__order">оформить заказ</button>