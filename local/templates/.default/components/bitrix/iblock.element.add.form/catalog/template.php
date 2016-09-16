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
	echo "<pre>"; var_dump($arResult["ERRORS"]); echo "</pre>";
}

$errorClass = '';
$successClass = '';
$formClass = '';

/**
 * @todo можно убрать
 * */
$this->SetViewTarget('showGoodsBuyButt');?>
	<?/*if(!empty($arResult["ERRORS"]) || $_GET['strIMessage'] <> ''){?>
		<script>
			$(function() {
				$('.goods__buy-butt').trigger('click');
			})
		</script>
	<?}*/?>
<?$this->EndViewTarget();?>
<div style="display: none" class="buy-asap-popup">
	<?if (!empty($arResult["ERRORS"])){
		ShowError(implode("<br />", $arResult["ERRORS"]));
		$errorClass = ' _show-error';
		$formClass    = ' _show-form';
	}
	if (strlen($arResult["MESSAGE"]) > 0){
		ShowNote($arResult["MESSAGE"]);
		$successClass = ' _show-success';
	}
	//if(!isset($_GET['strIMessage']))
	//{
		if($successClass == ' _show-success' && $errorClass == ' _show-error')
		{
			$successClass = '';
		}
		?>
		<div class="buy-asap <?=$formClass?><?=$errorClass?><?=$successClass?>">
			<form name="iblock_add" action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
				<?=bitrix_sessid_post()?>
				<?if ($arParams["MAX_FILE_SIZE"] > 0):?><input type="hidden" name="MAX_FILE_SIZE" value="<?=$arParams["MAX_FILE_SIZE"]?>" /><?endif?>
				<div class="buy-asap__field-wrap"><span class="buy-asap__field-name">Представьтесь, пожалуйста</span>
					<input type="text" class="buy-asap__field" name="PROPERTY[NAME][0]">
				</div>
				<div class="buy-asap__field-wrap"><span class="buy-asap__field-name">Ваш телефон</span>
					<input type="text" class="buy-asap__field" name="PROPERTY[192][0]">
				</div>
				<?
				/**
				 * Привязка товара. Задаётся в elements.php
				 */
				?>
				<input type="hidden" name="PROPERTY[193][0]" value="<?=$arParams['PRODUCT_ID']?>"/>
				<?if($arParams["USE_CAPTCHA"] == "Y" && $arParams["ID"] <= 0){?>
					<div class="buy-asap__captcha">
						<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" class="buy-asap__captcha-img" alt="CAPTCHA">
						<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>"/>
					</div>
					<div class="buy-asap__field-wrap"><span class="buy-asap__field-name">Введите код с картинки</span>
						<input type="text" name="captcha_word" maxlength="50" class="buy-asap__field">
					</div>
				<?}?>
				<div class="buy-asap__butt-pane">
					<input type="submit" name="iblock_submit" class="buy-asap__butt" value="Заказать">
				</div>
			</form>
		</div>
		<?
	//}
	?>
</div>