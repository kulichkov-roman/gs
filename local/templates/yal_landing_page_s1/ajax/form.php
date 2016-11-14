<?
define("NO_KEEP_STATISTIC", true);
define("NO_AGENT_CHECK", true);
define("NOT_CHECK_PERMISSIONS", true);

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$json['element_id'] = false;
$json['error'] = false;

if(check_bitrix_sessid())
{
	if(strtolower(SITE_CHARSET) == "windows-1251"){
		$arNewPost = array();
		foreach($_POST as $fieldName => $fieldValue){
			$arNewPost[$fieldName] = iconv('utf-8', 'windows-1251', $fieldValue);
		}
		$_POST = $arNewPost;
	}

	$arAvailableForms = array(
		'top79_1'    => 'Успей заказать',
		'center80_1' => 'Узнайте выгодные условия приобретения',
		'center80_2' => 'Запишитесь на тест-драйв',
		'center80_3' => 'Получите специальное предложение',
		'autopark_1' => htmlspecialcharsbx($_REQUEST['type']),
	);
	
	CModule::IncludeModule("iblock");
	$obNewElement = new CIBlockElement;

	$arAddFields = array(
		"NAME" => $_POST["name"],
		"IBLOCK_ID" => "4",
		"ACTIVE" => "N"
	);

	$arAddFields["PROPERTY_VALUES"] = array(
		"TYPE" => intval($_POST["type"]),
		"PHONE" => htmlspecialcharsbx($_POST["phone"]),
		"MAIL" => htmlspecialcharsbx($_POST["email"]),
		"FORM_NAME" => $arAvailableForms[$_REQUEST["formId"]],
	);

	$json["form_type"] = intval($_POST["type"]);

	if ($elementId = $obNewElement->Add($arAddFields))
	{
		$json['element_id'] = $elementId;

		$obElement = CIBlockElement::GetByID($elementId)->GetNextElement();
		$arElement = $obElement->GetFields();
		$arElement["PROPERTIES"] = $obElement->GetProperties();

		$arMailFields["NAME"] = $arElement["NAME"];
		$arMailFields["PHONE"] = $arElement["PROPERTIES"]["PHONE"]["VALUE"];
		$arMailFields["MAIL"] = $arElement["PROPERTIES"]["MAIL"]["VALUE"];
		$arMailFields["TYPE"] = $arElement["PROPERTIES"]["TYPE"]["VALUE"];
		$arMailFields["FORM_NAME"] = $arAvailableForms[$_REQUEST["formId"]];

		// Admin link
		$rsIblock = CIBlock::GetByID($arElement['IBLOCK_ID']);
		if($arIblock = $rsIblock->GetNext()){
			$arMailFields['DIRECT_LINK'] = 'http://'.$_SERVER['SERVER_NAME'].'/bitrix/admin/iblock_element_edit.php?ID='.$arElement['ID'].'&type='.$arIblock['IBLOCK_TYPE_ID'].'&IBLOCK_ID='.$arElement['IBLOCK_ID'];
		}

		CEvent::Send("YAL_REQUEST_FORM", SITE_ID, $arMailFields);
		CEvent::CheckEvents();
	}
	else
	{
		$json['error'] = $obNewElement->LAST_ERROR;
	}
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($json);
?>
