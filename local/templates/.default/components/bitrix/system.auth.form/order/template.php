<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?//echo "<pre>"; var_dump($_REQUEST); echo "</pre>";?>

<?
if (isset($_REQUEST["USER_LOGIN"])){
	$arResult['LAST_LOGIN'] = htmlspecialchars($_REQUEST["LAST_LOGIN"]);
};
?>

<?if ($arResult["ERROR_MESSAGE"]["ERROR_TYPE"] == "LOGIN" && $arResult["ERROR_MESSAGE"]["MESSAGE"] <> "") {?>
	<div class="error-block">
		<p class="error-block__header">Возникли ошибки</p>
		<p class="error-block__text"><?=$arResult['ERROR_MESSAGE']['MESSAGE']?></p>
	</div>
<?}?>

<div class="signin__old"><span class="signin__header">уже заказывали?</span>
	<p class="signin__header-text">Если вы регистрировались, введите свои данные в соответствующие поля:</p>
	<form name="form_auth" class="signin__form" method="post" target="_top" action="<?=$arResult['AUTH_URL']?>">
		<input type="hidden" name="AUTH_FORM" value="Y" />
		<input type="hidden" name="TYPE" value="AUTH" />
		<?
		if(strlen($arResult['BACKURL']) > 0){
			?><input type="hidden" name="backurl" value="<?=$arResult['BACKURL']?>" /><?
		}
		foreach($arResult['POST'] as $key => $value){
			?><input type="hidden" name="<?=$key?>" value="<?=$value?>" /><?
		}
		?>
		<div class="signin__field-wrap">
			<span class="signin__field-name">Электронная почта:</span>
			<input type="text" name="USER_LOGIN" value="<?=$arResult['LAST_LOGIN']?>" class="signin__field">
		</div>
		<div class="signin__field-wrap">
			<span class="signin__field-name">Пароль</span>
			<a href="<?=FORGOT_PASS_URL?>" class="signin__forgot" tabindex="-1">Забыли пароль?</a>
			<input type="password" name="USER_PASSWORD" name="password" class="signin__field">
		</div>
		<input type="submit" class="signin__butt" name="Login" value="Продолжить оформление" />
	</form>
	<?if($arResult['AUTH_SERVICES']) {
		$APPLICATION->IncludeComponent('bitrix:socserv.auth.form', 'order',
			array(
				'AUTH_SERVICES' => $arResult['AUTH_SERVICES'],
				'CURRENT_SERVICE' => $arResult['CURRENT_SERVICE'],
				'AUTH_URL' => $arResult['AUTH_URL'],
				'POST' => $arResult['POST'],
				'SHOW_TITLES' => $arResult['FOR_INTRANET']?'N':'Y',
				'FOR_SPLIT' => $arResult['FOR_INTRANET']?'Y':'N',
				'AUTH_LINE' => $arResult['FOR_INTRANET']?'N':'Y',
			),
			false
		);
	}?>
	<script type="text/javascript">
		<?if(strlen($arResult['LAST_LOGIN'])>0){?>
		try{document.form_auth.USER_PASSWORD.focus();}catch(e){}
		<?} else {?>
		try{document.form_auth.USER_LOGIN.focus();}catch(e){}
		<?}?>
	</script>
</div>