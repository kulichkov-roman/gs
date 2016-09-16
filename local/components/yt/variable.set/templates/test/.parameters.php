<?php

$set = array(
	'var1' => 'Раз переменная',
	'var2' => 'Два переменная',
	'var3' => 'И еще переменная',
);


$arTemplateParameters = array();
foreach ($set as $k => $val) {
	$arTemplateParameters[$k] = array(
		'NAME' => $val,
		'COLS' => 35,
		'ROWS' => 3
	);
}
