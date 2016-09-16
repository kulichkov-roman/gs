<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

global $USER;

if(
	\Bitrix\Main\Loader::includeModule("sale") &&
	\Bitrix\Main\Loader::includeModule("catalog")
)
{
	$debug = false;

	/**
	 * @todo все строки вынести в lang файлы
	 */
	$arResult = array();

	$arResult['STATUS'] = 0;
	$arResult['ERROR'] = '';

	$arBasketItems = array();

	/**
	 * Для боевого режима
	 */
	if(!$debug)
	{
		$productId = intVal($_REQUEST['productId']);
		/**
		 * Считается согласно типа товара.
		 */
		$quantity  = intVal($_REQUEST['quantity']);

		$action    = intVal($_REQUEST['action']);
		/**
		 * Передача дополнительных параметров
		 */
		$productProps = $_REQUEST['product_props']['articul'];
	}
	else
	{
		/**
		 * Например: 300 грамм - это 3 товара по 100 грамм, и т.д.
		 * Пример запроса: /include/ajax/add2basket.php?action=add&productId=3405&quantity=3&price=80.40
		 */
		$productId = intVal($_GET['productId']);
		$quantity  = intVal($_GET['quantity']);
		$action    = $_GET['action'];

		$result    = array();

		//pre($productId, $quantity, $action);
	}

	if($productId > 0)
	{
		$arBasketItems = GetBasketList();

		$arInBasket = array();
		if(sizeof($arBasketItems) > 0)
		{
			foreach($arBasketItems as $arBasketItem)
			{
				$arInBasket[$arBasketItem['PRODUCT_ID']] = array(
					'basket_item_id' => $arBasketItem['ID'],
					'quantity' => $arBasketItem['QUANTITY']
				);
			}
		}

		switch($action)
		{
			/**
			 * Добавление товаров и удаление
			 * Если $quantity > 0, то элемент добавится, иначе удалится
			 */
			case 'add':
				/**
				 * Нельзя добавлять товары, если не указано количество.
				 */
				if($quantity > 0)
				{
					/**
					 * Если ID товар уже есть в корзине.
					 */
					if(array_key_exists($productId, $arInBasket))
					{
						if($debug)
						{
							//pre($arInBasket);
						}

						/**
						 * Обновить товар в корзине
						 */
						if(CSaleBasket::Update($arInBasket[$productId]['basket_item_id'], array('QUANTITY' => $quantity)))
						{
							$result['STATUS'] = 1;
						}
						else
						{
							$result['STATUS'] = 0;
							$result['ERROR'] = 'Событие: "add"; Ошибка: "Не удалось обновить корзину"';
						}
					}
					/**
					 * Добавить товар в корзину.
					 */
					else
					{
						$res = Add2BasketByProductID($productId, $quantity);

						if($res)
						{
							$result['STATUS'] = 1;
						}
						else
						{
							$result['STATUS'] = 0;
							$result['ERROR'] = 'Событие: "add"; Ошибка: "Не удалось добавить элемент"';
						}
					}
				}
				/**
				 * Если количество меньше нуля, то удалить товар из корзины.
				 */
				else
				{
					/**
					 * Проверить, есть ли товар в коризне, если да, то удалить.
					 */
					if(array_key_exists($productId, $arInBasket))
					{
						if(CSaleBasket::Delete($arInBasket[$productId]['basket_item_id']))
						{
							$result['STATUS'] = 1;
						}
						else
						{
							$result['STATUS'] = 0;
							$result['ERROR']  = 'Событие: "add"; Ошибка: "Не удалось удалить товар из корзины"';
						}
					}
				}
			break;
		}
	}

	if($result['STATUS'] == 1)
	{
		$arBasketItems = GetBasketList();

		$result['PRODUCT_QUANTITY'] = 0;
		$result['PRODUCT_PRICE'] = 0;
		$result['PRODUCT_TITLE'] = '';
		foreach($arBasketItems as $arBasketItem)
		{
			$result['PRODUCT_QUANTITY'] += $arBasketItem['QUANTITY'];
			$result['PRODUCT_PRICE'] += $arBasketItem['QUANTITY'] * $arBasketItem['PRICE'];
		}
	}

	if($debug)
	{
		switch($action)
		{
			case 'add':
				pre($result['STATUS']);
				pre($result['ERROR']);
				break;
		}
	}
}
else
{
	$result['STATUS'] = 0;
	$result['ERROR'] = 'Проверьте установку модуля sale и catalog.';
}

print json_encode($result);
?>