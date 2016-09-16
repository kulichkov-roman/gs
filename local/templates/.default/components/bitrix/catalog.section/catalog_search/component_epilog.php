<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $templateData */
/** @var @global CMain $APPLICATION */
use Bitrix\Main\Loader;

global $APPLICATION, $USER;

$APPLICATION->AddChainItem($arResult['NAME'],'');

/**
 * Вывести "показать по"
 */
itc\CUncachedArea::startCapture();
?>
<div class="catalog__amount">
	<span class="catalog__sort-text">Показывать:</span>
		<?
		/**
		 * @todo работает только для одно случая
		 */
		global $APPLICATION;
		$link    = $APPLICATION->GetCurPageParam("PER_PAGE=".ELEMENTS_COUNT, array("SHOWALL_1"));
		$linkAll = $APPLICATION->GetCurPageParam("SHOWALL_1=1", array("PER_PAGE"));

		if(!isset($_GET['PER_PAGE']) && !isset($_GET['SHOWALL_1']))
		{
			$activeLink  = true;
			$activeLinkAll = false;
		}
		elseif(isset($_GET['PER_PAGE']) || !isset($_GET['SHOWALL_1']))
		{
			$activeLink  = true;
			$activeLinkAll = false;
		}
		elseif(!isset($_GET['PER_PAGE']) || isset($_GET['SHOWALL_1']))
		{
			$activeLink  = false;
			$activeLinkAll = true;
		}
		?>
	<a href="<?=$link?>" class="<?=$activeLink ? 'catalog__sort-chosen' : 'catalog__sort-link'?>">по 15</a>
	<a href="<?=$linkAll?>" class="<?=$activeLinkAll ? 'catalog__sort-chosen' : 'catalog__sort-link'?>">все</a>
</div>
<?
$showTopPaginator = itc\CUncachedArea::endCapture();
itc\CUncachedArea::setContent('showTopPaginator', $showTopPaginator);

/**
 * Получить элементы текущего раздела
 */
$arSort = array();
$arSelect = array(
	"ID",
	"NAME",
	"CATALOG_GROUP_".PRICE_BASE_TYPE_ID,
	"PROPERTY_TIPTOVARA",
	"PROPERTY_MIN_LIMIT"
);
$arFilter = array(
	"IBLOCK_ID" => CATALOG_IBLOCK_ID,
);

$rsElements = CIBlockElement::GetList(
	$arSort,
	$arFilter,
	false,
	false,
	$arSelect
);

/**
 * Получить количество элементов в корзине и вывести актуальное число элементов в списке
 */
$arID = array();
$arBasketItems = array();
$arBasketIds = array();

$dbBasketItems = CSaleBasket::GetList(
	array(
		"NAME" => "ASC",
		"ID" => "ASC"
	),
	array(
		"FUSER_ID" => CSaleBasket::GetBasketUserID(),
		"LID" => SITE_ID,
		"ORDER_ID" => "NULL"
	),
	false,
	false,
	array(
		"ID",
		"CALLBACK_FUNC",
		"MODULE",
		"PRODUCT_ID",
		"QUANTITY",
		"PRODUCT_PROVIDER_CLASS"
	)
);
while ($arItems = $dbBasketItems->Fetch())
{
	if ('' != $arItems['PRODUCT_PROVIDER_CLASS'] || '' != $arItems["CALLBACK_FUNC"])
	{
		CSaleBasket::UpdatePrice($arItems["ID"],
			$arItems["CALLBACK_FUNC"],
			$arItems["MODULE"],
			$arItems["PRODUCT_ID"],
			$arItems["QUANTITY"],
			"N",
			$arItems["PRODUCT_PROVIDER_CLASS"]
		);
		$arID[] = $arItems["ID"];
	}
}
if (!empty($arID))
{
	$dbBasketItems = CSaleBasket::GetList(
		array(
			"NAME" => "ASC",
			"ID" => "ASC"
		),
		array(
			"ID" => $arID,
			"ORDER_ID" => "NULL"
		),
		false,
		false,
		array(
			"ID",
			"CALLBACK_FUNC",
			"MODULE",
			"PRODUCT_ID",
			"QUANTITY",
			"DELAY",
			"CAN_BUY",
			"PRICE",
			"WEIGHT",
			"PRODUCT_PROVIDER_CLASS",
			"NAME"
		)
	);
	while ($arItems = $dbBasketItems->Fetch())
	{
		$arBasketItems[$arItems['PRODUCT_ID']] = $arItems;
		$arBasketIds[] = $arItems['PRODUCT_ID'];
	}
}

$typeElement      = '';
$arTypeElement    = $GLOBALS["typeElement"];
$arMeasureElement = $GLOBALS["measureElement"];
$arMeasurePriceElement = $GLOBALS["measurePriceElement"];
$arStepElement    = $GLOBALS["stepElement"];

