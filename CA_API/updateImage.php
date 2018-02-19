<?
    require_once("../../common/library/database/mssql/mssql.inc.php");
    require_once("../../common/library/channeladvisor/class.CAAPI.php");
    $db = new MsSQL();
    
    
    $ChannelAdvisorAPI = new ChannelAdvisorAPI();
    $arrSKU = $db->getArray("select ia.SKU from Inventory i inner join SHOEMETRO_InventoryAttributes ia on i.LocalSKU=ia.SKU
    where QOH>0 and image1 is null ORDER BY SKU");
    
    foreach($arrSKU as $s){
        $sku = $s["SKU"];
        $ChannelAdvisorAPI->updateImage($sku);
    }
    
    
    $db->__destruct();
?>