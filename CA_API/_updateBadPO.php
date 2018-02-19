<?
    ini_set("display_errors","on");
    require_once("../../common/library/database/mssql/mssql.inc.php");
    require_once("../../common/library/channeladvisor/class.CAAPI.php");
    $db = new MsSQL();
    $arrSKUs = $db->getArray("SELECT LocalSKU FROM dbo.Inventory i WHERE (text5='' OR text5 IS NULL) Order by LocalSKU");    

    $ChannelAdvisorAPI = new ChannelAdvisorAPI();
    echo "Found ".count($arrSKUs);
    foreach($arrSKUs as $s){
        $sku = $s["LocalSKU"];
        $c++;
        $ChannelAdvisorAPI->updatePO($sku);
    }
    $db->__destruct();
?>
