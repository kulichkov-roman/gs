<div class="content__content">
    <div class="content__tab">
        <?
        $APPLICATION->IncludeComponent('bitrix:main.include', '',
            Array(
                'AREA_FILE_SHOW' => 'file',
                'PATH' => '/local/include/page_templates/pg_contacts_title.php',
                'EDIT_TEMPLATE' => ''
            ),
            false
        );
        ?>
    </div>
    <div class="contacts-content">
        <div class="contacts-content__col">
            <div class="contacts-content-block"><strong class="contacts-content-block__title">Телефоны:</strong>
                <?
                $APPLICATION->IncludeComponent(
                    'bitrix:main.include',
                    '',
                    Array(
                        'AREA_FILE_SHOW' => 'file',
                        'PATH' => '/local/include/page_templates/pg_contacts_phone.php',
                        'EDIT_TEMPLATE' => ''
                    ),
                    false
                );
                ?>
            </div>
            <div class="contacts-content-block">
                <strong class="contacts-content-block__title">E-mail:</strong>
                <?
                $APPLICATION->IncludeComponent(
                    'bitrix:main.include',
                    '',
                    Array(
                        'AREA_FILE_SHOW' => 'file',
                        'PATH' => '/local/include/page_templates/pg_contacts_email.php',
                        'EDIT_TEMPLATE' => ''
                    ),
                    false
                );
                ?>
            </div>
        </div>
        <div class="contacts-content__col">
            <div class="contacts-content-block"><strong class="contacts-content-block__title">Адрес:</strong>
                <ul class="contacts-content-block__list">
                    <li class="contacts-content-block__row">
                        <?
                        $APPLICATION->IncludeComponent(
                            'bitrix:main.include',
                            '',
                            Array(
                                'AREA_FILE_SHOW' => 'file',
                                'PATH' => '/local/include/page_templates/pg_contacts_address.php',
                                'EDIT_TEMPLATE' => ''
                            ),
                            false
                        );
                        ?>
                    </li>
                </ul>
            </div>
            <div class="contacts-content-block"><strong class="contacts-content-block__title">Реквизиты:</strong>
                <ul class="contacts-content-block__list">
                    <li class="contacts-content-block__row">
                        <?
                        $APPLICATION->IncludeComponent(
                            'bitrix:main.include',
                            '',
                            Array(
                                'AREA_FILE_SHOW' => 'file',
                                'PATH' => '/local/include/page_templates/pg_contacts_requisites.php',
                                'EDIT_TEMPLATE' => ''
                            ),
                            false
                        );
                        ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="contacts-map">
        <div class="contacts-map__inner"></div>
        <div class="contacts-map-magnifier"><i class="contacts-map-magnifier__frame"></i>
            <div class="contacts-map-magnifier__viewport">
                <div class="contacts-map-magnifier__map"></div>
            </div>
        </div>
    </div>
    <div class="contacts-form">
        <?
        $APPLICATION->IncludeComponent(
            'bitrix:main.include',
            '',
            Array(
                'AREA_FILE_SHOW' => 'file',
                'PATH' => '/local/include/page_templates/pg_contacts_feedback.php',
                'EDIT_TEMPLATE' => ''
            ),
            false,
            Array('HIDE_ICONS' => 'Y')
        );
        ?>
    </div>
</div>
