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
?>
<p class="footer__subscr-text">Подпишитесь на наши новости</p>
<div class="footer__subscr">
	<form id="footer_subscribe_form" name="subscribe" action="<?=$arResult["FORM_ACTION"]?>" class="footer__subscr-form">
        <input placeholder="E-mail" name="sf_EMAIL" type="text" class="footer__subscr-field"><span class="footer__submit-wrap footer__submit-click">
        <input id="footer_subscribe_submit" value="<?=GetMessage("subscr_form_button")?>" name="OK" type="submit" class="footer__subscr-submit" /></span>
        <?/*foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
        	<input type="hidden" name="sf_RUB_ID[]" id="sf_RUB_ID_<?=$itemValue["ID"]?>" value="<?=$itemValue["ID"]?>" checked="checked"/>
    	<?endforeach;*/?>    
	</form>
</div>
<script>
	$(document).ready(function(){
		$('.footer__submit-click').click(function(){
			$('#footer_subscribe_form').submit();
		});
		// $('#footer_subscribe_submit').click(function(){
		// 	console.log('ololo');
		// })
	});
</script>