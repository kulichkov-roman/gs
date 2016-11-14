<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>

<div class="catalog">
	<ul class="catalog__list">
		<?foreach($arResult["ITEMS"] as $arItem){
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>
			<li class="catalog__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<div class="catalog__content">
					<div class="catalog__title">
						<?=$arItem["NAME"]?>
						<?if($arItem["PROPERTIES"]["PRICE"]["VALUE"]){?>
							<span class="catalog__price">
								<?=$arItem["PROPERTIES"]["PRICE"]["VALUE"]?>
							</span>
						<?}?>
					</div>
					<div class="catalog__img-wrap">
						<img src="<?=$arItem["DISPLAY_PREVIEW_PICTURE"]["src"]?>" alt="" class="catalog__img">
					</div>
					<div class="catalog__description">
						<?if($arItem["PROPERTIES"]["FILE"]["VALUE"]){?>
							<a target="_blank" href="<?=CFile::GetPath($arItem["PROPERTIES"]["FILE"]["VALUE"]);?>">Технические характеристики в pdf</a><br><br>
						<?}?>
						<a class="form__submit btn2 js__pop-up" href="#catalog__full-item<?=$arItem['ID'] ?>">Заказать</a>
					</div>
				</div>
				<div class="hidden">
					<div class="catalog__full-item" id="catalog__full-item<?=$arItem['ID'] ?>">
						    <div class="form-catalog-item">
								<div class="form-catalog-item__header">Заявка на покупку</div>
								<div class="form-catalog-item__description">Отправьте заявку и мы перезвоним вам для уточнения условий покупки</div>
								<form action="/local/templates/yal_landing_page_s1/ajax/form.php" method="post" class="form-request js__form-request ajax_form">
									<?=bitrix_sessid_post()?>
									<input name="type" value="Заявка на покупку <?=$arItem["NAME"]?>" type="hidden">
									<input name="formId" type="hidden" value="autopark_1"/>
									<ul class="form__list">
										<li class="form__item">
											<input name="name" class="form__input_text" placeholder="Имя" type="text">
										</li>
										<li class="form__item">
											<input name="phone" class="form__input_text" placeholder="Телефон" type="tel">
										</li>
										<li class="form__item form__item_button">
											<input class="form__submit btn" value="Отправить" type="submit">
										</li>
									</ul>
								</form>
							</div>
							<div class="catalog__full-title"><?=$arItem["NAME"]?></div>
							<div class="catalog__full-img-wrap">
								<img src="<?=$arItem["DISPLAY_PREVIEW_PICTURE"]["src"]?>" alt="" class="catalog__full-img">
							</div>
							<div class="catalog__full-hr"></div>
							<div class="catalog__properties">
								<ul class="catalog__properties__list">
									<?
									/*
									 * array_column с php 5.5
									 * */
									array_multisort(
										array_column($arItem["DISPLAY_PROPERTIES"], "SORT"), SORT_ASC,
										array_column($arItem["DISPLAY_PROPERTIES"], "NAME"), SORT_ASC, $arItem["DISPLAY_PROPERTIES"]
									);
									?>
									<?foreach($arItem["DISPLAY_PROPERTIES"] as $arProperty){?>
										<li class="catalog__properties__item"><b><?=$arProperty["NAME"]?></b> <i><?=$arProperty["VALUE"]?></i></li>
									<?}?>
								</ul>
							</div>
					</div>
				</div>
			</li>
		<?}?>
	</ul>
</div>
