<?
	ini_set("display_errors","on");
	
    require_once("../../common/library/database/mssql/mssql.inc.php");
    require_once("../../common/library/channeladvisor/class.CAAPI.php");
    $db = new MsSQL();
        
/*    $arrSKUs = $db->getArray("select LocalSKU from Inventory
                              except
                              select SKU from SHOEMETRO_InventoryAttributes
                              order by LocalSKU
                              ");  */  
    $arrSKUs = $db->getArray("select LocalSKU from Inventory i
                               LEFT JOIN dbo.SHOEMETRO_InventoryAttributes ia ON i.LocalSKU=ia.sku
                               WHERE ia.SKU IS null
                               ORDER BY LocalSKU
                              ");    
    
    $ChannelAdvisorAPI = new ChannelAdvisorAPI();
    
    //$ChannelAdvisorAPI->debug=1;
    
    echo "Found: ".count($arrSKUs)."\n";
    
    foreach($arrSKUs as $s){
        $sku = $s["LocalSKU"];
        $ChannelAdvisorAPI->updateInventoryAttribute($sku);
    } 
    
    $sql = "update i set i.ParentSKU=ia.ParentSKU
                FROM Inventory i inner join ShoeMetro_InventoryAttributes ia on i.LocalSKU=ia.SKU 
                where i.ParentSKU is null and ia.ParentSKU is not null";
                
    //$db->query($sql);    
    
    $arrCleanUpQuery=array("UPDATE dbo.SHOEMETRO_InventoryAttributes SET gender='Womens' WHERE category LIKE 'womens%' AND gender IS NULL",
                           "UPDATE dbo.SHOEMETRO_InventoryAttributes SET gender='Mens' WHERE category LIKE 'mens%' AND gender IS NULL",
                           "UPDATE dbo.SHOEMETRO_InventoryAttributes SET gender='Girls' WHERE category LIKE '%girl%' AND gender IS NULL",
                           "UPDATE dbo.SHOEMETRO_InventoryAttributes SET gender='Boys' WHERE category LIKE '%boys%' AND gender IS NULL",
                           "UPDATE dbo.SHOEMETRO_InventoryAttributes SET gender='Infants' WHERE category LIKE '%infant%' AND gender IS NULL");
    foreach($arrCleanUpQuery as $query) $db->query($query);
    //$sql = "DELETE FROM SHOEMETRO_InventoryAttributes WHERE Brand=''";
    $db->query($sql);
    $db->__destruct();
?>

