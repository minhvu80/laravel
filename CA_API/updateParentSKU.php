<?
    require_once("../../common/library/database/mssql/mssql.inc.php");
    require_once("../../common/library/channeladvisor/class.CAAPI.php");
    $db = new MsSQL();
       
    $arrSKUs = $db->getArray("select LocalSKU from Inventory WHERE ParentSKU is null or ParentSKU='' and QOH>0");    
    $sku = "247665,247666,247927,247932,247935";
    $arrSKUs = split(",",$sku);
    $ChannelAdvisorAPI = new ChannelAdvisorAPI();
    //$ChannelAdvisorAPI->debug=1;
    foreach($arrSKUs as $s){
        $sku = $s;
        $ChannelAdvisorAPI->updateParentSKUInventory($sku);
        
    } 
   
    $db->__destruct();
?>

