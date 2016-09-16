<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $templateData */
/** @var @global CMain $APPLICATION */
use Bitrix\Main\Loader;
global $APPLICATION;?>
<?itc\CUncachedArea::startCapture();?>
<div class="reciepe__share"><script type="text/javascript" src="//yastatic.net/share/share.js" charset="utf-8"></script><div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="small" data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,moimir" data-yashareTheme="counter"></div></div>
<?$reciepeShare = itc\CUncachedArea::endCapture();
itc\CUncachedArea::setContent('reciepeShare', $reciepeShare);
?>