$arElement = array();
while ($arItem = $rsElements->Fetch())
{
	/**
	 * Определить тип товара
	 */
	foreach($arTypeElement as $type=>$value)
	{
		if($type == $arItem['PROPERTY_TIPTOVARA_VALUE'])
		{
			$typeElement = $type;
			$arItem['PROPERTY_TIPTOVARA_TYPE'] = $value;
			break;
		}
	}

	/**
	 * Определить меру товара
	 */
	$arItem['PROPERTY_TIPTOVARA_MEASURE'] = $arMeasureElement[$arItem['PROPERTY_TIPTOVARA_TYPE']];
	$arItem['PROPERTY_TIPTOVARA_MEASURE_PRICE'] = $arMeasurePriceElement[$arItem['PROPERTY_TIPTOVARA_TYPE']];

	/**
	 * Определить количество грамм
	 */
	$arItem['PROPERTY_TIPTOVARA_STEP'] = $arStepElement[$typeElement];

	$arDiscountPrice = CCatalogDiscount::GetDiscountByProduct(
		$arItem['ID'],
		$USER->GetUserGroupArray(),
		"N",
		PRICE_BASE_TYPE_ID,
		SITE_ID
	);

	$arDiscountPrice = array_shift($arDiscountPrice);

	$discountValue = 0;
	if($arDiscountPrice['VALUE'] > 0)
	{
		$discountValue = $arItem['CATALOG_PRICE_1'] - ($arItem['CATALOG_PRICE_1'] * ($arDiscountPrice['VALUE'] / 100.0));
	}

	itc\CUncachedArea::startCapture();

	if(in_array($arItem['ID'], $arBasketIds))
	{
		?>
		value="<?=$arItem['BASKET_QUANTITY'] = $arBasketItems[$arItem['ID']]['QUANTITY'] * $arItem['PROPERTY_TIPTOVARA_STEP'];?>"
		<?
	}
	else
	{
		if($arItem['PROPERTY_MIN_LIMIT_VALUE'] <> "")
		{
			?>
			value="<?=$arItem['BASKET_QUANTITY'] = $arItem['PROPERTY_MIN_LIMIT_VALUE'];?>"
			<?
		}
		else
		{
			?>
			value="<?=$arItem['BASKET_QUANTITY'] = $arItem['PROPERTY_TIPTOVARA_STEP'];?>"
			<?
		}
	}

	$showBasketQuantity = itc\CUncachedArea::endCapture();
	itc\CUncachedArea::setContent("showBasketQuantity".$arItem['ID'], $showBasketQuantity);

	$arElement[] = array(
		'ID' => $arItem['ID'],
		'PRICE' => $arItem['CATALOG_PRICE_1'],
		'DISCOUNT_PRICE' => $discountValue,
		'PROPERTY_TIPTOVARA_VALUE' => $arItem['PROPERTY_TIPTOVARA_VALUE'],
		'PROPERTY_TIPTOVARA_TYPE' => $arItem['PROPERTY_TIPTOVARA_TYPE'],
		'PROPERTY_TIPTOVARA_MEASURE' => $arItem['PROPERTY_TIPTOVARA_MEASURE'],
		'PROPERTY_TIPTOVARA_MEASURE_PRICE' => $arItem['PROPERTY_TIPTOVARA_MEASURE_PRICE'],
		'PROPERTY_TIPTOVARA_STEP' => $arStepElement[$typeElement],
		'BASKET_QUANTITY' => $arItem['BASKET_QUANTITY']
	);
}

/**
 * Вывести цены
 */
foreach($arElement as $arItem)
{
	if(intval($arItem['DISCOUNT_PRICE']) > 0)
	{
		/**
		 * Получение скидок через CCatalogProduct::GetOptimalPrice, необходимо для работы дисконтных карт.
		 */
		if(in_array($arItem['ID'], $arBasketIds))
		{
			$quantity = $arBasketItems[$arItem['ID']]['QUANTITY'];
		}
		else
		{
			$quantity = 1;
		}

		$arDiscount = CCatalogProduct::GetOptimalPrice($arItem['ID'], $quantity, $USER->GetUserGroupArray());

		itc\CUncachedArea::startCapture();
		?>
		<span class="offer-item__price">
			<span class="offer-item__old-price">
				<?=getPrintFormatPrice(multiplyPrice($arItem['PRICE'], $arItem['PROPERTY_TIPTOVARA_VALUE']), $currency = $arItem['PROPERTY_TIPTOVARA_MEASURE_PRICE'], $class = 'offer-item__price-crossed', 'wh_measure_cat_list')?>
			</span>
			<span class="offer-item__new-price">
				<?=getPrintFormatPrice(multiplyPrice($arDiscount['RESULT_PRICE']['DISCOUNT_PRICE'], $arItem['PROPERTY_TIPTOVARA_VALUE']), $currency = $arItem['PROPERTY_TIPTOVARA_MEASURE_PRICE'], $class = 'offer-item__new-price-num', 'wh_measure_cat_list')?>
			</span>
		</span>
		<?
		$showElementGoodsPrice = itc\CUncachedArea::endCapture();
		itc\CUncachedArea::setContent("showElementGoodsPrice".$arItem['ID'], $showElementGoodsPrice);
	}
	else
	{
		if($arItem['PROPERTY_TIPTOVARA_VALUE'] <> "")
		{
			itc\CUncachedArea::startCapture();
			?>
			<?=getPrintFormatPrice(multiplyPrice($arItem['PRICE'], $arItem['PROPERTY_TIPTOVARA_VALUE']), $currency = $arItem['PROPERTY_TIPTOVARA_MEASURE_PRICE'], $class = 'offer-item__price', 'wh_measure_cat_list')?>
			<?
			$showElementGoodsPrice = itc\CUncachedArea::endCapture();
			itc\CUncachedArea::setContent("showElementGoodsPrice".$arItem['ID'], $showElementGoodsPrice);
		}
	}
}
unset($arElement);
?>