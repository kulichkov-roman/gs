<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="site-map">
    <div class="site-map__col">
        <ul class="site-map__list _starter">
            <li class="site-map__list-item _parent"><a href="/" class="site-map__list-link">Главная</a>
                <div class="site-map__cols">
                    <ul class="site-map__list _col">
                    	<?
                    	//первая колонка под каталог
                    	$arFirstItem = $arResult["arMapStruct"][0];?>
                        <li class="site-map__list-item _parent"><a href="<?=$arFirstItem["FULL_PATH"]?>" class="site-map__list-link"><?=$arFirstItem["NAME"]?></a>
                            <?if($arFirstItem["CHILDREN"]){?>
                            <ul class="site-map__list">
                            	<?foreach($arFirstItem["CHILDREN"] as $arChild){?>
                                	<li class="site-map__list-item"><a href="<?=$arChild["FULL_PATH"]?>" class="site-map__list-link"><?=$arChild["NAME"]?></a></li>
                            	<?}?>
                            </ul>
                            <?}?>
                        </li>
                    </ul>
                    <?array_shift($arResult["arMapStruct"]);
                    if($arResult["arMapStruct"]){?>
                    <ul class="site-map__list _col">
                    	<?foreach($arResult["arMapStruct"] as $arMapItem){?>
	                        <li class="site-map__list-item _parent"><a href="<?=$arMapItem["FULL_PATH"]?>" class="site-map__list-link"><?=$arMapItem["NAME"]?></a>
	                            <?if($arMapItem["CHILDREN"]){?>
		                            <ul class="site-map__list">
		                            	<?foreach($arMapItem["CHILDREN"] as $arChild){?>
		                                	<li class="site-map__list-item"><a href="<?=$arChild["FULL_PATH"]?>" class="site-map__list-link"><?=$arChild["NAME"]?></a></li>
		                            	<?}?>
		                            </ul>
	                            <?}?>
	                        </li>
                        <?}?>
                    </ul>
                    <?}?>
                </div>
            </li>
        </ul>
    </div>
</div>