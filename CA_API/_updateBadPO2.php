<?
    ini_set("display_errors","on");
    require_once("../../common/library/database/mssql/mssql.inc.php");
    require_once("../../common/library/channeladvisor/class.CAAPI.php");
    $db = new MsSQL();
    $arrSKUs = $db->getArray("select distinct SKU from [Order Details] where len(Text1)<4 and adjustment=0 AND LEN(SKU)>9 ORDER BY SKU");    

    $ChannelAdvisorAPI = new ChannelAdvisorAPI();
    
    foreach($arrSKUs as $s){
        $sku = $s["SKU"];
        $c++;
        $ChannelAdvisorAPI->updatePO_OrderDetail($sku);
    }
    $db->__destruct();
?>
