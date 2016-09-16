<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if($USER->isAdmin())
{
    //pre($arResult["PAY_SYSTEM"]);
}

?>
<div class="forming__box _cash">
    <script type="text/javascript">
        function changePaySystem(param)
        {
            if (BX("account_only") && BX("account_only").value == 'Y') // PAY_CURRENT_ACCOUNT checkbox should act as radio
            {
                if (param == 'account')
                {
                    if (BX("PAY_CURRENT_ACCOUNT"))
                    {
                        BX("PAY_CURRENT_ACCOUNT").checked = true;
                        BX("PAY_CURRENT_ACCOUNT").setAttribute("checked", "checked");
                        BX.addClass(BX("PAY_CURRENT_ACCOUNT_LABEL"), 'selected');

                        // deselect all other
                        var el = document.getElementsByName("PAY_SYSTEM_ID");
                        for(var i=0; i<el.length; i++)
                            el[i].checked = false;
                    }
                }
                else
                {
                    BX("PAY_CURRENT_ACCOUNT").checked = false;
                    BX("PAY_CURRENT_ACCOUNT").removeAttribute("checked");
                    BX.removeClass(BX("PAY_CURRENT_ACCOUNT_LABEL"), 'selected');
                }
            }
            else if (BX("account_only") && BX("account_only").value == 'N')
            {
                if (param == 'account')
                {
                    if (BX("PAY_CURRENT_ACCOUNT"))
                    {
                        BX("PAY_CURRENT_ACCOUNT").checked = !BX("PAY_CURRENT_ACCOUNT").checked;

                        if (BX("PAY_CURRENT_ACCOUNT").checked)
                        {
                            BX("PAY_CURRENT_ACCOUNT").setAttribute("checked", "checked");
                            BX.addClass(BX("PAY_CURRENT_ACCOUNT_LABEL"), 'selected');
                        }
                        else
                        {
                            BX("PAY_CURRENT_ACCOUNT").removeAttribute("checked");
                            BX.removeClass(BX("PAY_CURRENT_ACCOUNT_LABEL"), 'selected');
                        }
                    }
                }
            }

            submitForm();
        }
    </script>
	<?uasort($arResult["PAY_SYSTEM"], "cmpBySort");?>
    <div class="forming__header">Оплата заказа</div>
    <div class="forming__cash-left">
        <?foreach($arResult["PAY_SYSTEM"] as $arPaySystem) {?>
            <label onclick="BX('ID_PAY_SYSTEM_ID_<?=$arPaySystem["ID"]?>').checked=true;changePaySystem();" class="forming__check-wrap">
	        	<input type="radio"
	        		id="ID_PAY_SYSTEM_ID_<?=$arPaySystem["ID"]?>"
	        		name="PAY_SYSTEM_ID"
	        		value="<?=$arPaySystem["ID"]?>"
	        		<?if ($arPaySystem["CHECKED"]=="Y" && !($arParams["ONLY_FULL_PAY_FROM_ACCOUNT"] == "Y" && $arResult["USER_VALS"]["PAY_CURRENT_ACCOUNT"]=="Y")) echo " checked=\"checked\"";?>
	        		onclick="changePaySystem();"
                    class="forming__check"
                />
                <span class="forming__check-text"><?=$arPaySystem["PSA_NAME"];?></span>
            </label>
        <?}?>
        <div class="forming__cash-bottom">Оплата наличными и картой производится курьеру после получения и проверки заказа.</div>
    </div>
    <div class="forming__cash-right">
        <div class="forming__field-wrapper">
                <p class="forming__field-text">Дисконтная карта</p>
                <input disabled value="<?=$arResult["UF_DISCOUNT_CARD"]?>" type="text" class="forming__field _discount-card"><a href="/personal/bonus_card/" class="forming__change-card">Изменить номер карты</a>
                <p class="forming__card-warning"><strong class="forming__card-warning-b">Важно! </strong><span class="forming__card-warning-text">Cкидка по дисконтной карте осуществляется только при предъявлении покупателем карты курьеру!</span></p>
        </div>
    </div>
    <?/*<div class="forming__cash-bottom">Оплата наличными и картой производится курьеру после получения и проверки заказа.</div>*/?>
</div>