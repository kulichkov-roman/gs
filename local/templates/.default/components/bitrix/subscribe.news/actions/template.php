<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if($arResult["IBLOCKS"]){?>
<html> 
    <head>
        <meta charset="utf-8"/>
    </head>
    <body>
        <table width="600" bgcolor="#262626" border="0" cellspacing="0" cellpadding="0" align="center" style="text-align: left;">
            <tr>
                <td height="4" background="<?="http://".$arResult["SERVER_NAME"]."/images/sub/line.png"?>" style="line-height: 4px; font-size: 0px;">&nbsp;</td>
            </tr>
            <tr>
                <td height="148" style="padding-left: 85px; padding-top: 12px;" valign="top">
                    <table width="515" bgcolor="#262626" border="0" cellspacing="0" cellpadding="0" align="center">
                        <tr>
                            <td width="145" valign="top"><img width="116" height="117" src="<?="http://".$arResult["SERVER_NAME"]."/images/sub/logo.png"?>" style="vertical-align: top;"/></td>
                            <td width="370" valign="top">
                                <div style="padding-left: 174px; padding-top: 6px; color: #c5ce28; line-height: 14px; font-size: 14px; font-weight: bold; font-family: Arial, sans-serif;">9:00-21:00</div>
                                <div style="color: #ffffff; line-height: 40px; font-weight: bold; font-size: 36px; font-family: Arial, sans-serif;">ДОСТАВКА</div>
                                <div style="color: #ffffff; line-height: 18px; font-weight: bold; font-size: 16px; font-family: Arial, sans-serif;">РЫБЫ И МОРЕПРОДУКТОВ НА ДОМ</div>
                                <div style="height: 24px;"><a href="<?="http://".$arResult["SERVER_NAME"]?>" style="color: #f36f21; text-decoration: none; border-bottom: 1px solid #f36f21; line-height: 24px; font-weight: bold; font-size: 16px; font-family: Arial, sans-serif;">WWW.FISH-EXPRESS.RU</a></div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td height="23" style="padding-left: 100px; padding-right: 100px;" valign="top">
                    <div style="color: #ffffff; line-height: 22px; font-size: 20px; font-weight: bold; font-family: Arial, sans-serif;">АКЦИИ</div>
                </td>
            </tr>
            <?
            foreach($arResult["IBLOCKS"] as $arIBlock){?>
	            <?
	            foreach($arIBlock["ITEMS"] as $arItem){?>
	            <tr>
	                <td style="padding-left: 100px; padding-right: 100px;" valign="top">
	                    <table width="400" bgcolor="#262626" border="0" cellspacing="0" cellpadding="0" align="center">
	                        <tr>
	                        	<?
	                        	$pictId = $arItem["PREVIEW_PICTURE"]["ID"];
	                        	if(!$pictId){
	                        		$pictId = $arItem["DETAIL_PICTURE"]["ID"];
	                        	}
					        	if(!$pictId){
					        		$pictId = NO_PHOTO_ID;
					        	}

	                        	?>
	                            <td width="170" valign="top" style="padding-top: 15px; padding-bottom: 15px;"><a href="<?=$arItem["DETAIL_PAGE_URL"]?>" style="text-decoration: none;"><img width="150" height="150" src="<?="http://".$arResult["SERVER_NAME"]. \itc\Resizer::get($pictId, getPresetName("subscribePict", $pictId))?>" style="border: 4px solid #e2630a; vertical-align: top;" alt=""/></a></td>
	                            <td width="230" valign="top" style="padding-top: 15px; padding-bottom: 15px;">
	                                <div style="color: #787878; line-height: 12px; font-size: 12px; font-family: Arial, sans-serif;"><?=CIBlockFormatProperties::DateFormat("j F Y", MakeTimeStamp($arItem["ACTIVE_FROM"], CSite::GetDateFormat()))?></div>
	                                <div style="padding-top: 5px;"><a href="<?=$arItem["DETAIL_PAGE_URL"]?>" style="color: #f36f21; text-decoration: none; border-bottom: 1px solid #f36f21; line-height: 20px; font-weight: bold; font-size: 16px; font-family: Arial, sans-serif;"><?=$arItem["NAME"]?></a></div>
	                                <div style="padding-top: 10px; color: #dddddd; line-height: 14px; font-size: 12px; font-family: Arial, sans-serif;">
	                                   <?$previewText = strip_tags($arItem["DETAIL_TEXT"]);
                                       $previewText = htmlspecialcharsBack(TruncateText($previewText, 150));
                                       /*$maxLen = 100;
                                       if(mb_strlen($previewText) > $maxLen){
                                        $previewText = mb_substr($previewText, 0, $maxLen);
                                        $lastCharacter = mb_substr($previewText, -1);
                                        if(in_array($lastCharacter, array(".", ",", ":", "-", ";", "?", "!"))){
                                            $previewText = mb_substr($previewText, 0, $maxLen - 1);
                                        }
                                        $previewText .= "...";
                                       }*/?>
                                        <?=$previewText?>
	                                </div>
	                            </td>
	                        </tr>
	                    </table>
	                    <div style="height: 1px; background: #3b3b3b; line-height: 1px; font-size: 0px;">&nbsp;</div>
	                </td>
	            </tr>
	            <?}?>
            <?}?>
            <tr>
                <td valign="top">
                    <table width="180" bgcolor="#262626" border="0" cellspacing="0" cellpadding="0" align="center">
                        <tr>
                            <td valign="top" style="padding-top: 11px; text-align: center; color: #ffffff; line-height: 42px; font-size: 24px; font-family: Arial, sans-serif;">Мы в соцсетях</td>
                        </tr>
                        <tr>
                            <td valign="top" style="text-align: center; padding-bottom: 25px;"><a href="<?echo COption::GetOptionString( "askaron.settings", "UF_VK_LINK" );?>" style="text-decoration: none;"><img width="40" height="40" border="0" src="<?="http://".$arResult["SERVER_NAME"]."/images/sub/vk.png"?>" style="vertical-align: top;" alt=""/></a><span style="font-size: 12px; font-family: Arial, sans-serif; color: #262626">&nbsp;&nbsp;&nbsp;</span><a href="<?echo COption::GetOptionString( "askaron.settings", "UF_OK_LINK" );?>" style="text-decoration: none;"><img width="40" height="40" border="0" src="<?="http://".$arResult["SERVER_NAME"]."/images/sub/ok.png"?>" style="vertical-align: top;" alt=""/></a><span style="font-size: 12px; font-family: Arial, sans-serif; color: #262626">&nbsp;&nbsp;&nbsp;</span><a href="<?echo COption::GetOptionString( "askaron.settings", "UF_INSTAGRAM_LINK" );?>" style="text-decoration: none;"><img width="40" height="40" border="0" src="<?="http://".$arResult["SERVER_NAME"]."/images/sub/instagram.png"?>" style="vertical-align: top;" alt=""/></a></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td height="2" background="<?="http://".$arResult["SERVER_NAME"]."/images/sub/line.png"?>" style="line-height: 2px; font-size: 0px;">&nbsp;</td>
            </tr>
            <tr>
                <td height="106" valign="top" style="padding-left: 100px; padding-right: 140px; padding-top: 14px;">
                    <div style="color: #787878; line-height: 18px; font-size: 12px; font-family: Arial, sans-serif;">Вы получили это письмо потому что подписались на рассылку на сайте&#32;<a href="<?="http://".$arResult["SERVER_NAME"]?>" style="color: #f36f21; text-decoration: none; border-bottom: 1px solid #f36f21; line-height: 18px; font-size: 12px; font-family: Arial, sans-serif;">www.fish-express.ru</a>.</div>
                    <div style="padding-top: 18px; color: #787878; line-height: 18px; font-size: 12px; font-family: Arial, sans-serif;">Чтобы отписаться от рассылки — перейдите по этой&#32;<a href="#UNSUBSCRIBE_LINK#" style="color: #f36f21; text-decoration: none; border-bottom: 1px solid #f36f21; line-height: 18px; font-size: 12px; font-family: Arial, sans-serif;">ссылке</a>.</div>
                </td>
            </tr>
        </table>
    </body>
</html>
<?}?>