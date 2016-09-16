<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(false);

if($USER->isAdmin())
{
	//pre($arResult);
}
?>

<?if (!empty($arResult["ERRORS"])){
	ShowError(implode("<br />", $arResult["ERRORS"]));
}
if (strlen($arResult["MESSAGE"]) > 0){
	ShowNote($arResult["MESSAGE"]);
}?>

<div class="index-page__post _review">
	<div class="index-page__post-error-text _name">Поле 'Имя' должно быть заполнено!</div>
	<div class="index-page__post-error-text _email">Поле 'E-Mail' должно быть заполнено!</div>
	<div class="index-page__post-error-text _message">Поле 'Описание для анонса' должно быть заполнено!</div>
	<form class="index-page__post-form" name="iblock_add" action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
		<?=bitrix_sessid_post();?>
		<?if ($arParams["MAX_FILE_SIZE"] > 0){?>
			<input type="hidden" name="MAX_FILE_SIZE" value="<?=$arParams["MAX_FILE_SIZE"]?>" />
		<?}?>
		<div class="index-page__post-mini-wrap">
			<input type="text" name="PROPERTY[NAME][0]" placeholder="Ваше имя" class="index-page__post-name">
			<input type="text" name="PROPERTY[4][0]" placeholder="E-mail" class="index-page__post-mail">
		</div>
		<div class="index-page__post-triangle">
			<textarea class="index-page__post-text" name="PROPERTY[PREVIEW_TEXT][0]"></textarea>
		</div>
		<input type="submit" name="iblock_submit" value="ОСТАВИТЬ ОТЗЫВ" class="index-page__post-butt"/>
	</form>
</div>