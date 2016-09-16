<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $templateData */
/** @var @global CMain $APPLICATION */
use Bitrix\Main\Loader;
global $APPLICATION;

/**
 * Вывести ID элемента, нужно для кнопки положить в корзину.
 */
itc\CUncachedArea::startCapture();

echo $arResult["ID"];

$showElementDataProductId = itc\CUncachedArea::endCapture();
itc\CUncachedArea::setContent("showElementDataProductId", $showElementDataProductId);

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
	"ID" => $arResult['ID']
);

$rsElements = CIBlockElement::GetList(
	$arSort,
	$arFilter,
	false,
	false,
	$arSelect
);

$typeElement      = '';
$arTypeElement    = $GLOBALS["typeElement"];
$arMeasureElement = $GLOBALS["measureElement"];
$arMeasurePriceElement = $GLOBALS["measurePriceElement"];
$arStepElement    = $GLOBALS["stepElement"];

if($arItem = $rsElements->Fetch())
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

	$arItem['PRICE'] = $arItem['CATALOG_PRICE_1'];
	$arItem['DISCOUNT_PRICE'] = $discountValue;

	/**
	 * Вывести цены и скидки
	 */
	if($discountValue > 0)
	{
		if($arItem['PROPERTY_TIPTOVARA_VALUE'] <> "")
		{
			$arDiscount = CCatalogProduct::GetOptimalPrice($arItem['ID'], 1, $USER->GetUserGroupArray());

			itc\CUncachedArea::startCapture();
			?>
			<div class="goods__price _action"><?=getPrintFormatPrice(multiplyPrice($arDiscount['RESULT_PRICE']['DISCOUNT_PRICE'], $arItem['PROPERTY_TIPTOVARA_VALUE']), $arItem['PROPERTY_TIPTOVARA_MEASURE_PRICE'], 'goods__price-main', 'ct_el_price')?></div>
			<div class="goods__price _small"><?=getPrintFormatPrice(multiplyPrice($arItem['PRICE'], $arItem['PROPERTY_TIPTOVARA_VALUE']), $arItem['PROPERTY_TIPTOVARA_MEASURE_PRICE'], 'goods__price-main', 'ct_el_price')?></div>
			<?
			$showElementGoodsPrice = itc\CUncachedArea::endCapture();
			itc\CUncachedArea::setContent("showElementGoodsPrice", $showElementGoodsPrice);
		}
	}
	else
	{
		if($arItem['PROPERTY_TIPTOVARA_VALUE'] <> "")
		{
			itc\CUncachedArea::startCapture();
			?>
			<div class="goods__price"><?=getPrintFormatPrice(multiplyPrice($arItem['PRICE'],$arItem['PROPERTY_TIPTOVARA_VALUE']), $arItem['PROPERTY_TIPTOVARA_MEASURE_PRICE'], 'goods__price-main', 'ct_el_price')?></div>
			<?
			$showElementGoodsPrice = itc\CUncachedArea::endCapture();
			itc\CUncachedArea::setContent("showElementGoodsPrice", $showElementGoodsPrice);
			?>
			<?
		}
	}

	/**
	 * Получить количество элементов в корзине  и вывести актуальное число элементо в карточке
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

	itc\CUncachedArea::startCapture();

		if(in_array($arResult['ID'], $arBasketIds))
		{
			?>
			value="<?=$arResult['BASKET_QUANTITY'] = $arBasketItems[$arResult['ID']]['QUANTITY'] * $arItem['PROPERTY_TIPTOVARA_STEP'];?>"
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
	itc\CUncachedArea::setContent("showBasketQuantity", $showBasketQuantity);
}
unset($arItem);
?>