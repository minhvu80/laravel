<?
    // update fresh Inventory Attributes, the one that missing Attributes
    require_once("../../common/library/database/mssql/mssql.inc.php");    
	require_once("../../common/library/channeladvisor/class.CAAPI.php");
    $db = new MsSQL();    
    $ChannelAdvisorAPI = new ChannelAdvisorAPI();
    $ChannelAdvisorAPI->debug=1;
    $arrData = $db->getArray("select SKU from SHOEMETRO_InventoryAttributes where Image1 is null and SKU like 'ds-%'");
    foreach($arrData as $d){
        $ChannelAdvisorAPI->updateImage($d["SKU"]);
    }
    $db->__destruct();
    
    
?>

