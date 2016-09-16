<?php
/**
 * Создает почтовое событие и шаблон для отправки промокодов
 * по акции из SMS-рассылки
 */
ignore_user_abort(true);
set_time_limit(0);

define('BX_BUFFER_USED', true);
define('NO_KEEP_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS', true);
define('NO_AGENT_STATISTIC', true);
define('STOP_STATISTICS', true);

if (!defined('SITE_ID')) {
	define('SITE_ID', 's1');
}

if (empty($_SERVER['DOCUMENT_ROOT'])) {
	$_SERVER['HTTP_HOST'] = 'llmanikur.ru';
	$_SERVER['DOCUMENT_ROOT'] = realpath(__DIR__ . '/../../');
}

error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT);
ini_set('display_errors', 1);

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

$logger = new \Your\Tools\Logger\EchoLogger();

$eventType = new CEventType;
$eventId = $eventType->Add(
	array(
		'LID'         => 'ru',
		'EVENT_NAME'  => 'SMS_PROMO_ACTION_CODE_SENT',
		'NAME'        => 'Отправлен промокод по акции из SMS-рассылки',
		'DESCRIPTION' => '
			#CODE# - Промокод
			#EMAIL# - Адрес получателя
		'
	)
);

if ($eventId) {
	$logger->log('Event has been created');

	$eventMessage = new CEventMessage;

	$messageId = $eventMessage->Add(
		array(
			'ACTIVE'     => 'Y',
			'EVENT_NAME' => 'SMS_PROMO_ACTION_CODE_SENT',
			'LID'        => 's1',
			'EMAIL_FROM' => '#DEFAULT_EMAIL_FROM#',
			'EMAIL_TO'   => '#EMAIL#',
			'SUBJECT'    => 'Ваш промокод',
			'BODY_TYPE'  => 'html',
			'MESSAGE'    => '
Здравствуйте!

Ваш промокод: #CODE#'
		)
	);

	if ($messageId) {
		$logger->log('Message has been created');
	} else {
		$logger->log('Unable to create message');
	}
} else {
	$logger->log('Unable to create event');
}
