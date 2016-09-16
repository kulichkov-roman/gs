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

//echo "<pre>"; var_dump($arResult["PROPERTIES"]); echo "</pre>";
?>

<div class="about">
    <div class="about__header"><?=$arResult['NAME']?></div>
    <?if(sizeof($arResult['PROPERTIES']['MORE_PICTURE']['VALUE']) > 0){?>
        <div class="about__pics-wrap">
            <?foreach($arResult["PROPERTIES"]["MORE_PICTURE"]["VALUE_SRC"] as $arSrc){
                ?>
	            <a href="<?=$arSrc['DETAIL_PICTURE']['SRC']?>" class="about__pic-link">
		            <img src="<?=$arSrc['PREVIEW_PICTURE']['SRC']?>" class="about__pic">
	            </a>
	            <?
            }?>
        </div>
    <?}?>
    <?if($arResult["PROPERTIES"]["DETAIL_TEXT_TOP"]["VALUE"]["TEXT"] <> ""){?>
        <?=htmlspecialcharsBack($arResult["PROPERTIES"]["DETAIL_TEXT_TOP"]["VALUE"]["TEXT"])?>
    <?}?>
    <?if($arResult["PROPERTIES"]["VIDEO_W_YOUTUBE"]["VALUE"] <> ""){?>
        <div class="about__video"><?=htmlspecialcharsBack($arResult["PROPERTIES"]["VIDEO_W_YOUTUBE"]["VALUE"])?></div>
    <?}?>
    <?if($arResult["PROPERTIES"]["DETAIL_TEXT_BUTTOM"]["VALUE"]["TEXT"] <> ""){?>
        <?=htmlspecialcharsBack($arResult["PROPERTIES"]["DETAIL_TEXT_BUTTOM"]["VALUE"]["TEXT"])?>
    <?}?>
    <div class="about__site-block">
        <?if($arResult["PROPERTIES"]["LINK_SITE"]["DESCRIPTION"] <> ""){?>
            <a rel="nofollow" href="<?=$arResult["PROPERTIES"]["LINK_SITE"]["DESCRIPTION"]?>" class="about__logo">
                <img src="<?=$arResult["PROPERTIES"]["LOGOTYPE"]["VALUE_SRC"]?>">
            </a>
        <?}?>
        <?if($arResult["PROPERTIES"]["LINK_SITE"]["VALUE"] <> ""){?>
            <div class="about__site-left">
                <?if($arResult["PROPERTIES"]["LINK_SITE"]["DESCRIPTION"] <> ""){?>
                    <a href="<?=$arResult["PROPERTIES"]["LINK_SITE"]["DESCRIPTION"]?>" class="about__site-link">
                        <?=$arResult["PROPERTIES"]["LINK_SITE"]["VALUE"]?>
                    </a>
                <?} else {?>
                    <a class="about__site-link">
                        <?=$arResult["PROPERTIES"]["LINK_SITE"]["VALUE"]?>
                    </a>
                <?}?>
                <?if($arResult["PROPERTIES"]["INFO_TEXT"]["VALUE"]["TEXT"] <> ""){?>
                    <div class="about__site-text"><?=htmlspecialcharsBack($arResult["PROPERTIES"]["INFO_TEXT"]["VALUE"]["TEXT"])?></div>
                <?}?>
            </div>
        <?}?>
    </div>
</div>