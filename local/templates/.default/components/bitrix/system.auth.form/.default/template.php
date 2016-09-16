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

<div class="login">
	<div class="login__left">
		<form name="form_auth" method="post" target="_top" action="<?=$arResult['AUTH_URL']?>">
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
			<div class="login__field-wrap"><span class="login__field-name">Электронная почта:</span>
				<input class="login__field" type="text" name="USER_LOGIN" maxlength="255" value="<?=$arResult['LAST_LOGIN']?>"/>
			</div>
			<div class="login__field-wrap">
				<span class="login__field-name">Пароль</span>
				<a href="<?=FORGOT_PASS_URL?>" class="login__forgot">Забыли пароль?</a>
				<input class="login__field" type="password" name="USER_PASSWORD" maxlength="255"/>
			</div>
			<input class="login__butt" type="submit" name="Login" value="Войти" />
		</form>
	</div>
	<div class="login__right"><a href="<?=REGISTER_URL?>" class="login__register">Регистрация</a>
        <?if($arResult['AUTH_SERVICES']){
            $APPLICATION->IncludeComponent('bitrix:socserv.auth.form', '',
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
	</div>
	<script type="text/javascript">
		<?if(strlen($arResult['LAST_LOGIN'])>0){?>
			try{document.form_auth.USER_PASSWORD.focus();}catch(e){}
		<?} else {?>
			try{document.form_auth.USER_LOGIN.focus();}catch(e){}
		<?}?>
	</script>
</div>