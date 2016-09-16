<?
/**
 * @global CMain $APPLICATION
 * @param array $arParams
 * @param array $arResult
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
if($USER->isAdmin())
{
    //pre($arResult);
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
        <input type="hidden" maxlength="50" name="EMAIL" value="<?=$arResult["arUser"]["EMAIL"]?>" />
        <div class="profile__box">
            <div class="profile__header">Дисконтная карта</div>
            <table class="profile__personal-table">
                <tbody>
                    <tr class="profile__personal-stroke">
                        <td class="profile__personal-lcell">
                            <p class="profile__personal-text">Номер карты</p>
                        </td>
                        <td class="profile__personal-rcell">
                            <input type="text" name="UF_DISCOUNT_CARD" class="profile__field" value="<?=$arResult["arUser"]["UF_DISCOUNT_CARD"]?>">
                        </td>
                    </tr>
                    <tr class="profile__personal-stroke">
	                    <td class="profile__personal-lcell">&nbsp;</td>
	                    <td class="profile__personal-rcell"><i class="profile__card-hint-img"></i></td>
                    </tr>
                </tbody>
            </table>
            <div class="profile__butt-wrap">
                <input type="submit" name="save" class="profile__butt" value="СОХРАНИТЬ">
            </div>
        </div>
    </form>
</div>