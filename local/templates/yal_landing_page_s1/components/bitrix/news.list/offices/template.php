<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);	?>
<?if($arResult["ITEMS"]){?>
<div class="section section-personnel">
	<div class="layout-positioner">
		<h2 class="section__header"><?=GetMessage("TITLE")?></h2>
		<div class="personnel">
			<div class="personnel-principle"><?=GetMessage("SUBTITLE")?></div>
			<ul class="personnel__list">
				<?foreach($arResult["ITEMS"] as $arItem){
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>
				<li class="personnel__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<div class="personnel__img-wrap">
						<img src="<?=$arItem["DISPLAY_PREVIEW_PICTURE"]["src"]?>" class="personnel__img" alt="<?=$arItem["NAME"]?>" />
					</div>
					<div class="personnel__name"><?=$arItem["NAME"]?></div>
					<div class="personnel__title">
						<?=$arItem["PROPERTIES"]["ADDRESS"]["VALUE"]?>
					</div>
					<div class="personnel__phone"><?=$arItem["PROPERTIES"]["PHONE"]["VALUE"]?></div>
				</li>
				<?}?>
			</ul>
			<div class="personnel__text">
				<?$APPLICATION->IncludeComponent(
				"bitrix:main.include", "",
				Array(
					"AREA_FILE_SHOW" => "file",
					"PATH" => SITE_TEMPLATE_PATH ."/include_areas/offices_text.php"
				),
				false,
				array(
				    "HIDE_ICONS" => "N"
				));?>
			</div>
		</div>
	</div>
</div>
<?}?>