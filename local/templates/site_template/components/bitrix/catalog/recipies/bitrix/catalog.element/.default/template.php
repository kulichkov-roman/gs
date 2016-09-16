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
if($arResult["BACK_URL"]){?>
	<a href="<?=$arResult["BACK_URL"]?>" class="content__back">к списку рецептов</a>
<?}?>
<div class="reciepe">
    <div class="reciepe__top">
        <div class="reciepe__pic-wrap">
        	<?$pictId = $arResult["PREVIEW_PICTURE"]["ID"];
        	if(!$pictId){
        		$pictId = NO_PH_REP_BG;
        	}?>
            <a href="<?=itc\Resizer::get($pictId, getPresetName('reciepeDetailPopup', $pictId))?>" class="reciepe__pic-link">
        	<img src="<?=itc\Resizer::get($pictId, getPresetName('reciepeDetail', $pictId))?>" class="reciepe__pic">
            </a>
        </div>
        <div class="reciepe__info">
            <div class="reciepe__name"><?=$arResult["NAME"]?></div>
            <div class="reciepe_cat-block">
            	<?if($arResult["CATEGORY"]){?>
                	<div class="reciepe__cat"><?=$arResult["CATEGORY"]?></div>
            	<?}?>
            	<?if($arResult["SUB_CATEGORY"]){?>
                	<div class="reciepe__subcat"><?=$arResult["SUB_CATEGORY"]?></div>
            	<?}?>
            </div>
            <?/*$arIconIds = $arResult["PROPERTIES"]["ICONS"]["VALUE"];*/
            if($arResult["ICONS"]){?>
	            <div class="reciepe__specials">
	            	<?foreach($arResult["ICONS"] as $arIcon){
	            		//$arIcon = $arResult["ICONS"][$iconId];
                        ?>
	                	<div class="reciepe__specials-item <?=$arIcon["PROPERTIES"]["CLASS"]["VALUE"]?>"><span class="reciepe__specials-pic"></span><span class="reciepe__specials-text"><?=$arIcon["NAME"]?></span></div>
	                <?}?>
	            </div>
            <?}?>
            <div class="reciepe__specials-separator"></div>
            <?
            $arIngredients = $arResult["PROPERTIES"]["INGREDIENTS"]["VALUE"];
            $arDescriptions = $arResult["PROPERTIES"]["INGREDIENTS"]["DESCRIPTION"];
            if($arIngredients){?>
            <div class="reciepe__ingredients">
                <div class="reciepe__ingredients-header">Ингредиенты:
                    <ul class="reciepe__ingredients-list">
                        <?foreach($arIngredients  as $ingredientKey => $ingredient){?>
                        	<li class="reciepe__ingredients-item">
                        			<span class="reciepe__ingredients-name"><?=$ingredient?></span>
                        		<?
                        		$description = $arDescriptions[$ingredientKey];
                        		if($description){?>
	                        		<span class="reciepe__ingredients-measure"><?=$description?></span>
                        		<?}?>
                        	</li>
                        <?}?>
                    </ul>
                </div>
            </div>
            <?}?>
        </div>
    </div>
    <div class="reciepe__process">
    	<?if($arResult["DETAIL_TEXT"]){?>
	        <p class="reciepe__process-header">Процесс</p>
	        <div class="reciepe__process-list_custom reciepe__process-list">
	        <?=$arResult["DETAIL_TEXT"]?>
	        </div>
    	<?}?>
        <div class="reciepe__separator"></div>
    </div>
    <?itc\CUncachedArea::show('reciepeShare')?>
</div>