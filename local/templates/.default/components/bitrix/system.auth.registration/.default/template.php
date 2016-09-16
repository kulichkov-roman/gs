<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<?$APPLICATION->IncludeComponent(
	"your:main.register",
	"", 
	array(
		"USER_PROPERTY_NAME" => "",
		"SEF_MODE" => "N",
		"SHOW_FIELDS" => array(
			0 => "EMAIL",
			1 => "NAME",
			2 => "LAST_NAME",
			3 => "PERSONAL_GENDER"
		),
		"REQUIRED_FIELDS" => array(
			0 => "EMAIL",
			1 => "NAME",
			2 => "LAST_NAME",
		),
		"AUTH" => "Y",
		"USE_BACKURL" => "Y",
		"SUCCESS_PAGE" => "/personal/profile/?register=yes&auth_result=ok",
		"SET_TITLE" => "Y",
		"USER_PROPERTY" => array(
			"UF_DISCOUNT_CARD",
			"UF_GROUP_YEAR",
			"UF_HOW_NEW_AA",
			"UF_DATE_BTHD"
		)
	),
	false
);?>