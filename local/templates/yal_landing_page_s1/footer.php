<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
?>
        </div>
    </div>
    <div class="page-footer">
        <div class="layout-positioner">
            <?$APPLICATION->IncludeComponent("bitrix:menu", "bottom", Array(
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
            <div class="footer-copyright">
                <?$APPLICATION->IncludeComponent(
                "bitrix:main.include", "",
                Array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_DIR ."include_areas_yal/footer_copyright.php"
                ),
                false,
                array(
                    "HIDE_ICONS" => "N"
                ));?>
            </div>
            <div class="footer-developer">
                <?$APPLICATION->IncludeComponent(
                       "bitrix:main.include", "",
                       Array(
                           "AREA_FILE_SHOW" => "file",
                           "PATH" => SITE_DIR ."/include_areas_yal/footer_developer_copyright.php"
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
                    "PATH" => SITE_DIR ."include_areas_yal/footer_social.php"
                ),
                false,
                array(
                    "HIDE_ICONS" => "N"
                ));?>
        </div>
    </div>
    <div class="hidden">
        <?$APPLICATION->IncludeComponent(
        "bitrix:main.include", "",
        Array(
            "AREA_FILE_SHOW" => "file",
            "PATH" => SITE_DIR ."/include_areas_yal/footer_form_success_popup.php"
        ),
        false,
        array(
            "HIDE_ICONS" => "Y"
        ));?>
    </div>
</body>
</html>
