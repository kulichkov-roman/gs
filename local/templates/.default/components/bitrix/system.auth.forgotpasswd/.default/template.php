<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();?>

<?//echo "<pre>"; var_dump($arParams["~AUTH_RESULT"]); echo "</pre>";?>

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

<div class="forgot">
	<form name="bform" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>" class="forgot__form" novalidate="novalidate">
		<?if (strlen($arResult["BACKURL"]) > 0) {?>
			<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
		<?}?>
		<input type="hidden" name="AUTH_FORM" value="Y">
		<input type="hidden" name="TYPE" value="SEND_PWD">
		<div class="forgot__field-wrap"><span class="forgot__field-name">Электронная почта</span>
			<input name="USER_EMAIL" class="forgot__field validation-success" type="text" />
		</div>
		<div class="forgot__text">Ссылка для восстановления пароля будет отправлена на адрес электронной почты.</div>
		<button name="send_account_info" type="submit" class="forgot__butt">восстановить</button>
	</form>
</div>