<?
    // update fresh Inventory Attributes, the one that missing Attributes
	ini_set("display_errors","on");
	
    require_once("../../common/library/database/mssql/mssql.inc.php");
    require_once("../../common/library/channeladvisor/class.CAAPI.php");
    $db = new MsSQL();
       
    $arrSKUs = $db->getArray("select SKU as LocalSKU from SHOEMETRO_InventoryAttributes where (ShoeType1 is null or ShoeType1='')");    
    
    $ChannelAdvisorAPI = new ChannelAdvisorAPI();
    //$ChannelAdvisorAPI->debug=1;
    foreach($arrSKUs as $s){
        $sku = $s["LocalSKU"];
        $ChannelAdvisorAPI->updateInventoryAttribute($sku,true);
    } 
    $db->__destruct();
?>

