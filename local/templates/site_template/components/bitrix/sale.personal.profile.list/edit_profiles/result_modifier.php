<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


$defaultProfileId = getDefaultUserProfileId();

$arProfileId = array();

$defaultProfileKey = false;
foreach($arResult["PROFILES"] as $key => $arProfile){
    $arProfileId[] = $arProfile["ID"];
    if($arProfile["ID"] == $defaultProfileId){
    	$defaultProfileKey = $key;
    }
}

if($defaultProfileKey){
	move_to_top($arResult["PROFILES"], $defaultProfileKey);
}

if(count($arProfileId) > 0){
    //pre($arParams['PROPS_GROUP']);
    $rsProps = CSaleOrderUserPropsValue::GetList(
        array(),
        array(
            'USER_PROPS_ID' => $arProfileId
            //'PROP_PROPS_GROUP_ID' => intVal($arParams['PROPS_GROUP'])
        )
    );
    
    $arResult["PROFILE_PROPS"] = array();    
    while($arProp = $rsProps->Fetch()){
            
        $arResult["PROFILE_PROPS"][$arProp['USER_PROPS_ID']][$arProp['PROP_CODE']] = $arProp;
    }
}

CModule::IncludeModule("sale");
$rsLocations = CSaleLocation::GetList();
$arLocations = array();
while($arLocation = $rsLocations -> GetNext()){
    $arLocations[$arLocation["ID"]] = $arLocation;
}
// pre($arLocations);

$arResult["LOCATIONS"] = $arLocations;
$arResult["DEFAULT_PROFILE_ID"] =$defaultProfileId;
?>