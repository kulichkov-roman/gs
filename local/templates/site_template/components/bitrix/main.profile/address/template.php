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
            <div class="profile__header">адреса доставки</div>
            <table class="profile__address-table">
                <tbody><tr class="profile__address-stroke _head">
                    <td class="profile__address-del-cell"></td>
                    <td class="profile__address-street">
                        <p class="profile__address-text">Улица</p>
                    </td>
                    <td class="profile__address-house">
                        <p class="profile__address-text">Дом</p>
                    </td>
                    <td class="profile__address-app">
                        <p class="profile__address-text">Квартира</p>
                    </td>
                    <td class="profile__address-main">
                        <p class="profile__address-text">Основной</p>
                    </td>
                </tr>
                <tr class="profile__address-stroke _body">
                    <td class="profile__address-del-cell"><span class="profile__address-del" style="display: none;"></span></td>
                    <td class="profile__address-street">
                        <input type="text" name="address[0]street" value="Советская" class="profile__field">
                    </td>
                    <td class="profile__address-house">
                        <input type="text" name="address[0]building" value="16" class="profile__field">
                    </td>
                    <td class="profile__address-app">
                        <input type="text" name="address[0]flat" value="24" class="profile__field">
                    </td>
                    <td class="profile__address-main">
                        <input type="radio" name="address[0]main" checked="true" class="profile__check">
                    </td>
                </tr>
                </tbody></table><a href="#" class="profile__address-add"><span class="profile__address-add-pic"></span><span class="profile__address-add-link">Добавить адрес</span></a>
            <div class="profile__butt-wrap">
                <button type="submit" class="profile__butt">СОХРАНИТЬ</button>
            </div>
        </div>
    </form>
</div>