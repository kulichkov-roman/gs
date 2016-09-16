<?php
/**
 * Добавление свойства для удаления сообщений в инфоблок сообщений
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

function GetGroupByCode($code)
{
	$rsGroups = CGroup::GetList($by = "id", $order = "desc", Array("STRING_ID" => $code));
	return $rsGroups->Fetch();
}

$aCodeGroups = array('rehauGroup', 'forumBan', 'siteBan');

$group = new CGroup;
foreach ($aCodeGroups as $codeGroup) {
	$arGroup = GetGroupByCode($codeGroup);
	if ($arGroup['ID']) {
		echo 'Group with name ' . $arGroup['NAME'] . ' already exist<br/>';
	}else{
		$arFields = Array(
			"ACTIVE"       => "Y",
			"C_SORT"       => 100,
			"NAME"         => "Группа Rehau",
			"DESCRIPTION"  => "",
			"STRING_ID"      => $codeGroup
		);
		if($codeGroup == 'rehauGroup'){
			$arFields['USER_ID'] = array(183, 249, 252);
		}
		$NEW_GROUP_ID = $group->Add($arFields);
		if($NEW_GROUP_ID){
			echo 'group with code '.$codeGroup. ' created<br/>';
			if($codeGroup == 'rehauGroup'){
				echo "users added to group with id's ". implode(" ", $arFields["USER_ID"])."<br/>";
			}
		}else{
			echo 'error group with code '.$codeGroup. ' not created<br/>';
		}
	}
}


