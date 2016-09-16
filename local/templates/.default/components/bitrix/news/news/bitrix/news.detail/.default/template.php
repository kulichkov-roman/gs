<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

//echo "<pre>"; var_dump($arResult); echo "</pre>";
?>

<div class="news">
    <div class="news__header"><?=$arResult["NAME"]?></div>
    <?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]){?>
        <div class="news__date"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></div>
    <?}?>
    <div class="news__pic-wrap">
        <a class="news__pic-link" href="<?=$arResult["DETAIL_PICTURE_BIG"]["SRC"]?>">
	        <img class="news__pic" src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>">
	    </a>
    </div>
	<div class="news__content">
        <?if($arResult['DETAIL_TEXT'] <> ""){?>
            <?=$arResult['DETAIL_TEXT']?>
        <?}?>
	</div>
    <?if($arResult['PROPERTIES']['FAT_TEXT']['VALUE']["TEXT"] <> ""){?>
        <p class="news__text _fat">
            <?=htmlspecialcharsBack($arResult['PROPERTIES']['FAT_TEXT']['VALUE']["TEXT"])?>
        </p>
    <?}?>
    <div class="news__separator"></div>
    <div class="news__share">
        <script type="text/javascript" src="//yastatic.net/share/share.js" charset="utf-8"></script><div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="small" data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,moimir" data-yashareTheme="counter"></div>
    </div>
</div>