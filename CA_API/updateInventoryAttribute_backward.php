<?
	ini_set("display_errors","on");
	
    require_once("../../common/library/database/mssql/mssql.inc.php");
    require_once("../../common/library/channeladvisor/class.CAAPI.php");
    $db = new MsSQL();
       
    $arrSKUs = $db->getArray("select LocalSKU from Inventory
                              except
                              select SKU from SHOEMETRO_InventoryAttributes
                              order by LocalSKU desc
                              ");    
    
    $ChannelAdvisorAPI = new ChannelAdvisorAPI();
    //$ChannelAdvisorAPI->debug=1;
    foreach($arrSKUs as $s){
        $sku = $s["LocalSKU"];
        $ChannelAdvisorAPI->updateInventoryAttribute($sku);
        
        
    } 
    $sql = "update i set i.ParentSKU=ia.ParentSKU
                FROM Inventory i inner join ShoeMetro_InventoryAttributes ia on i.LocalSKU=ia.SKU 
                where i.ParentSKU is null and ia.ParentSKU is not null";
    $db->query($sql);    
    

    $db->__destruct();
?>

