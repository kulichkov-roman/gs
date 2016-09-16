<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);	?>
<?if (!empty($arResult)):?>
<nav class="footer-menu">
    <ul class="header-menu__list">
    	<?foreach($arResult as $arItem){?>
        <li class="header-menu__item">
            <a href="<?=$arItem["LINK"]?>" class="header-menu__link"><?=$arItem["TEXT"]?></a>
        </li>
        <?}?>
    </ul>
</nav>
<?endif?>
