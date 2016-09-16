<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();?>

<?//echo "<pre>"; var_dump($arResult); echo "</pre>";?>

<?if($arParams["~AUTH_RESULT"]["MESSAGE"] <> ""){?>
    <?if($arParams["~AUTH_RESULT"]["TYPE"] != "OK"){?>
        <div class="error-block">
            <p class="error-block__header">Возникли ошибки</p>
            <p class="error-block__text">
                <?=$arParams["~AUTH_RESULT"]["MESSAGE"];?>
            </p>
        </div>
    <?} elseif($arParams["~AUTH_RESULT"]["TYPE"] == "OK"){?>
        <div class="success-block">
            <p class="success-block__header">Внимание</p>
            <p class="success-block__text">
                <?=$arParams["~AUTH_RESULT"]["MESSAGE"];?>
            </p>
        </div>
    <?}?>
<?}?>

<div class="signup">
	<form class="signup__form" method="post" action="<?=$arResult['AUTH_FORM']?>" name="bform" enctype="multipart/form-data">
		<?if($arResult['BACKURL'] <> ''){?>
			<input type="hidden" name="backurl" value="<?=$arResult['BACKURL']?>" />
		<?}?>
		<input type="hidden" name="AUTH_FORM" value="Y">
		<input type="hidden" name="TYPE" value="CHANGE_PWD">
		<div class="signup__field-wrap"><span class="signup__field-name _star">E-Mail</span>
			<input type="text" name="USER_LOGIN" maxlength="50" value="<?=$arResult['LAST_LOGIN']?>" class="signup__field">
		</div>
		<div class="signup__field-wrap"><span class="signup__field-name _star">Контрольная строка</span>
			<input type="text" name="USER_CHECKWORD" maxlength="50" value="<?=$arResult['USER_CHECKWORD']?>" class="signup__field">
		</div>
		<div class="signup__field-wrap"><span class="signup__field-name _star">Новый пароль</span>
			<input type="password" name="USER_PASSWORD" maxlength="50" value="<?=$arResult['USER_PASSWORD']?>"  class="signup__field">
		</div>
		<div class="signup__field-wrap"><span class="signup__field-name _star">Подтверждение пароля</span>
			<input type="password" name="USER_CONFIRM_PASSWORD" maxlength="50" value="<?=$arResult['USER_CONFIRM_PASSWORD']?>" class="signup__field">
		</div>
		<input name="change_pwd" type="submit" class="signup__butt"  value="Изменить пароль" />
	</form>
</div>