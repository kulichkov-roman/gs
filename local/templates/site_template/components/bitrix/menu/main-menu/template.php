<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)){?>
	<nav class="menu">
		<ul class="menu__list">
			<?foreach($arResult as $arItem){?>
				<?if ($arItem["PERMISSION"] > "D"){?>
					<li class="menu__item <?=$arItem['SELECTED'] ? '_active' : ''?>">
						<a href="<?=$arItem["LINK"]?>" class="menu__link">
							<span class="menu__text">
								<?=$arItem["TEXT"]?>
							</span>
						</a>
					</li>
				<?}?>
			<?}?>
		</ul>
	</nav>
<?}?>