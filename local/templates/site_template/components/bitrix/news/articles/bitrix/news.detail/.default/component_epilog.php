<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();?>

<?
$arNextElement = array();
$arPrevElement = array();
/**
 * Предыдущиц элемент
 */
$arSort = array(
	'ID' => 'DESC'
);
$arSelect = array(
	"ID",
	"NAME",
	"DETAIL_PAGE_URL"
);
$arNavStartParams = array(
	'nTopCount' => 1
);

$arFilter = array(
	"IBLOCK_ID" => ARTICLE_IBLOCK_ID,
	"<ID" => $arResult['ID']
);

$rsElements = CIBlockElement::GetList(
	$arSort,
	$arFilter,
	false,
	$arNavStartParams,
	$arSelect
);

if ($arItem = $rsElements->GetNext())
{
	$arPrevElement = $arItem;
}
/**
 * Следющий элемент
 */
$arSort = array(
	'ID' => 'ASC'
);
$arFilter = array(
	"IBLOCK_ID" => ARTICLE_IBLOCK_ID,
	">ID" => $arResult['ID']
);

$rsElements = CIBlockElement::GetList(
	$arSort,
	$arFilter,
	false,
	$arNavStartParams,
	$arSelect
);

if ($arItem = $rsElements->GetNext())
{
	$arNextElement = $arItem;
}
//pre($arNextElement);

itc\CUncachedArea::startCapture();
$showOtherArticles = itc\CUncachedArea::endCapture();
?>
<div class="article__other-articles">
	<h5 class="article__header-others">Другие статьи</h5>
	<ul class="article__other-articles-list">
		<?if(sizeof($arNextElement)){?>
			<li class="article__other-articles-item _prev"><a href="<?=$arNextElement['DETAIL_PAGE_URL']?>" class="article__other-articles-link"><?=$arNextElement['NAME']?></a></li>
		<?}?>
		<?if(sizeof($arPrevElement)){?>
			<li class="article__other-articles-item _next"><a href="<?=$arPrevElement['DETAIL_PAGE_URL']?>" class="article__other-articles-link"><?=$arPrevElement['NAME']?></a></li>
		<?}?>
	</ul>
</div>
<?
//pre($arPrevElement);

itc\CUncachedArea::setContent("showOtherArticles", $showOtherArticles);
?>