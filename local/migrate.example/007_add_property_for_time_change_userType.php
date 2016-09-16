<?php
/**
 * Добавляет свойтсво пользовтаелю для сохранения последней даты смены типа пользователя
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

if (!CModule::IncludeModule('iblock')) {
	die('Unable to include "iblock" module');
}

/**
 * Добавление пользовательского свойства
 */
$oUserTypeEntity = new CUserTypeEntity();

$aUserFields = array(
	/*
	*  Идентификатор сущности, к которой будет привязано свойство.
	* Для секция формат следующий - IBLOCK_{IBLOCK_ID}_SECTION
	*/
	'ENTITY_ID' => 'USER',
	/* Код поля. Всегда должно начинаться с UF_ */
	'FIELD_NAME' => 'UF_TIME_CHANGE_TYPE',
	/* Указываем, что тип нового пользовательского свойства строка */
	'USER_TYPE_ID' => 'string',
	/*
	* XML_ID пользовательского свойства.
	* Используется при выгрузке в качестве названия поля
	*/
	'XML_ID' => 'UF_TIME_CHANGE_TYPE',
	/* Сортировка */
	'SORT' => 500,
	/* Является поле множественным или нет */
	'MULTIPLE' => 'N',
	/* Обязательное или нет свойство */
	'MANDATORY' => 'N',
	/*
	* Показывать в фильтре списка. Возможные значения:
	* не показывать = N, точное совпадение = I,
	* поиск по маске = E, поиск по подстроке = S
	*/
	'SHOW_FILTER' => 'N',
	/*
	* Не показывать в списке. Если передать какое-либо значение,
	* то будет считаться, что флаг выставлен (недоработка разработчиков битрикс).
	*/
	'SHOW_IN_LIST' => '',
	/*
	* Не разрешать редактирование пользователем.
	* Если передать какое-либо значение, то будет считаться,
	* что флаг выставлен (недоработка разработчиков битрикс).
	*/
	'EDIT_IN_LIST' => '',
	/* Значения поля участвуют в поиске */
	'IS_SEARCHABLE' => 'N',
	/*
* Дополнительные настройки поля (зависят от типа).
* В нашем случае для типа string
*/
	'SETTINGS' => array(
		/* Значение по умолчанию */
		'DEFAULT_VALUE' => '',
		/* Размер поля ввода для отображения */
		'SIZE' => '20',
		/* Количество строчек поля ввода */
		'ROWS' => '1',
		/* Минимальная длина строки (0 - не проверять) */
		'MIN_LENGTH' => '0',
		/* Максимальная длина строки (0 - не проверять) */
		'MAX_LENGTH' => '0',
		/* Регулярное выражение для проверки */
		'REGEXP' => '',
	),
	/* Подпись в форме редактирования */
	'EDIT_FORM_LABEL' => array(
		'ru' => 'Время последнего изменения типа пользователя',
		'en' => 'Last time type user changes',
	),
	/* Заголовок в списке */
	'LIST_COLUMN_LABEL' => array(
		'ru' => 'Время последнего изменения типа пользователя',
		'en' => 'Last time type user changes',
	),
	/* Подпись фильтра в списке */
	'LIST_FILTER_LABEL' => array(
		'ru' => 'Время последнего изменения типа пользователя',
		'en' => 'Last time type user changes',
	),
	/* Помощь */
	'HELP_MESSAGE' => array(
		'ru' => '',
		'en' => '',
	),
);

$iUserFieldId = $oUserTypeEntity->Add($aUserFields);

if($iUserFieldId){
	echo 'success added prop to user entity';
}else{
	echo 'error added prop to user entity';
}
