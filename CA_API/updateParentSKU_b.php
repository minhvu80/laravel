<?
    require_once("../../common/library/database/mssql/mssql.inc.php");
    require_once("../../common/library/channeladvisor/class.CAAPI.php");
    $db = new MsSQL();
       
    $arrSKUs = $db->getArray("select distinct ParentSKU from Inventory where QOH>0 
and ParentSKU<>'' and ParentSKU is not null
order by ParentSKU desc");    
    
    $ChannelAdvisorAPI = new ChannelAdvisorAPI();
    //$ChannelAdvisorAPI->debug=1;
    foreach($arrSKUs as $s){
        $sku = $s["ParentSKU"];
        $ChannelAdvisorAPI->updateInventoryAttribute($sku);
        
    } 
   
    $db->__destruct();
?>

