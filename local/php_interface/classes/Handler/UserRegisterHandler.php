<?php

/**
 * Class SendingEmailHandler
 */
class UserRegisterHandler
{
    public static function UserRegister(&$arFields)
    {
        if($arFields['WORK_COMPANY'])
        {
            $arFields['ACTIVE'] = 'N';
        }
    }
}
?>