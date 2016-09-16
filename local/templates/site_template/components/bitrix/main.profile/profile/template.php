<?
/**
 * @global CMain $APPLICATION
 * @param array $arParams
 * @param array $arResult
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<?
if($USER->isAdmin())
{
    //pre($arResult);
}
?>
<?
if(!CDiscountCards::isCardValid()){
    $APPLICATION->IncludeComponent(
        "bitrix:main.include", "",
        Array(
            "AREA_FILE_SHOW" => "file",
            "PATH" => SITE_DIR."include/page_templates/invalid_discount_card.php"
        ),
        false,
        array(
            "HIDE_ICONS" => "N"
    ));
}
?>
<?
$auth_result = '';
if (isset($_REQUEST["auth_result"])) {
    $auth_result = htmlspecialchars($_REQUEST["auth_result"]);
}?>
<?
// не тестировалось на $auth_result
if ($auth_result == "ok") {?>
    <div class="success-block">
        <p class="success-block__header">
            <?=GetMessage("AUTH_SUCCESS");?>
        </p>
    </div>
<?}?>
<?if ($arResult["strProfileError"] <> "") {?>
    <div class="error-block">
        <p class="error-block__header">Возникли ошибки.</p>
        <p class="error-block__text">
            <?
            $res = mb_strrichr($arResult["strProfileError"], "<br>", true);
            echo $res === false ? '' : $res;
            ?>
        </p>
    </div>
<?}?>
<?if ($arResult['DATA_SAVED'] == 'Y') {?>
    <div class="success-block">
        <p class="success-block__header">Изменения сохранены.</p>
    </div>
<?}?>

<div class="profile">
    <form method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
        <?=$arResult["BX_SESSION_CHECK"]?>
        <input type="hidden" name="lang" value="<?=LANG?>" />
        <input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
        <?
        // для случая когда email == login
        ?>
        <input type="hidden" maxlength="50" name="LOGIN" value="<?=$arResult["arUser"]["LOGIN"]?>" />

        <div class="profile__box">
            <div class="profile__header">персональные данные</div>
            <table class="profile__personal-table">
                <tbody><tr class="profile__personal-stroke">
                    <td class="profile__personal-lcell">
                        <p class="profile__personal-text">Фамилия</p>
                    </td>
                    <td class="profile__personal-rcell">
                        <input type="text" name="LAST_NAME" class="profile__field" value="<?=$arResult["arUser"]["LAST_NAME"]?>">
                    </td>
                </tr>
                <tr class="profile__personal-stroke">
                    <td class="profile__personal-lcell">
                        <p class="profile__personal-text">Имя</p>
                    </td>
                    <td class="profile__personal-rcell">
                        <input type="text" name="NAME" class="profile__field" value="<?=$arResult["arUser"]["NAME"]?>">
                    </td>
                </tr>
                <tr class="profile__personal-stroke">
                    <td class="profile__personal-lcell">
                        <p class="profile__personal-text">Отчество</p>
                    </td>
                    <td class="profile__personal-rcell">
                        <input type="text" name="SECOND_NAME" class="profile__field" value="<?=$arResult["arUser"]["SECOND_NAME"]?>">
                    </td>
                </tr>
                <tr class="profile__personal-stroke">
                    <td class="profile__personal-lcell">
                        <p class="profile__personal-text">Дата рождения</p>
                    </td>
                    <td class="profile__personal-rcell">
						<?
						$date_bth = "";
						if(!empty($arResult["USER_PROPERTIES"]["DATA"]["UF_DATE_BTHD"]["VALUE"])){
							$date_bth =  $arResult["USER_PROPERTIES"]["DATA"]["UF_DATE_BTHD"]["VALUE"];
						}else{
							$date_bth = explode(".", $arResult["arUser"]["PERSONAL_BIRTHDAY"]);
							$date_bth = $date_bth[0].".".$date_bth[1];
						}						
						?>
                        <input type="text" name="UF_DATE_BTHD" placeholder="дд.мм" class="mask_date profile__field" value="<?=$date_bth?>">
                        <input type="hidden" name="PERSONAL_BIRTHDAY" placeholder="дд.мм.гггг" class="profile__field" value="<?=$arResult["arUser"]["~PERSONAL_BIRTHDAY"]?>">
                    </td>
                </tr>
				<tr class="profile__personal-stroke">
                    <td class="profile__personal-lcell">
                        <p class="profile__personal-text">Возраст</p>
                    </td>
                    <td class="profile__personal-rcell">
		
                        <?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):
							if($FIELD_NAME == "UF_GROUP_YEAR"){?>
								<?$APPLICATION->IncludeComponent(
									"bitrix:system.field.edit",
									$arUserField["USER_TYPE"]["USER_TYPE_ID"],
									array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField), null, array("HIDE_ICONS"=>"Y"));?>
							<?}?>		
						<?endforeach;?>
                    </td>
                </tr>
				<tr class="profile__personal-stroke">
                    <td class="profile__personal-lcell">
                        <p class="profile__personal-text">Пол</p>
                    </td>
                    <td class="profile__personal-rcell">
                        <select name="PERSONAL_GENDER" class="profile__select">
							<option value=""><?=GetMessage("USER_DONT_KNOW")?></option>
							<option value="M"<?=$arResult["arUser"]["PERSONAL_GENDER"] == "M" ? " SELECTED=\"SELECTED\"" : ""?>><?=GetMessage("USER_MALE")?></option>
							<option value="F"<?=$arResult["arUser"]["PERSONAL_GENDER"] == "F" ? " SELECTED=\"SELECTED\"" : ""?>><?=GetMessage("USER_FEMALE")?></option>
						</select>
                    </td>
                </tr>		
                <tr class="profile__personal-stroke">
                    <td class="profile__personal-lcell">
                        <p class="profile__personal-text">Телефон</p>
                    </td>
                    <td class="profile__personal-rcell">
                        <input type="text" name="PERSONAL_PHONE" placeholder="+_ (___) ___-__-__" class="mask_phone profile__field" value="<?=$arResult["arUser"]["PERSONAL_PHONE"]?>">
                    </td>
                </tr>
                <tr class="profile__personal-stroke">
                    <td class="profile__personal-lcell">
                        <p class="profile__personal-text">Электронная почта</p>
                    </td>
                    <td class="profile__personal-rcell">
                        <input type="text" name="EMAIL" class="profile__field" value="<?=$arResult["arUser"]["EMAIL"]?>">
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="profile__box">
            <div class="profile__header">смена пароля</div>
            <table class="profile__personal-table">
                <tbody>
                <tr class="profile__personal-stroke">
                    <td class="profile__personal-lcell">
                        <p class="profile__personal-text">Новый пароль</p>
                    </td>
                    <td class="profile__personal-rcell">
                        <input type="text" name="NEW_PASSWORD" autocomplete="off" class="profile__field">
                    </td>
                </tr>
                <tr class="profile__personal-stroke">
                    <td class="profile__personal-lcell">
                        <p class="profile__personal-text">Повтор нового пароля</p>
                    </td>
                    <td class="profile__personal-rcell">
                        <input type="text" name="NEW_PASSWORD_CONFIRM" autocomplete="off" class="profile__field">
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="profile__butt-wrap">
                <input type="submit" name="save" class="profile__butt" value="СОХРАНИТЬ">
            </div>
        </div>
    </form>
</div>