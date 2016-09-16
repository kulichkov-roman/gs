<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);	?>
<?if($arResult["ITEMS"]){?>
<div class="section section-reviews" id="reviews">
	<div class="layout-positioner">
		<h2 class="section__header"><?=GetMessage("TITLE")?></h2>
		<div class="reviews">
			<ul class="reviews__list">
				<?foreach($arResult["ITEMS"] as $arItem){
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>
				<li class="reviews__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<div class="reviews__content">
						<div class="reviews__text">
							<?=$arItem["DETAIL_TEXT"]?>
						</div>
						<?
						$siteAddress = $arItem["PROPERTIES"]["LINK"]["VALUE"];
						if($siteAddress && strpos($siteAddress, "http://") !== 0 &&
				            strpos($siteAddress, "https://") !== 0){
				            $siteAddress = "http://" . $siteAddress;
				        }
				        if($siteAddress){?>
						<div class="reviews-btn">
							<a href="<?=$siteAddress?>" class="btn reviews__btn"><?=GetMessage("LINK_TITLE")?></a>
						</div>
						<?}?>
					</div>
					<div class="reviews__title">
						<?=$arItem["NAME"]?><br />
						<?=$arItem["PROPERTIES"]["POST"]["VALUE"]?>
					</div>
				</li>
				<?}?>
			</ul>
		</div>
	</div>
</div>
<?}?>