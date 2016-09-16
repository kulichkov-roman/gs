<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();?>
<?
$environment = \YT\Environment\EnvironmentManager::getInstance();

$id = '';
if(is_array($arResult['DETAIL_PICTURE']))
{
    $id = $arResult['DETAIL_PICTURE']['ID'];
}
else
{
    $arResult['DETAIL_PICTURE']['SRC'] = itc\Resizer::get($environment->get('roomsPlugId'), 'w1280');
}

if($id <> '')
{
    $fl = new CFile;

    $arOrder = array();
    $arFilter = array(
        'MODULE_ID' => 'iblock',
        '@ID' => $id
    );

    $arDetailPicture = array();

    $rsFile = $fl->GetList($arOrder, $arFilter);

    if($arItem = $rsFile->GetNext())
    {
        $arDetailPicture[$arItem['ID']] = $arItem;
        $urlDetailPicture = itc\Resizer::get($arItem['ID'], 'w1280');

        $arResult['DETAIL_PICTURE']['SRC'] = $urlDetailPicture;
    }
}
?>
<?$this->SetViewTarget('roomsDetail');?>
    <div class="page-header" style="min-height: 400px;">
        <div style="background-image: url(<?=$arResult['DETAIL_PICTURE']['SRC']?>)">
            <h1><?=$arResult['NAME']?></h1>
            <a class="page-back-button" href="<?=$environment->get('roomsDir')?>"></a>
        </div>
    </div>
<?$this->EndViewTarget();?>
