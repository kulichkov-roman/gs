<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
?>
<!DOCTYPE html>
<html>
	<head>
		<?$APPLICATION->ShowHead();?>
		<title><?$APPLICATION->ShowTitle();?></title>

		<?$environment = \YT\Environment\EnvironmentManager::getInstance();?>

		<link rel="shortcut icon" type="image/x-icon" href="<?=SITE_TEMPLATE_PATH?>/favicon.ico" />

		<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/fancybox/jquery.fancybox.css")?>
	    <?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/fancybox/helpers/jquery.fancybox-buttons.css")?>
	    <?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/fancybox/helpers/jquery.fancybox-thumbs.css")?>
	    <?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/idangerous.swiper.css")?>
	    <?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/style.css")?>
	    <?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/developer.css")?>

	    <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/jquery-1.11.1.min.js")?>
	    <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/jquery.validate.min.js")?>
	    <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/jquery.fancybox.pack.js")?>
	    <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/css/fancybox/helpers/jquery.fancybox-buttons.js")?>
	    <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/css/fancybox/helpers/jquery.fancybox-thumbs.js")?>
	    <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/css/fancybox/helpers/jquery.fancybox-buttons.js")?>
	    <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/idangerous.swiper.js")?>
	    <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/jquery.placeholder-2.1.0.min.js")?>
	    <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/script.js")?>
	    <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/jquery.form.min.js")?>
	    <?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/developer.js")?>
	    
		<meta name="ktoprodvinul" content="f23be9b2b6271327" />
		<meta name="cmsmagazine" content="38d2170328e981e4d60ee986faaa509f" />

		<?
		$APPLICATION->IncludeComponent(
			"bitrix:main.include", "",
			Array(
				"AREA_FILE_SHOW" => "file",
				"PATH" => SITE_DIR ."include_areas_yal/yandex_metrika.php"
			),
			false,
			array(
				"HIDE_ICONS" => "N"
			)
		);
		$APPLICATION->IncludeComponent(
			"bitrix:main.include", "",
			Array(
				"AREA_FILE_SHOW" => "file",
				"PATH" => SITE_DIR ."include_areas_yal/jivosite.php"
			),
			false,
			array(
				"HIDE_ICONS" => "N"
			)
		);
		?>
	</head>
	<body>
		<div id="panel">
			<?$APPLICATION->ShowPanel();?>
		</div>
		<div class="wrapper">
			<div class="page-header">
				<div class="header-top">
					<div class="layout-positioner">
						<div class="header-logo">
	                        <?$APPLICATION->IncludeComponent(
	                        "bitrix:main.include", "",
	                        Array(
	                        	"AREA_FILE_SHOW" => "file",
	                        	"PATH" => SITE_DIR ."include_areas_yal/header_logo.php"
	                        ),
	                        false,
	                        array(
	                            "HIDE_ICONS" => "N"
	                        ));?>
	                    </div>
	                    <?$APPLICATION->IncludeComponent("bitrix:menu", "top", Array(
	                    	"ROOT_MENU_TYPE" => "top",
	                        "MAX_LEVEL" => "1",
	                        "CHILD_MENU_TYPE" => "top",
	                        "USE_EXT" => "Y",
	                        "DELAY" => "N",
	                        "ALLOW_MULTI_SELECT" => "Y",
	                        "MENU_CACHE_TYPE" => "N",
	                        "MENU_CACHE_TIME" => "360000",
	                        "MENU_CACHE_USE_GROUPS" => "N",
	                        "MENU_CACHE_GET_VARS" => "",
	                    ),
	                    false,
	                    array("HIDE_ICONS" => "N")
	                    );?>
	                    <div class="header-contacts">
	                        <div class="header-contacts_phone">
		                        <?$APPLICATION->IncludeComponent(
	                                "bitrix:main.include", "",
	                                Array(
	                                	"AREA_FILE_SHOW" => "file",
	                                	"PATH" => SITE_DIR ."include_areas_yal/header_phone.php"
	                                ),
	                                false,
	                                array(
	                                    "HIDE_ICONS" => "N"
	                                )
		                        );?>
	                        </div>
	                    </div>
					</div>
				</div>
				<div class="header-main">
					<div class="layout-positioner">
						<div class="header-main-text">
						    <?$APPLICATION->IncludeComponent(
						    "bitrix:main.include", "",
						    Array(
						    	"AREA_FILE_SHOW" => "file",
						    	"PATH" => SITE_DIR ."include_areas_yal/header_main_text.php"
						    ),
						    false,
						    array(
						        "HIDE_ICONS" => "N"
						    ));?>
						</div>
						<div class="header-main-form">
						    <?$APPLICATION->IncludeComponent(
						    "bitrix:main.include", "",
						    Array(
						    	"AREA_FILE_SHOW" => "file",
						    	"PATH" => SITE_DIR ."include_areas_yal/header_form_1_title.php"
						    ),
						    false,
						    array(
						        "HIDE_ICONS" => "N"
						    ));?>
						    <?$APPLICATION->IncludeComponent(
						    "bitrix:main.include", "",
						    Array(
						    	"AREA_FILE_SHOW" => "file",
						    	"PATH" => SITE_DIR ."include_areas_yal/header_form_1.php"
						    ),
						    false,
						    array(
						        "HIDE_ICONS" => "N"
						    ));?>
						</div>
	                </div>
				</div>
			</div>
			<div class="content">
				<div class="section section-advantages" id="advantages">
					<div class="layout-positioner">
						<?$APPLICATION->IncludeComponent(
							"bitrix:main.include", "",
							Array(
								"AREA_FILE_SHOW" => "file",
								"PATH" => SITE_DIR ."include_areas_yal/header_advantages.php"
							),
							false,
							array(
						        "HIDE_ICONS" => "N"
							)
						);?>
						<div class="catalog-form frm2">
							<div class="form__header">
								<?$APPLICATION->IncludeComponent(
									"bitrix:main.include", "",
									Array(
										"AREA_FILE_SHOW" => "file",
										"PATH" => SITE_DIR ."include_areas_yal/header_form_2_1_title.php"
									),
									false,
									array(
										"HIDE_ICONS" => "N"
									)
								);?>
							</div>
							<?$APPLICATION->IncludeComponent(
								"bitrix:main.include", "",
								Array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR ."include_areas_yal/header_form_2.php"
								),
								false,
								array(
									"HIDE_ICONS" => "N"
								)
							);?>
						</div>
					</div>
				</div>
				<div class="section section-catalog" id="catalog">
					<div class="layout-positioner">
						<?$APPLICATION->IncludeComponent(
						"bitrix:main.include", "",
						Array(
							"AREA_FILE_SHOW" => "file",
							"PATH" => SITE_DIR ."include_areas_yal/header_pre_catalog.php"
						),
						false,
						array(
						    "HIDE_ICONS" => "N"
							)
						);?>
						<?$APPLICATION->IncludeComponent(
							"bitrix:news.list",
							"autopark",
							array(
								"AJAX_MODE" => "N",
								"IBLOCK_TYPE" => "-",
								"IBLOCK_ID" => "1",
								"NEWS_COUNT" => "20",
								"SORT_BY1" => "SORT",
								"SORT_ORDER1" => "ASC",
								"SORT_BY2" => "ID",
								"SORT_ORDER2" => "ASC",
								"FILTER_NAME" => "",
								"FIELD_CODE" => array(
									0 => "",
									1 => "",
								),
								"PROPERTY_CODE" => array(
									0 => "AMORT",
									1 => "CAPACITY",
									2 => "DVIGATEL",
									3 => "LENGTH",
									4 => "KATEGORIA",
									5 => "MESTA",
									6 => "KORPERED",
									7 => "MODEL",
									8 => "MASSA",
									9 => "MODIFIKACIA",
									10 => "POGRUZ",
									11 => "PODVESKA",
									12 => "PRIVOD",
									13 => "RULMEH",
									14 => "SCEPLENIE",
									15 => "TORMOZA",
									16 => "SHINI",
									17 => "WIDTH",
									18 => "",
								),
								"CHECK_DATES" => "N",
								"DETAIL_URL" => "",
								"PREVIEW_TRUNCATE_LEN" => "",
								"ACTIVE_DATE_FORMAT" => "d.m.Y",
								"SET_TITLE" => "N",
								"SET_STATUS_404" => "N",
								"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
								"ADD_SECTIONS_CHAIN" => "N",
								"HIDE_LINK_WHEN_NO_DETAIL" => "N",
								"PARENT_SECTION" => "",
								"PARENT_SECTION_CODE" => "",
								"CACHE_TYPE" => "A",
								"CACHE_TIME" => "36000000",
								"CACHE_NOTES" => "",
								"CACHE_FILTER" => "N",
								"CACHE_GROUPS" => "N",
								"DISPLAY_TOP_PAGER" => "N",
								"DISPLAY_BOTTOM_PAGER" => "N",
								"PAGER_TITLE" => "�������",
								"PAGER_SHOW_ALWAYS" => "N",
								"PAGER_TEMPLATE" => "",
								"PAGER_DESC_NUMBERING" => "N",
								"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
								"PAGER_SHOW_ALL" => "N",
								"AJAX_OPTION_JUMP" => "N",
								"AJAX_OPTION_STYLE" => "Y",
								"AJAX_OPTION_HISTORY" => "N",
								"AJAX_OPTION_ADDITIONAL" => "",
								"COMPONENT_TEMPLATE" => "autopark",
								"SET_BROWSER_TITLE" => "N",
								"SET_META_KEYWORDS" => "N",
								"SET_META_DESCRIPTION" => "N",
								"SET_LAST_MODIFIED" => "N",
								"INCLUDE_SUBSECTIONS" => "Y",
								"DISPLAY_DATE" => "Y",
								"DISPLAY_NAME" => "Y",
								"DISPLAY_PICTURE" => "Y",
								"DISPLAY_PREVIEW_TEXT" => "Y",
								"PAGER_BASE_LINK_ENABLE" => "N",
								"SHOW_404" => "N",
								"MESSAGE_404" => ""
							),
							false
						);?>
						<div class="catalog-form frm2">
							<div class="form__header">
								<?$APPLICATION->IncludeComponent(
								"bitrix:main.include", "",
								Array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR ."include_areas_yal/header_form_2_2_title.php"
								),
								false,
								array(
								    "HIDE_ICONS" => "N"
								));?>
							</div>
							<?$APPLICATION->IncludeComponent(
							"bitrix:main.include", "",
							Array(
								"AREA_FILE_SHOW" => "file",
								"PATH" => SITE_DIR ."include_areas_yal/header_form_2_1.php"
							),
							false,
							array(
							    "HIDE_ICONS" => "N"
							));?>
						</div>
					</div>
				</div>
				<div class="section section-personnel">
					<div class="layout-positioner">
						<?$APPLICATION->IncludeComponent(
							"bitrix:news.list",
							"offices",
							array(
								"AJAX_MODE" => "N",
								"IBLOCK_TYPE" => "-",
								"IBLOCK_ID" => "3",
								"NEWS_COUNT" => "20",
								"SORT_BY1" => "SORT",
								"SORT_ORDER1" => "ASC",
								"SORT_BY2" => "ID",
								"SORT_ORDER2" => "ASC",
								"FILTER_NAME" => "",
								"FIELD_CODE" => array(
									0 => "",
									1 => "",
								),
								"PROPERTY_CODE" => array(
									0 => "TEXT",
									1 => "LINK",
									2 => "",
								),
								"CHECK_DATES" => "N",
								"DETAIL_URL" => "",
								"PREVIEW_TRUNCATE_LEN" => "",
								"ACTIVE_DATE_FORMAT" => "d.m.Y",
								"SET_TITLE" => "N",
								"SET_STATUS_404" => "N",
								"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
								"ADD_SECTIONS_CHAIN" => "N",
								"HIDE_LINK_WHEN_NO_DETAIL" => "N",
								"PARENT_SECTION" => "",
								"PARENT_SECTION_CODE" => "",
								"CACHE_TYPE" => "A",
								"CACHE_TIME" => "36000000",
								"CACHE_NOTES" => "",
								"CACHE_FILTER" => "N",
								"CACHE_GROUPS" => "N",
								"DISPLAY_TOP_PAGER" => "N",
								"DISPLAY_BOTTOM_PAGER" => "N",
								"PAGER_TITLE" => "�������",
								"PAGER_SHOW_ALWAYS" => "N",
								"PAGER_TEMPLATE" => "",
								"PAGER_DESC_NUMBERING" => "N",
								"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
								"PAGER_SHOW_ALL" => "N",
								"AJAX_OPTION_JUMP" => "N",
								"AJAX_OPTION_STYLE" => "Y",
								"AJAX_OPTION_HISTORY" => "N",
								"AJAX_OPTION_ADDITIONAL" => "",
								"COMPONENT_TEMPLATE" => "slider",
								"SET_BROWSER_TITLE" => "N",
								"SET_META_KEYWORDS" => "N",
								"SET_META_DESCRIPTION" => "N",
								"SET_LAST_MODIFIED" => "N",
								"INCLUDE_SUBSECTIONS" => "Y",
								"DISPLAY_DATE" => "Y",
								"DISPLAY_NAME" => "Y",
								"DISPLAY_PICTURE" => "Y",
								"DISPLAY_PREVIEW_TEXT" => "Y",
								"PAGER_BASE_LINK_ENABLE" => "N",
								"SHOW_404" => "N",
								"MESSAGE_404" => ""
							),
							false
						);?>
						<div class="catalog-form frm2">
							<div class="form__header">
								<?$APPLICATION->IncludeComponent(
									"bitrix:main.include", "",
									Array(
										"AREA_FILE_SHOW" => "file",
										"PATH" => SITE_DIR ."include_areas_yal/header_form_2_3_title.php"
									),
									false,
									array(
										"HIDE_ICONS" => "N"
									)
								);?>
							</div>
							<?$APPLICATION->IncludeComponent(
								"bitrix:main.include", "",
								Array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR ."include_areas_yal/header_form_2_2.php"
								),
								false,
								array(
									"HIDE_ICONS" => "N"
								)
							);?>
						</div>
					</div>
				</div>
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include", "",
					Array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => SITE_DIR ."include_areas_yal/footer_map.php"
					),
					false,
					array(
						"HIDE_ICONS" => "N"
					)
				);?>
