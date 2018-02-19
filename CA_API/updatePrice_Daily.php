<?
    require_once("../../common/library/database/mssql/mssql.inc.php");
    require_once("../../common/library/channeladvisor/class.CAAPI.php");
    $db = new MsSQL();
    $arrSKUs = $db->getArray("select LocalSKU from Inventory where (
        (Price is null or Price2 is null or Price4 is null or 
         Price=0 or Price2=0 or Price4=0) 
         and QOH>0
       ) or ( LocalSKU=ItemName) AND LocalSKU NOT LIKE 'ds-%' order by LocalSKU");    

     
       
    $ChannelAdvisorAPI = new ChannelAdvisorAPI();
    foreach($arrSKUs as $s){
        $sku = $s["LocalSKU"];
        $ChannelAdvisorAPI->updatePrice($sku);
    }

    $db->__destruct();
?>

