<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)	die();?>

<?//echo "<pre>"; var_dump($arResult); echo "</pre>";?>

<?if(count($arResult['ERRORS']) > 0) {
    foreach ($arResult['ERRORS'] as $key => $error) {
        if (intval($key) == 0 && $key !== 0) {
            $arResult['ERRORS'][$key] = str_replace('#FIELD_NAME#', '&quot;'.GetMessage('REGISTER_FIELD_'.$key).'&quot;', $error);
        } else {
            ?>
            <div class="error-block">
                <p class="error-block__header">Возникли ошибки</p>
                <p class="error-block__text">
                    <?ShowError(implode('<br />', $arResult['ERRORS']));?>
                </p>
            </div>
            <?
        }
    }
}?>

<div class="signin__new">
	<span class="signin__header">Для новых покупателей</span>
	<form  class="signin__form" method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform" enctype="multipart/form-data">
		<?if($arResult['BACKURL'] <> ''){?>
			<input type="hidden" name="backurl" value="<?=$arResult['BACKURL']?>" class="signin__field" />
		<?}?>
		<div class="signin__field-wrap"><span class="signin__field-name _star">Имя</span>
			<?$errorKey = GetCheckErrors($arResult["ERRORS"], "NAME");?>
            <input type="text" name="REGISTER[NAME]" value="<?=$arResult['VALUES']['NAME']?>" class="signin__field <?=($errorKey ? 'validation-error' : '')?>">
			<?if($errorKey){?>
                <span class="validation-error"><?=$arResult["ERRORS"][$errorKey];?></span>
            <?}?>
		</div>
		<div class="signin__field-wrap"><span class="signin__field-name _star">Фамилия</span>
			<?$errorKey = GetCheckErrors($arResult["ERRORS"], "LAST_NAME");?>
            <input type="text" name="REGISTER[LAST_NAME]" value="<?=$arResult['VALUES']['LAST_NAME']?>" class="signin__field <?=($errorKey ? 'validation-error' : '')?>">
			<?if($errorKey){?>
                <span class="validation-error">Поле "Фамилия" обязательно для заполнения</span>
            <?}?>
		</div>
		<div class="signin__field-wrap"><span class="signin__field-name">Пол</span>
			<select name="REGISTER[PERSONAL_GENDER]" class="profile__select">
					<option value=""><?=GetMessage("USER_DONT_KNOW")?></option>
					<option value="M"<?=$arResult["VALUES"]["PERSONAL_GENDER"] == "M" ? " SELECTED=\"SELECTED\"" : ""?>><?=GetMessage("USER_MALE")?></option>
					<option value="F"<?=$arResult["VALUES"]["PERSONAL_GENDER"] == "F" ? " SELECTED=\"SELECTED\"" : ""?>><?=GetMessage("USER_FEMALE")?></option>
				</select>
        </div>
		<div class="signin__field-wrap"><span class="signin__field-name">Дата рождения</span>
            <input type="text" name="UF_DATE_BTHD" placeholder="дд.мм" value="<?=$arResult['USER_PROPERTIES']['UF_DATE_BTHD']?>" class="mask_date signin__field">
        </div>
		<div class="signin__field-wrap"><span class="signin__field-name">Возраст</span>            
			<?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):
				if($FIELD_NAME == "UF_GROUP_YEAR"){?>
					<?$APPLICATION->IncludeComponent(
						"bitrix:system.field.edit",
						$arUserField["USER_TYPE"]["USER_TYPE_ID"],
						array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField), null, array("HIDE_ICONS"=>"Y"));?>
				<?}?>		
			<?endforeach;?>
        </div>
		<div class="signin__field-wrap"><span class="signin__field-name">От куда о нас узнали?</span>            
			<?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):
				if($FIELD_NAME == "UF_HOW_NEW_AA"){?>
					<?$APPLICATION->IncludeComponent(
						"bitrix:system.field.edit",
						$arUserField["USER_TYPE"]["USER_TYPE_ID"],
						array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField), null, array("HIDE_ICONS"=>"Y"));?>
				<?}?>		
			<?endforeach;?>
        </div>
        <?/*<div class="signup__field-wrap"><span class="signup__field-name">Номер дисконтной карты</span>
            <input type="text" name="UF_DISCOUNT_CARD" value="<?=htmlspecialcharsbx($_POST["UF_DISCOUNT_CARD"])?>" class="signup__field">
	        <i class="signin__card-hint-img"></i>
        </div>*/?>
		<div class="signin__field-wrap">
			<span class="signin__field-name _star">Электронная почта</span>
			<?$errorKey = GetCheckErrors($arResult["ERRORS"], "EMAIL");?>
			<input type="text" name="REGISTER[EMAIL]" value="<?=$arResult['VALUES']['EMAIL']?>" class="signin__field">
			<?if($errorKey){?>
				<span class="validation-error"><?=$arResult["ERRORS"][$errorKey];?></span>
			<?}?>
		</div>
		<div class="signin__field-wrap">
			<span class="signin__field-name _star">Пароль</span>
			<?$errorKey = GetCheckErrors($arResult["ERRORS"], "PASSWORD");?>
			<input type="password" name="REGISTER[PASSWORD]" value="<?=$arResult['VALUES']['PASSWORD']?>" autocomplete="off" class="signin__field">
			<?if($errorKey){?>
				<span class="validation-error"><?=$arResult["ERRORS"][$errorKey];?></span>
			<?}?>
		</div>
		<div class="signin__field-wrap">
			<?$errorKey = GetCheckErrors($arResult["ERRORS"], "CONFIRM_PASSWORD");?>
			<span class="signin__field-name _star">Подтверждение пароля</span>
			<input type="password" name="REGISTER[CONFIRM_PASSWORD]" value="<?=$arResult['VALUES']['CONFIRM_PASSWORD']?>" autocomplete="off" class="signin__field">
			<?if($errorKey){?>
				<span class="validation-error"><?=$arResult["ERRORS"][$errorKey];?></span>
			<?}?>
		</div>
		<div class="signin__captcha">
			<?if($arResult['USE_CAPTCHA'] == 'Y'){?>
				<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult['CAPTCHA_CODE']?>" width="180" height="40" alt="CAPTCHA" class="signin__captcha-img"/>
			<?}?>
		</div>
		<div class="signin__field-wrap">
			<span class="signup__field-name _star">Введите код с картинки</span>
			<?$errorKey = GetCheckErrors($arResult["ERRORS"], "REGISTER_WRONG_CAPTCHA");?>
			<input class="signin__field <?=($errorKey ? 'validation-error' : '')?>" type="text" name="captcha_word" maxlength="50" value="" />
			<input type="hidden" name="captcha_sid" value="<?=$arResult['CAPTCHA_CODE']?>" />
			<?if($errorKey){?>
				<span class="validation-error"><?=$arResult["ERRORS"][$errorKey]?></span>
			<?}?>
		</div>
		<input name="register_submit_button" type="submit" class="signup__butt" value="Продолжить оформление">
	</form>
</div>