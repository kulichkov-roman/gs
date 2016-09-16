<?php
/**
 * Переносит работы в новый инфоблок
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

$environmentManager = \Your\Environment\EnvironmentManager::getInstance();
$rehauWorks = $environmentManager->get('rehauPortfolioIBlockId');
$userWorks = $environmentManager->get('examplePortfolioIBlockId');
$portfolioIblockId = $environmentManager->get('portfolioIblockId');
$imagesworkIblockId = $environmentManager->get('imagesworkIblockId');

$arUserPortfolio = array();
$arAlbumsIds = array();

$dbSectRehau = CIBlockSection::GetList(array(), array('IBLOCK_ID'=>$rehauWorks), false, array('IBLOCK_ID', 'ID', 'NAME', 'CREATED_BY', 'DESCRIPTION'));
while($arSectRehau = $dbSectRehau->Fetch()){
	$arUserPortfolio[$arSectRehau['ID']] = $arSectRehau;
}

$dbSectRehau = CIBlockSection::GetList(array(), array('IBLOCK_ID'=>$userWorks), false, array('IBLOCK_ID', 'ID', 'NAME', 'CREATED_BY', 'DESCRIPTION'));
while($arSectRehau = $dbSectRehau->Fetch()){
	$arUserPortfolio[$arSectRehau['ID']] = $arSectRehau;
}

$arPictures = array();

$dbPictures = CIblockElement::GetList(array(), array('IBLOCK_ID'=> $rehauWorks, '!SECTION_ID'=>false), false, false, array('ID', 'IBLOCK_ID', 'IBLOCK_SECTION_ID', 'PROPERTY_*'));
while($arPicture = $dbPictures->GetNext()){
	$arUserPortfolio[$arPicture['IBLOCK_SECTION_ID']]['IMAGES'][$arPicture['ID']] = array(
		'PICTURE' => CFile::MakeFileArray($arPicture['PROPERTY_77']),
		'PUBLIC_ELEMENT' => ($arPicture['PROPERTY_78']=='Y')?'Y':'',
		'APPROVE_ELEMENT' => ($arPicture['PROPERTY_79']=='Y')?'Y':''
	);
}

$dbPictures = CIblockElement::GetList(array(), array('IBLOCK_ID'=> $userWorks, '!SECTION_ID'=>false), false, false, array('ID', 'IBLOCK_ID', 'IBLOCK_SECTION_ID', 'PROPERTY_*'));
while($arPicture = $dbPictures->GetNext()){
	$arUserPortfolio[$arPicture['IBLOCK_SECTION_ID']]['IMAGES'][$arPicture['ID']] = array(
		'PICTURE' => CFile::MakeFileArray($arPicture['PROPERTY_70']),
		'PUBLIC_ELEMENT' => ($arPicture['PROPERTY_71']=='Y')?'Y':'',
		'APPROVE_ELEMENT' => ($arPicture['PROPERTY_72']=='Y')?'Y':'',
	);
	if($arPicture['PROPERTY_31']){
		$arUserPortfolio[$arPicture['IBLOCK_SECTION_ID']]['IMAGES'][$arPicture['ID']]['PERIOD'] = $arPicture['PROPERTY_31'];
	}
	if($arPicture['PROPERTY_30']){
		$arUserPortfolio[$arPicture['IBLOCK_SECTION_ID']]['IMAGES'][$arPicture['ID']]['YEAR'] = $arPicture['PROPERTY_30'];
	}
	if($arPicture['PROPERTY_29']){
		$arUserPortfolio[$arPicture['IBLOCK_SECTION_ID']]['IMAGES'][$arPicture['ID']]['MONTH'] = $arPicture['PROPERTY_29'];
	}
}

$el = new CIBlockElement;
foreach($arUserPortfolio as $arPortfolio){
	$arProps = array(
		'USER_ID' => $arPortfolio['CREATED_BY'],
	);
	if($arPortfolio['IBLOCK_ID']==24){
		$arProps['REHAU_WORKS']='Y';
	}
	if($arPortfolio['MONTH']){
		$arProps['MONTH']=$arPortfolio['MONTH'];
	}
	if($arPortfolio['YEAR']){
		$arProps['YEAR']=$arPortfolio['YEAR'];
	}
	if($arPortfolio['PERIOD']){
		$arProps['MONTH']=$arPortfolio['PERIOD'];
	}
	$arCreateElement = array(
		'NAME' => $arPortfolio['NAME'],
		'PREVIEW_TEXT' => $arPortfolio['DESCRIPTION'],
		'IBLOCK_ID'=>$portfolioIblockId,
		'ACTIVE'=>'Y',
		'IBLOCK_SECTION_ID' => false,
		'PROPERTY_VALUES' => $arProps,
	);
	$id = $el->Add($arCreateElement, false, true, true);
	if($id){
		foreach($arPortfolio['IMAGES'] as $arImages){
			$arImage = array();
			$arPropsImages = array(
				'PUBLIC_ELEMENT' => $arImages['PUBLIC_ELEMENT'],
				'APPROVE_ELEMENT' => $arImages['APPROVE_ELEMENT'],
				'WORK_ID' => $id
			);
			$arImage = array(
				'NAME' => $arPortfolio['NAME'],
				'IBLOCK_ID'=>$imagesworkIblockId,
				'ACTIVE'=>'Y',
				'IBLOCK_SECTION_ID' => false,
				'PROPERTY_VALUES' => $arPropsImages,
				'PREVIEW_PICTURE' => $arImages['PICTURE']
			);
			if($el->Add($arImage, false, true, true)){
				echo 'image with name '.$arImage['NAME'].' added'.PHP_EOL;
			}else{
				echo 'Erorr image:'.$el->LAST_ERROR.PHP_EOL;
			};
		}
		echo 'element with name '.$arCreateElement['NAME'].' added'.PHP_EOL;
	}else{
		echo 'Erorr:'.$el->LAST_ERROR.PHP_EOL;
	}
}

