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

if($USER->isAdmin())
{
    //pre($arResult);
}
?>
<div class="contacts">
    <p class="contacts__header"><?=$arResult['NAME']?></p>
    <p class="contacts__address"><?=($arResult['PROPERTIES']['INDEX']['VALUE'] ? $arResult['PROPERTIES']['INDEX']['VALUE'] : '')?> <?=($arResult['PROPERTIES']['ADDRESS']['VALUE'] ? $arResult['PROPERTIES']['ADDRESS']['VALUE'] : '')?></p>
    <p class="contacts__phone">Тел.: <?=($arResult['PROPERTIES']['PHONE']['VALUE'] ? $arResult['PROPERTIES']['PHONE']['VALUE'] : '')?></p>
    <?
    if(sizeof($arResult['PROPERTIES']['EMAIL']['VALUE']) > 0) {
        foreach($arResult['PROPERTIES']['EMAIL']['VALUE'] as $value) {
            ?>
            <a href="mailto:<?=$value?>" class="contacts__mail"><?=$value?></a>
            <?
        }
    }
    ?>
    <p class="contacts__text"><br> По вопросам рекламы просьба отправлять предложения на: <a class="contacts__mail" href="<?=($arResult['PROPERTIES']['EMAIL_DEFAULT']['VALUE'] ? $arResult['PROPERTIES']['EMAIL_DEFAULT']['VALUE'] : '')?>"><?=($arResult['PROPERTIES']['EMAIL_DEFAULT']['VALUE'] ? $arResult['PROPERTIES']['EMAIL_DEFAULT']['VALUE'] : '')?></a></p>
</div>
<?$this->SetViewTarget("showContactsMap");?>
    <div class="contacts-map">
        <div id="map-location" data-center="<?=($arResult['PROPERTIES']['MAP']['VALUE'] ? $arResult['PROPERTIES']['MAP']['VALUE'] : '')?>" data-hint-text="<?=($arResult['PROPERTIES']['HINT_TEXT']['VALUE'] ? $arResult['PROPERTIES']['HINT_TEXT']['VALUE'] : '')?>"></div>
    </div>
<?$this->EndViewTarget(); ?>
