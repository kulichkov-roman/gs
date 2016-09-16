<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)	die();?>

<?
//echo "<pre>"; var_dump($arResult); echo "</pre>";?>

<?if(count($arResult['ERRORS']) > 0) {
    foreach ($arResult['ERRORS'] as $key => $error) {
        if (intval($key) == 0 && $key !== 0) {
            $arResult['ERRORS'][$key] = str_replace('#FIELD_NAME#', '&quot;'.GetMessage('REGISTER_FIELD_'.$key).'&quot;', $error);
        } else {
            ?>
            <div class="error-block">
                <p class="error-block__header">Возникли ошибки</p>
                <p class="error-block__text">
                    <?
                    ShowError(implode('<br />', $arResult['ERRORS']));
                    ?>
                </p>
            </div>
            <?
        }
    }
}?>

<div class="order-block">
	<div class="container-fluid container-fluid--3x">
		<div class="form-fieldset">
			<div class="form-fieldset__cont">
				<form class="signup__form validate_form" method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform" enctype="multipart/form-data" novalidate>
					<?if($arResult['BACKURL'] <> ''){?>
						<input type="hidden" name="backurl" value="<?=$arResult['BACKURL']?>" />
					<?}?><br>
					<div class="form-group">
						<div class="form-group__title">Имя<span class="required">*</span></div>
						<div class="form-group__cont"><input type="text" name="REGISTER[NAME]" value="<?=$arResult['VALUES']['NAME']?>" class="form-input width-full"></div>
					</div>
					<div class="form-group">
						<div class="form-group__title">Фамилия<span class="required">*</span></div>
						<div class="form-group__cont"><input type="text" name="REGISTER[LAST_NAME]" value="<?=$arResult['VALUES']['LAST_NAME']?>" class="form-input width-full"></div>
					</div>
					<div class="form-group">
						<div class="form-group__title">Номер дисконтной карты</div>
						<div class="form-group__cont"><input type="text" name="UF_DISCOUNT_CARD" value="<?=htmlspecialcharsbx($_POST["UF_DISCOUNT_CARD"])?>" class="form-input width-full"></div>
						<div class="form-group__cont"><img src="/files/cart-img.png" /></div>
					</div>
					<div class="form-group">
						<div class="form-group__title">Электронная почта<span class="required">*</span></div>
						<?$errorKey = GetCheckErrors($arResult["ERRORS"], "EMAIL");?>
						<div class="form-group__cont"><input type="email" name="REGISTER[EMAIL]" value="<?=$arResult['VALUES']['EMAIL']?>" class="form-input width-full signup__field <?=($errorKey ? 'validation-error' : '')?>" required></div>
						<?if($errorKey){?>
							<span class="validation-error"><?=$arResult["ERRORS"][$errorKey];?></span>
						<?}?>
					</div>
					<div class="form-group">
						<div class="form-group__title">Пароль<span class="required">*</span></div>
						<?$errorKey = GetCheckErrors($arResult["ERRORS"], "PASSWORD");?>
						<div class="form-group__cont"><input type="password" name="REGISTER[PASSWORD]" value="<?=$arResult['VALUES']['PASSWORD']?>" autocomplete="off" class="form-input width-full signup__field <?=($errorKey ? 'validation-error' : '')?>" required></div>
						<?if($errorKey){?>
							<span class="validation-error"><?=$arResult["ERRORS"][$errorKey];?></span>
						<?}?>
					</div>
					<div class="form-group">
						<div class="form-group__title">Подтверждение пароля<span class="required">*</span></div>
						<?$errorKey = GetCheckErrors($arResult["ERRORS"], "CONFIRM_PASSWORD");?>
						<div class="form-group__cont"><input type="password" name="REGISTER[CONFIRM_PASSWORD]" value="<?=$arResult['VALUES']['CONFIRM_PASSWORD']?>" autocomplete="off" class="form-input width-full signup__field <?=($errorKey ? 'validation-error' : '')?>" required></div>
						<?if($errorKey){?>
							<span class="validation-error"><?=$arResult["ERRORS"][$errorKey];?></span>
						<?}?>
					</div>	
					<?if($arResult['USE_CAPTCHA'] == 'Y'){?>					
						<div class="form-group text-xs-center"><img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult['CAPTCHA_CODE']?>" width="470" height="100" alt="CAPTCHA" class="signup__captcha"/></div>
						<div class="form-group">
							<div class="form-group__title">Введите код с картинки<span class="required">*</span></div>
							<?$errorKey = GetCheckErrors($arResult["ERRORS"], "REGISTER_WRONG_CAPTCHA");?>
							<div class="form-group__cont"><input type="text" name="captcha_word" class="form-input width-full signup__field <?=($errorKey ? 'validation-error' : '')?>" value="" required /></div>
							<input type="hidden" name="captcha_sid" value="<?=$arResult['CAPTCHA_CODE']?>" />
							<?if($errorKey){?>
								<span class="validation-error"><?=$arResult["ERRORS"][$errorKey]?></span>
							<?}?>
						</div>
					<?}?>
					<div class="signup__toleft">
						<div class="fieldset__cont">
							<label class="check-box signup__label">
								<input type="checkbox" class="signup__agree-check check-box__input">
								<i class="check-box__icon" data-type="checkbox"></i>
								<span class="check-box__text">Я согласен с <a class="signup__inner-link" href="#">Правилами и Условиями</a></span>
							</label>
						</div><br>
						<div class="fieldset__cont">
							<label class="check-box signup__label">
								<input type="checkbox" class="signup__agree-check check-box__input">
								<i class="check-box__icon" data-type="checkbox"></i>
								<span class="check-box__text">Я хочу получать рассылку</span>
							</label>
						</div>						
						
					</div>
					<div class="order-block__buttons order-block__buttons--inner">
						 <input name="register_submit_button" type="submit" class="button button--lg width-full signup__butt" value="зарегистрироваться">
					</div>		
				</form>
			</div>	
		</div>
	</div>
</div>

