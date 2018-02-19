<?
    ini_set("display_errors","on");
    require_once("../../common/library/database/mssql/mssql.inc.php");
    require_once("../../common/library/channeladvisor/class.CAAPI.php");
    $db = new MsSQL();
    $arrSKUs = $db->getArray("select LocalSKU as SKU from Inventory i where (i.Text5 = '' OR Text5 IS NULL) order by LocalSKU");    

    $ChannelAdvisorAPI = new ChannelAdvisorAPI();
    
    foreach($arrSKUs as $s){
        $sku = $s["SKU"];
        $c++;
        $ChannelAdvisorAPI->updatePO($sku);
    }
    $db->__destruct();
?>