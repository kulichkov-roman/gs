<?php
/**
 * Общая конфигурация для всех сайтов и окружений
 */
\YT\Environment\EnvironmentManager::getInstance()->addConfig(
	new \YT\Environment\Configuration\CommonConfiguration(
		array(
			'catalogIBlockId' => 3,
			'defaultSiteTemplateUrl' => '/local/templates/.default/',
		)
	)
);

if(\Bitrix\Main\Loader::includeModule('itconstruct.resizer'))
{
    itc\Resizer::addPreset('interiorDetail', array(
            'mode' => 'width',
            'width' => '1200',
            'height' => null,
            'type' => 'jpg'
        )
    );
    itc\Resizer::addPreset('interiorPreview', array(
            'mode' => 'crop',
            'width' => '200',
            'height' => '168',
            'type' => 'jpg'
        )
    );
	itc\Resizer::addPreset('exteriorDetail', array(
			'mode' => 'width',
			'width' => '1024',
			'height' => null,
			'type' => 'jpg'
		)
	);
	itc\Resizer::addPreset('exteriorPreview', array(
			'mode' => 'crop',
			'width' => '207',
			'height' => '151',
			'type' => 'jpg'
		)
	);
	itc\Resizer::addPreset('search', array(
			'mode' => 'auto',
			'width' => 100,
			'height' => 100,
			'type' => 'png'
		)
	);
	itc\Resizer::addPreset('sliderOnMain', array(
			'mode' => 'crop',
			'width' => 780,
			'height' => 350,
			'type' => 'png'
		)
	);
	itc\Resizer::addPreset('sliderOnMainMobile', array(
			'mode' => 'crop',
			'width' => 280,
			'height' => 188,
			'type' => 'png'
		)
	);
	itc\Resizer::addPreset('newsList', array(
			'mode' => 'crop',
			'width' => 201,
			'height' => 161,
			'type' => 'jpg'
		)
	);
	itc\Resizer::addPreset('newsDetail', array(
			'mode' => 'width',
			'width' => 300,
			'height' => null,
			'type' => 'jpg'
		)
	);
	itc\Resizer::addPreset('aboutCompanyListPreview', array(
			'mode' => 'width',
			'width' => 232,
			'height' => null,
			'type' => 'jpg'
		)
	);
	itc\Resizer::addPreset('aboutCompanyListDetail', array(
			'mode' => 'width',
			'width' => 1024,
			'height' => null,
			'type' => 'jpg'
		)
	);
	itc\Resizer::addPreset('aboutCompanyLogoType', array(
			'mode' => 'crop',
			'width' => 120,
			'height' => 120,
			'type' => 'png'
		)
	);
// "рецепты": список
	itc\Resizer::addPreset('recipeList', array(
			'mode' => 'crop',
			'width' => 186,
			'height' => 263,
			'type' => 'jpg'
		)
	);
	itc\Resizer::addPreset('recipeListPng', array(
			'mode' => 'crop',
			'width' => 186,
			'height' => 263,
			'type' => 'png'
		)
	);
// "рецепты": деталка
	itc\Resizer::addPreset('reciepeDetail', array(
			'mode' => 'crop',
			'width' => 279,
			'height' => 419,
			'type' => 'jpg'
		)
	);
	itc\Resizer::addPreset('reciepeDetailPng', array(
			'mode' => 'crop',
			'width' => 279,
			'height' => 419,
			'type' => 'png'
		)
	);
	itc\Resizer::addPreset('reciepeDetailPopup', array(
			'mode' => 'auto',
			'width' => 800,
			'height' => 600,
			'type' => 'jpg'
		)
	);
	itc\Resizer::addPreset('reciepeDetailPopupPng', array(
			'mode' => 'auto',
			'width' => 800,
			'height' => 600,
			'type' => 'png'
		)
	);
// "акции": список
	itc\Resizer::addPreset('promoList', array(
			'mode' => 'crop',
			'width' => 250,
			'height' => 250,
			'type' => 'jpg'
		)
	);
	itc\Resizer::addPreset('promoListPng', array(
			'mode' => 'crop',
			'width' => 250,
			'height' => 250,
			'type' => 'png'
		)
	);
// "элементов каталога на главной": список
	itc\Resizer::addPreset('catalogMainList', array(
			'mode' => 'crop',
			'width' => 250,
			'height' => 171,
			'type' => 'jpg'
		)
	);
	itc\Resizer::addPreset('catalogList', array(
			'mode' => 'crop',
			'width' => 250,
			'height' => 250,
			'type' => 'jpg'
		)
	);
	itc\Resizer::addPreset('catalogListMobile', array(
			'mode' => 'crop',
			'width' => 530,
			'height' => 530,
			'type' => 'jpg'
		)
	);
// "корзина": список
	itc\Resizer::addPreset('basketList', array(
			'mode' => 'crop',
			'width' => 101,
			'height' => 101,
			'type' => 'jpg'
		)
	);
// "корзина": список
	itc\Resizer::addPreset('basketListM', array(
			'mode' => 'crop',
			'width' => 200,
			'height' => 200,
			'type' => 'jpg'
		)
	);
// "рекомендованные": список
	itc\Resizer::addPreset('recommendedList', array(
			'mode' => 'crop',
			'width' => 250,
			'height' => 250,
			'type' => 'jpg'
		)
	);

// "вкусный рецепт": элемент
	itc\Resizer::addPreset('recipesElem', array(
			'mode' => 'crop',
			'width' => 168,
			'height' => 263,
			'type' => 'jpg'
		)
	);

//карточка товара: маленькая картинка
	itc\Resizer::addPreset('elementSmall', array(
			'mode' => 'crop',
			'width' => 240,
			'height' => 200,
			'type' => 'jpg'
		)
	);
	itc\Resizer::addPreset('elementSmallPng', array(
			'mode' => 'crop',
			'width' => 240,
			'height' => 200,
			'type' => 'png'
		)
	);
//карточка товара: средняя картинка
	itc\Resizer::addPreset('elementMiddle', array(
			'mode' => 'crop',
			'width' => 495,
			'height' => 410,
			'type' => 'jpg'
		)
	);
	itc\Resizer::addPreset('elementMiddlePng', array(
			'mode' => 'crop',
			'width' => 495,
			'height' => 410,
			'type' => 'png'
		)
	);
//карточка товара: большая картинка
	itc\Resizer::addPreset('elementBig', array(
			'mode' => 'auto',
			'width' => 800,
			'height' => 600,
			'type' => 'jpg'
		)
	);
	itc\Resizer::addPreset('elementBigPng', array(
			'mode' => 'auto',
			'width' => 800,
			'height' => 600,
			'type' => 'png'
		)
	);
	itc\Resizer::addPreset('subscribePictPng', array(
			'mode' => 'crop',
			'width' => 150,
			'height' => 150,
			'type' => 'png'
		)
	);
	itc\Resizer::addPreset('subscribePict', array(
			'mode' => 'crop',
			'width' => 150,
			'height' => 150,
			'type' => 'jpg'
		)
	);
}

