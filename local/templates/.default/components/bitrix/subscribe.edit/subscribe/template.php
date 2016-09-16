<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if(!$arResult["SUBSCRIPTION"]["CONFIRM_CODE"]){
	foreach($arResult["RUBRICS"] as $key => $arRubric){
		$arRubric["CHECKED"] = true;
		$arResult["RUBRICS"][$key] = $arRubric;
	}
}
?>
<div class="subscribe">
    <div class="subscribe__wrapper">
        <div class="subscribe__header">Настройка подписки</div>
        <div class="subscribe__message">
        <?
		foreach($arResult["MESSAGE"] as $itemID=>$itemValue)
			echo ShowMessage(array("MESSAGE"=>$itemValue, "TYPE"=>"OK"));
		foreach($arResult["ERROR"] as $itemID=>$itemValue)
			echo ShowMessage(array("MESSAGE"=>$itemValue, "TYPE"=>"ERROR"));?>
		</div>
		<div id="agree_message" class="subscribe__message hidden">
			<p><font class="errortext">Для подписки поставьте галочку "Я хочу получать рассылку по E-mail"</font></p>
		</div>
        <!-- В этой форме имена полей завязаны на js-валидацию-->
        <!-- Если нужно изменить имена полей, то нужно учесть эти изменения в js-->
        <!-- Поменять можно в файле pages.js, поиска Project.Pages.Subscribe-->
        <form class="subscribe__form" id="subscribe_form" action="<?=$arResult["FORM_ACTION"]?>" method="post">
        	<?echo bitrix_sessid_post();?>
            <div class="subscribe__field-wrap _email"><span class="subscribe__theme">Электронная почта</span>
                <input type="text" name="EMAIL" value="<?=$arResult["SUBSCRIPTION"]["EMAIL"]!=""?$arResult["SUBSCRIPTION"]["EMAIL"]:$arResult["REQUEST"]["EMAIL"];?>" class="subscribe__field">
            </div>
            <div class="subscribe__field-wrap"><span class="subscribe__theme">Темы</span>
                <?foreach($arResult["RUBRICS"] as $itemID => $itemValue){?>
	                <label class="subscribe__label">
	                    <input type="checkbox" name="RUB_ID[]" value="<?=$itemValue["ID"]?>" <?if($itemValue["CHECKED"]) echo " checked"?> class="subscribe__check"><span class="subscribe__check-text"><?=$itemValue["NAME"]?></span>
	                </label>
                <?}?>
            </div>
            <?//if($arResult["ID"]){?>
            <div class="subscribe__field-wrap"><span class="subscribe__theme"></span>
                <label class="subscribe__label">
                    <input type="checkbox" value="unsubscribe" id="unsubscribe_checkbox" class="subscribe__check" <?if($arResult["SUBSCRIPTION"]["ACTIVE"]=="Y"){?>checked="checked"<?}?>><span class="subscribe__check-text">Я хочу получать рассылку по E-mail</span>
                </label>
            </div>
            <?//}?>
            <div class="subscribe__separator"></div>
            <div class="subscribe__field-wrap"><span class="subscribe__theme"></span>
                <button type="submit" name="Save" value="<?echo ($arResult["ID"] > 0? GetMessage("subscr_upd"):GetMessage("subscr_add"))?>" class="subscribe__button">Сохранить</button>
            </div>
            <input type="hidden" name="PostAction" value="<?echo ($arResult["ID"]>0? "Update":"Add")?>" />
			<input type="hidden" name="ID" value="<?echo $arResult["SUBSCRIPTION"]["ID"];?>" />
			<input type="hidden" name="FORMAT" value="html" />
			<input type="hidden" name="CONFIRM_CODE" value="<?=$arResult["SUBSCRIPTION"]["CONFIRM_CODE"]?>" />
        </form>
        <?if($arResult["ID"]){?>
        <form class="subscribe__form" action="<?=$arResult["FORM_ACTION"]?>" id="unsubscribe_form" method="post">
        	<?echo bitrix_sessid_post();?>
        	<input type="hidden" name="ID" value="<?echo $arResult["SUBSCRIPTION"]["ID"];?>" />
			<input type="hidden" name="FORMAT" value="html" />
			<input type="hidden" name="CONFIRM_CODE" value="<?=$arResult["SUBSCRIPTION"]["CONFIRM_CODE"]?>" />
        	<input type="hidden" name="action" value="activate">
        </form>
        <script>
        	$(document).ready(function(){
        		$('#unsubscribe_checkbox').click(function(){
        			var action = "unsubscribe";
        			if($(this).is(":checked")){
        				action = "activate";
        			}

        			$('#unsubscribe_form [name="action"]').val(action);
        			$('#unsubscribe_form').submit();
        		});
        	})
        </script>
        <?}?>
    </div>
</div>
<script>
	$(document).ready(function(){
		$('#subscribe_form').submit(function(e){
			if(!$('#unsubscribe_checkbox').is(":checked")){
				$('#agree_message').removeClass("hidden");
				e.preventDefault();
			} else{
				$('#agree_message').addClass("hidden");
			}
		});
	})
</script>