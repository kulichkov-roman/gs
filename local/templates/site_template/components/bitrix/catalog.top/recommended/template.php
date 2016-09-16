<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */

$this->setFrameMode(true);

if($USER->isAdmin())
{
    //pre($arResult);
}
?>

<?if(sizeof($arResult['ITEMS']) > 0){?>
	<div class="recommended">
	    <div class="recommended__head"><span class="recommended__title">рекомендуем</span></div>
	    <div class="recommended__list">
	        <div data-interval="5000" class="recommended__list-inner _raw">
	            <?foreach($arResult['ITEMS'] as $arItems){?>
		            <div>
			            <?foreach($arItems as $arItem){?>
				            <?
				            if($USER->isAdmin())
				            {
					            //pre($arItem["PROPERTIES"]["MIN_LIMIT"]);
				            }
				            ?>
				            <div data-product-id="<?=$arItem['ID']?>" class="offer-item">
		                        <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="offer-item__link">
	                                <?if(
	                                    $arItem['PROPERTY_NOVINKA'] === "Y" ||
	                                    $arItem['PROPERTY_AKTSII'] === "Y" ||
	                                    $arItem['PROPERTY_KHIT'] === "Y"
	                                ){?>
	                                    <div class="offer-item__bar-box">
	                                        <?if($arItem['PROPERTY_NOVINKA'] === "Y"){?>
	                                            <img src="/images/label-new.png" class="offer-item__label">
	                                        <?}?>
	                                        <?if($arItem['PROPERTY_AKTSII'] === "Y"){?>
		                                        <img src="/images/label-promo.png" class="offer-item__label">
	                                        <?}?>
	                                        <?if($arItem['PROPERTY_KHIT'] === "Y"){?>
		                                        <img src="/images/label-hit.png" class="offer-item__label">
	                                        <?}?>
	                                    </div>
	                                <?}?>
	                                <img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>" class="offer-item__pic">
			                        <div class="offer-item__descr">
				                        <span class="offer-item__name"><?=$arItem["NAME"]?></span>
				                        <?
					                    /**
					                     * Цены и скидки вынесены в некешируемые области.
					                     */
					                    itc\CUncachedArea::show('showElementRecommendedPrice'.$arItem['ID']);
				                        ?>
			                        </div>
	                            </a>
	                            <div class="offer-item__add">
		                            <div class="offer-item__form">
			                            <span class="offer-item__less"></span>
			                            <input readonly="readonly" <?if($arItem["PROPERTIES"]["MIN_LIMIT"]["VALUE"] <> ''){?>data-min="<?=$arItem["PROPERTIES"]["MIN_LIMIT"]["VALUE"]?>"<?} else {?><?=$arItem['PROPERTIES']['TIPTOVARA']['STEP'] <> '' ? 'data-min="'.$arItem['PROPERTIES']['TIPTOVARA']['STEP'].'"' : "";?><?}?> <?=$arItem['PROPERTIES']['TIPTOVARA']['STEP'] <> '' ? 'data-step="'.$arItem['PROPERTIES']['TIPTOVARA']['STEP'].'"' : "";?> <?=$arItem['PROPERTIES']['TIPTOVARA']['TYPE'] <> '' ? 'data-type="'.$arItem['PROPERTIES']['TIPTOVARA']['TYPE'].'"' : "";?> type="text" <?itc\CUncachedArea::show('showBasketQuantityRecommended'.$arItem['ID']);?> maxlength="5" class="offer-item__field">
			                            <span class="offer-item__form-text"><?=$arItem['PROPERTIES']['TIPTOVARA']['MEASURE'] <> "" ? $arItem['PROPERTIES']['TIPTOVARA']['MEASURE'] : '';?></span>
			                            <span class="offer-item__more"></span>
		                            </div>
	                                <div class="offer-item__cart">
	                                    <span class="offer-item__cart-pic"></span>
	                                </div>
	                            </div>
	                        </div>
			            <?}?>
				    </div>
	            <?}?>
	        </div>
	    </div>
	</div>
<?}?>