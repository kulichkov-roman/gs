<?php
/**
 * Добавляет тип почтового события и шаблон для отправки уведомлений пользователям.
 */
define('BX_BUFFER_USED', true);
define('NO_KEEP_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS', true);
define('NO_AGENT_STATISTIC', true);
define('STOP_STATISTICS', true);
define('SITE_ID', 's1');

if (empty($_SERVER['DOCUMENT_ROOT'])) {
	$_SERVER['HTTP_HOST'] = 'rehau.pro';
	$_SERVER['DOCUMENT_ROOT'] = realpath(__DIR__ . '/../../');
}

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

while (ob_get_level()) {
	ob_end_flush();
}

use \Rehau\Service\SendNotificationAdmin;

$eventId = SendNotificationAdmin::EVENT_ID;

$rsET = CEventType::GetByID($eventId, "ru");
if(!$arET = $rsET->Fetch()){
	$et = new CEventType;
	$eventAddedId = $et->Add(array(
		"LID"           => 'ru',
		"EVENT_NAME"    => $eventId,
		"NAME"          => 'Уведомление администратора',
		"DESCRIPTION"   => ''
	));
	if($eventAddedId){
		echo 'message event_id created'.PHP_EOL;
		$arFilter = Array(
			"TYPE_ID"       => $eventId,
			"ACTIVE"        => "Y"
		);
		$rsMess = CEventMessage::GetList($by="site_id", $order="desc", $arFilter);
		if($arMess = $rsMess->GetNext()){
			$arr["ACTIVE"] = "Y";
			$arr["EVENT_NAME"] = $eventId;
			$arr["LID"] = array("s1");
			$arr["EMAIL_FROM"] = "#DEFAULT_EMAIL_FROM#";
			$arr["EMAIL_TO"] = "#DEFAULT_EMAIL_FROM#";
			$arr["BCC"] = "#BCC#";
			$arr["SUBJECT"] = "Уведомление с сайта #SITE_NAME#:#SUBJECT#";
			$arr["BODY_TYPE"] = "html";
			$arr["MESSAGE"] = "#TEXT#";

			$emess = new CEventMessage;
			if($emess->Add($arr)){
				echo 'error message for event created'.PHP_EOL;
			};
		}else{
			echo 'error message for event not created'.PHP_EOL;
		}
	}else{
		echo $et->LAST_ERROR.PHP_EOL;
	}
}else{
	echo 'migration already execute'.PHP_EOL;
}
