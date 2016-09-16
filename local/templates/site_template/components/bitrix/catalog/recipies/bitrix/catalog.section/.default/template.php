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
<?if(!$arResult["ITEMS"]){?>
<?} else {?>
	<div class="reciepelist">
		<ul class="reciepelist__list">
			<?foreach($arResult["ITEMS"] as $arItem){
				// $arItem["DETAIL_PAGE_URL"] = $arParams["SEF_FOLDER"] . $arResult["SECTION_INFO"][$arItem["IBLOCK_SECTION_ID"]]["ID"] . "/" . $arItem["ID"] . "/";

				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>
			    <li id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="reciepelist__item">
			    	<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="reciepelist__link">
			    		<?
			    		$pictId = $arItem["PREVIEW_PICTURE"]["ID"];
			    		if(!$pictId){
			    			$pictId = NO_PH_REP_PV;
			    		}?>
			    		<img src="<?=itc\Resizer::get($pictId, getPresetName('recipeList', $pictId))?>" class="reciepelist__item-pic">
			            <div class="reciepelist__reciepe-info">
			                <p class="reciepelist__reciepe-name"><?=$arItem["NAME"]?></p><span class="reciepelist__reciepe-type"><?=$arResult["SECTION_INFO"][$arItem["IBLOCK_SECTION_ID"]]["NAME"]?></span>
			            </div>
			        </a>
			    </li>
		    <?}?>
		</ul>
		<?=$arResult["NAV_STRING"]?>
	</div>
<?}?>