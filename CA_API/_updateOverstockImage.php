<?
    // update fresh Inventory Attributes, the one that missing Attributes
	ini_set("display_errors","on");
	
    require_once("../../common/library/database/mssql/mssql.inc.php");
    require_once("../../common/library/channeladvisor/class.CAAPI.php");
    $db = new MsSQL();
       
    $arrSKUs = $db->getArray("SELECT SKU,image1,image2,image3 FROM dbo.SHOEMETRO_InventoryAttributes ia
INNER JOIN shoemetro_overstock_Inventory i ON ia.SKU=i.vendor_sku
WHERE image1 IS NULL OR image2 IS NULL OR image3 IS null");    
    
    $ChannelAdvisorAPI = new ChannelAdvisorAPI();
    //$ChannelAdvisorAPI->debug=1;
    foreach($arrSKUs as $s){
        $sku = $s["SKU"];
        $ChannelAdvisorAPI->updateImage($sku);
    } 
    $db->__destruct();
?>

