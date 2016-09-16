<?
/**
 * Обновление шаблона почтового уведомления для подтверждения пароля
 */
define('BX_BUFFER_USED', true);
define('NO_KEEP_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS', true);
define('NO_AGENT_STATISTIC', true);
define('STOP_STATISTICS', true);
define('SITE_ID', 's1');

if (empty($_SERVER['DOCUMENT_ROOT'])) {
	$_SERVER['DOCUMENT_ROOT'] = realpath(__DIR__ . '/../../');
}

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

$em = new CEventMessage;

/**
 * id почтового уведомения
 */
$id = 5;

/**
 * Исправленное собщение уведомления
 */
$strMessage = "
Информационное сообщение сайта #SITE_NAME#
------------------------------------------

Здравствуйте,

Вы получили это сообщение, так как ваш адрес был использован при регистрации нового пользователя на сервере #SERVER_NAME#.

Для подтверждения регистрации перейдите по следующей ссылке:
http://#SERVER_NAME#/auth/index.php?confirm_registration=yes&confirm_user_id=#USER_ID#&confirm_code=#CONFIRM_CODE#

---------------------------------------------------------------------

Сообщение сгенерировано автоматически.
";

$arFields = Array(
	"ACTIVE"        => "Y",
	"EVENT_NAME"    => "NEW_USER_CONFIRM",
	"LID"           => array("s1"),
	"EMAIL_FROM"    => "#DEFAULT_EMAIL_FROM#",
	"EMAIL_TO"      => "#EMAIL#",
	"BCC"           => "",
	"SUBJECT"       => "#SITE_NAME#: Подтверждение регистрации нового пользователя",
	"MESSAGE"       => $strMessage,
	"BODY_TYPE"     => "text"
);

$res = $em->Update($id, $arFields);

if(!$res)
{
	$strError .= $em->LAST_ERROR."<br>";
	$bVarsFromForm = true;
}
else
{
	LocalRedirect(BX_ROOT."/admin/message_edit.php?lang=".LANGUAGE_ID."&ID=".$id);
}