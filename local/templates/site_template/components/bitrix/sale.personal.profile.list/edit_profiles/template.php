<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="profile">
    <form method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
        <?=bitrix_sessid_post()?>
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
	                <td class="profile__address-district">
	                    <p class="profile__address-text">Район</p>
	                </td>
                    <td class="profile__address-main">
                        <p class="profile__address-text">Основной</p>
                    </td>
                </tr>
                <?
                if(!$arResult["PROFILES"]){?>
	                <tr class="profile__address-stroke _body">
	                    <td class="profile__address-del-cell"><a class="profile__address-del" href="<?=$urlToDelete?>" style="display: none;"></a></td>
	                    <td class="profile__address-street">
	                        <input type="text" name="PROFILE_PROPS[0][STREET]" value="<?=$arProfileProps["STREET"]["VALUE"]?>" class="profile__field">
	                    </td>
	                    <td class="profile__address-house">
	                        <input type="text" name="PROFILE_PROPS[0][HOUSE]" value="<?=$arProfileProps["HOUSE"]["VALUE"]?>" class="profile__field">
	                    </td>
	                    <td class="profile__address-app">
	                        <input type="text" name="PROFILE_PROPS[0][FLAT]" value="<?=$arProfileProps["FLAT"]["VALUE"]?>" class="profile__field">
	                    </td>
                       	<td class="profile__address-district">
                           	<select name="PROFILE_PROPS[0][PERSONAL_LOCATION]" class="profile__select">
                                <?foreach($arResult["LOCATIONS"] as $arLocation){?>
                                	<option value="<?=$arLocation["ID"]?>"><?=$arLocation["CITY_NAME"]?></option>
                                <?}?>
                            </select>
                        </td>
	                    <td class="profile__address-main">
	                        <input type="radio" name="PROFILE_PROPS[0][DEFAULT]" checked="true" class="profile__check">
	                        <input type="text" name="PROFILE_PROPS[0][PROFILE_ID]" value=""  style="display: none; visibility: hidden;"/>
	                    </td>
	                </tr>
                <?}else{
	                foreach($arResult["PROFILES"] as $key => $arProfile){
	                    $profileId = $arProfile["ID"];
	                    $urlToDelete = $arProfile["URL_TO_DETELE"];

	                    $arProfileProps = $arResult["PROFILE_PROPS"][$profileId];?>
	                <tr class="profile__address-stroke _body">
	                    <td class="profile__address-del-cell"><a class="profile__address-del" href="<?=$urlToDelete?>" style="display: none;"></a></td>
	                    <td class="profile__address-street">
	                        <input type="text" name="PROFILE_PROPS[<?=$key?>][STREET]" value="<?=$arProfileProps["STREET"]["VALUE"]?>" class="profile__field">
	                    </td>
	                    <td class="profile__address-house">
	                        <input type="text" name="PROFILE_PROPS[<?=$key?>][HOUSE]" value="<?=$arProfileProps["HOUSE"]["VALUE"]?>" class="profile__field">
	                    </td>
	                    <td class="profile__address-app">
	                        <input type="text" name="PROFILE_PROPS[<?=$key?>][FLAT]" value="<?=$arProfileProps["FLAT"]["VALUE"]?>" class="profile__field">
	                    </td>
	                    <td class="profile__address-district">
                            <select name="PROFILE_PROPS[<?=$key?>][PERSONAL_LOCATION]" class="profile__select">
                                <?foreach($arResult["LOCATIONS"] as $arLocation){?>
                                	<option <?if($arLocation["ID"] == $arProfileProps["PERSONAL_LOCATION"]["VALUE"]){?>selected<?}?> value="<?=$arLocation["ID"]?>"><?=$arLocation["CITY_NAME"]?></option>
                                <?}?>
                            </select>
                        </td>
	                    <td class="profile__address-main">
	                        <input type="radio" name="PROFILE_PROPS[<?=$key?>][DEFAULT]" <?if($arResult["DEFAULT_PROFILE_ID"] == $profileId){?> checked="true"<?}?> class="profile__check default_profile_radio">
	                        <input type="text" name="PROFILE_PROPS[<?=$key?>][PROFILE_ID]" value="<?=$profileId?>"  style="display: none; visibility: hidden;"/>
	                    </td>
	                </tr>
	                <?}
                }?>
                </tbody></table><a href="#" class="profile__address-add"><span class="profile__address-add-pic"></span><span class="profile__address-add-link">Добавить адрес</span></a>
            <div class="profile__butt-wrap">
                <button type="submit" name="save_profiles" value="Y" class="profile__butt">СОХРАНИТЬ</button>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('body').on('change','input[type=radio].default_profile_radio', function() {
            // When any radio button on the page is selected,
            // then deselect all other radio buttons.
            $('input[type=radio].default_profile_radio:checked').not(this).prop('checked', false);
        });
})
</script>
