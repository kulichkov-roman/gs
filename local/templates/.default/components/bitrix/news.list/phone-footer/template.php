<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
$this->setFrameMode(true);
?>
<?foreach($arResult["ITEMS"] as $arItem){
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<dl class="footer-phones__row" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<dt class="footer-phones__title"><?=$arItem['NAME']?>:</dt>
		<?if($arItem['PROPERTIES']['PHONE']['VALUE']){?>
			<dd class="footer-phones__value">
				<a href="tel:<?=$arItem['PROPERTIES']['PHONE']['VALUE']?>" class="footer-phones__link">
					<?=$arItem['PROPERTIES']['PHONE']['VALUE']?>
				</a>
			</dd>
		<?}?>
	</dl>
<?}?>
