<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
if($USER->isAdmin()){   
	//pre($arResult['ORDERS']);
}

if(!empty($arResult['ERRORS']['FATAL'])) {
    foreach($arResult['ERRORS']['FATAL'] as $error) {
        echo ShowError($error);
    }
} else {
    if(!empty($arResult['ERRORS']['NONFATAL'])) {
        foreach($arResult['ERRORS']['NONFATAL'] as $error) {
            echo ShowError($error);
        }
    }
    ?>
    <div class="orderlist">
        <div class="orderlist__wrapper">
            <table cellspacing="0" callpadding="0" class="orderlist__table">
                <thead>
                    <tr class="orderlist__stroke _head">
                        <td class="orderlist__date-cell">Дата</td>
                        <td class="orderlist__number-cell">Номер заказа</td>
                        <td class="orderlist__summ-cell">Сумма, руб.</td>
                        <td class="orderlist__cash-cell">Оплата</td>
                        <td class="orderlist__state-cell">Статус</td>
                    </tr>
                </thead>
                <?foreach($arResult['ORDERS'] as $arItem){?>
                    <tbody>
                        <tr class="orderlist__visibile-stroke">
                            <td class="orderlist__date-cell"><span class="orderlist__date-cell"><?=$arItem['ORDER']['DATE_INSERT_FORMATED']?></span></td>
                            <td class="orderlist__number-cell"><span class="orderlist__inner-link"><?=$arItem['ORDER']['ACCOUNT_NUMBER']?></span></td>
                            <td class="orderlist__summ-cell"><span class="orderlist__summ-text"><?=round($arItem['ORDER']['PRICE'] - $arItem['ORDER']['PRICE_DELIVERY'],2)?></span>
							<?if(isset($arItem['ORDER']["FACT_SUMMA"]) && (!empty($arItem['ORDER']["FACT_SUMMA"]))){?>
								<div class="fact_summa">факт. сумма <span><?=$arItem['ORDER']["FACT_SUMMA"]?></span></div>
							<?}?>
							</td>
                           <?//!!!?> <td class="orderlist__cash-cell"><span class="orderlist__cash-text"><?if($arItem['ORDER']['PAY_SYSTEM_ID'] == 2){?>Банковской картой<?}else{?>Наличные<?}?></span></td>
                            <td class="orderlist__state-cell"><span class="orderlist__state-text <?=($arItem['ORDER']['STATUS_ID'] == 'N' ? '_progress' : '_done');?>"><?=$arResult['INFO']['STATUS'][$arItem['ORDER']['STATUS_ID']]['NAME']?></span></td>
                        </tr>
                        <tr class="orderlist__hidden-stroke">
                            <td colspan="5">
                                <table cellspacing="0" callpadding="0" class="orderlist__goods-list">
                                    <tr class="orderlist__goods-head">
                                        <td class="orderlist__goods-head-cell"><span class="orderlist__goods-head-text">состав заказа:</span></td>
                                    </tr>
                                    <?foreach($arItem['BASKET_ITEMS'] as $arBasketItem){?>
                                        <tr class="orderlist__goods-stroke">
                                            <td class="orderlist__goods-name-cell"><span class="orderlist__goods-name-text"><?=$arBasketItem['NAME']?></span></td>
                                            <td class="orderlist__goods-weight-cell"><span class="orderlist__goods-weight-text"><?=$arBasketItem['QUANTITY'] * $arBasketItem['PROPERTIES']['TIPTOVARA']['STEP']?> <?=$arBasketItem['PROPERTIES']['TIPTOVARA']['MEASURE']?></span></td>
                                            <td class="orderlist__goods-summ-cell">
	                                            <span class="orderlist__goods-summ-text">
													<?if($arBasketItem['PROPERTIES']['TIPTOVARA']['VALUE'] <> ""){?>
														<?=getPrintFormatPrice($arBasketItem['PRICE'] * $arBasketItem['QUANTITY'], $currency = $arBasketItem['PROPERTIES']['TIPTOVARA']['MEASURE_PRICE'], $class = '', 'wh_measure_mail_tmp')?>
													<?}?>
                                                </span>												
                                            </td>
                                        </tr>
                                    <?}?>
                                </table>
                            </td>
                        </tr>
                        <tr class="orderlist__separator-stroke">
                            <td colspan="5"></td>
                        </tr>
                    </tbody>
                <?}?>
            </table>
            <?if(strlen($arResult['NAV_STRING'])){?>
                <?=$arResult['NAV_STRING']?>
            <?}?>
        </div>
    </div>
<?}?>