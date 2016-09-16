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
<div class="goods__main">
    <div class="goods__top">
        <!-- href - самая большая фотка. используется для показа в галлерее-->
        <!-- display - фотка, которая показывается на странице на месте главного фото-->
        <div data-items='<?=$arResult["PICTS_FOR_SCRIPT"]?>' class="goods__gallery">
	        <?if(
		        $arResult["PROPERTIES"]["NOVINKA"]["VALUE"] == "Y" ||
		        $arResult["PROPERTIES"]["AKTSII"]["VALUE"] == "Y" ||
		        $arResult["PROPERTIES"]["KHIT"]["VALUE"] == "Y"
	        ){?>
		        <div class="goods__bar-box">
			        <?if($arResult["PROPERTIES"]["NOVINKA"]["VALUE"] == "Y"){?>
				        <img src="/images/label-new.png" class="goods__label">
			        <?}?>
			        <?if($arResult["PROPERTIES"]["AKTSII"]["VALUE"] == "Y"){?>
				        <img src="/images/label-promo.png" class="goods__label">
			        <?}?>
			        <?if($arResult["PROPERTIES"]["KHIT"]["VALUE"] == "Y"){?>
				        <img src="/images/label-hit.png" class="goods__label">
			        <?}?>
		        </div>
	        <?}?>
            <!-- Вот тут, если нет фото, то надо к классу рисунка goods__big-pic добавить ещё класс _no-photo-->
            <!-- чтобы скрипт не пытался открыть галлерею--><img src="<?=reset($arResult["MIDDLE_PICTS"])?>" alt="" class="goods__big-pic">
            <div class="goods__small-gallery"><?$bFirst = true; foreach($arResult["SMALL_PICTS"] as $src){?><span class="goods__small-pic-wrap <?if($bFirst){?>_selected<?}?>"><img src="<?=$src?>" alt="" class="goods__small-pic"></span><? $bFirst = false;}?></div>
        </div>
        <div class="goods__info">
            <?if($arResult['PROPERTIES']['CML2_ARTICLE']['VALUE'] <> ""){?>
                <span class="goods__art">Артикул: <?=$arResult['PROPERTIES']['CML2_ARTICLE']['VALUE'];?></span>
            <?}?>
	        <?
		    /**
		     * Цены и скидки вынесены в некешируемые области.
		     */
		    itc\CUncachedArea::show('showElementGoodsPrice');
	        ?>
	        <!--<div class="goods__price _small"><span class="goods__price-main">1300</span><span class="goods__price-tenth">,00</span><span class="goods__price-text">руб./кг</span></div>-->
            <div class="goods__add-form"><span class="goods__add-less"></span>
                <input readonly="readonly" <?if($arResult["PROPERTIES"]["MIN_LIMIT"]["VALUE"] <> ''){?>data-min="<?=$arResult["PROPERTIES"]["MIN_LIMIT"]["VALUE"]?>"<?} else {?><?=$arResult['PROPERTIES']['TIPTOVARA']['STEP'] <> '' ? 'data-min="'.$arResult['PROPERTIES']['TIPTOVARA']['STEP'].'"' : "";?><?}?> <?=$arResult['PROPERTIES']['TIPTOVARA']['STEP'] <> '' ? 'data-step="'.$arResult['PROPERTIES']['TIPTOVARA']['STEP'].'"' : "";?> <?=$arResult['PROPERTIES']['TIPTOVARA']['TYPE'] <> '' ? 'data-type="'.$arResult['PROPERTIES']['TIPTOVARA']['TYPE'].'"' : "";?> type="text" <?itc\CUncachedArea::show('showBasketQuantity');?> maxlength="5" class="goods__add-field"><span class="goods__add-form-text"><?=$arResult['PROPERTIES']['TIPTOVARA']['MEASURE'] <> "" ? $arResult['PROPERTIES']['TIPTOVARA']['MEASURE'] : '';?></span><span class="goods__add-more"></span>
            </div>
            <button type="button" class="goods__add-butt">В корзину</button>
            <button type="button" class="goods__buy-butt">купить в один клик</button>
            <div class="goods__info-separator"></div>
	        <?if($arResult['DETAIL_TEXT'] <> ""){?>
	            <p class="goods__info-text">
			        <?=$arResult['DETAIL_TEXT'];?>
	            </p>
	        <?}?>
            <div class="goods__info-separator"></div>
            <div class="goods__share">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include", "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => "/include/site_templates/ct_el_yandex_share.php"
                    ),
                    false,
                    array(
                        "HIDE_ICONS" => "Y"
                    )
                );?>
            </div>
        </div>
    </div>
    <div class="goods__bottom">
        <div class="goods__bottom-separator"></div>
        <?if(is_array($arResult['PROPERTIES']['RECIPES']['VALUE'])){?>
            <?$arRecipes = $arResult['PROPERTIES']['RECIPES']['VALUE'];?>
            <div class="goods__reciepe">
                <span class="goods__reciepe-header">Вкусный рецепт</span>
                <a href="<?=$arRecipes['DETAIL_PAGE_URL']?>" class="goods__reciepe-block"><img src="<?=$arRecipes['PREVIEW_PICTURE']['SRC']?>" class="goods__reciepe-pic">
                    <div class="goods__reciepe-info">
                        <p class="goods__reciepe-name"><?=$arRecipes['NAME']?></p>
                        <span class="goods__reciepe-type"><?=$arRecipes['SECTION']['NAME']?></span>
                    </div>
                </a>
            </div>
        <?}?>
        <div class="goods__deliver">
            <p class="goods__deliver-header">Доставка и оплата</p>
	        <?$APPLICATION->IncludeFile("/include/page_templates/element_delivery.php", Array(), Array("MODE" => "html"));?>
	        <p class="goods__deliver-text"><a href="<?=DELIVERY_PAYMENT_URL?>" class="goods__deliver-link">Подробнее об условиях доставки</a></p>
        </div>
    </div>
</div>