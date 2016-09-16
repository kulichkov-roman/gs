<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>

<?
$arAuthServices = $arPost = array();
if(is_array($arParams["~AUTH_SERVICES"])) {
    $arAuthServices = $arParams["~AUTH_SERVICES"];
}
if(is_array($arParams["~POST"])) {
    $arPost = $arParams["~POST"];
}
$socOnclickPattern = '#onclick="([^"]+)"#Us';
$arOnclicks = array();
foreach($arAuthServices as $key => $service){
    $matches = array();
    preg_match($socOnclickPattern, $service["FORM_HTML"], $matches);
    $onClickStr = $matches[ 1 ];
    $arOnclicks[strtolower($key)] = str_replace(array('user_birthday,', 'user_birthday'), '', $onClickStr);
}
if(!empty($arOnclicks)){
    foreach($GLOBALS["arSocAuthServices"] as $service){
        $onClickStr = $arOnclicks[$service];
        if($onClickStr){
            switch($service){
                case 'vkontakte':
                    $suffix = 'vk';
                    $text = 'войти через вконтакте';
                    break;
                case 'facebook':
                    $suffix = 'fb';
                    $text = 'войти через facebook';
                    break;
            }
            ?>
            <div class="login__<?=$suffix?>">
                <span class="login__<?=$suffix?>-pic"></span>
                <a href="javascript:void(0);" onclick="<?=$onClickStr?>" class="login__<?=$suffix?>-text"><?=$text?></a>
            </div>
        <?}
    }
}?>