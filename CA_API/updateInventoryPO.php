<?
    require_once("../../common/library/database/mssql/mssql.inc.php");
    require_once("../../common/library/channeladvisor/class.CAAPI.php");
    $db = new MsSQL();
    $arrSKUs = $db->getArray("select LocalSKU from Inventory where (Text5 is null or Text5='') and Len(LocalSKU)<9 Order by LocalSKU");    

    $ChannelAdvisorAPI = new ChannelAdvisorAPI();
    foreach($arrSKUs as $s){
        $sku = $s["LocalSKU"];
        $ChannelAdvisorAPI->updatePO($sku);    
        //$ChannelAdvisorAPI->updateInventoryAttribute($sku,"\n");
    }
    

    $db->__destruct();
?>

