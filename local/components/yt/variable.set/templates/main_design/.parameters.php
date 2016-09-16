<?php

$set = array(
	'header' => 'Заголовок',
	'text' => 'Текст',
	'link_title' => 'Заголовок кнопки',
	'link' => 'Ссылка',
);


$arTemplateParameters = array();
foreach ($set as $k => $val) {
	$arTemplateParameters[$k] = array(
		'NAME' => $val,
		'COLS' => 35,
		'ROWS' => 3
	);
}
