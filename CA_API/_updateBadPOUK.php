<?
    ini_set("display_errors","on");
    require_once("../../common/library/database/mssql/mssql.inc.php");
    require_once("../../common/library/channeladvisor/class.CAAPI.php");
    $db = new MsSQL();
    $arrSKUs = $db->getArray("SELECT DISTINCT SKU FROM dbo.[Order Details] od INNER JOIN orders o ON o.ordernumber=od.ordernumber WHERE adjustment=0 AND localsorttext2 LIKE '%uk%' AND text1='666'");    

    $ChannelAdvisorAPI = new ChannelAdvisorAPI();
    
    foreach($arrSKUs as $s){
        $sku = $s["SKU"];
        $c++;
        $ChannelAdvisorAPI->updatePO_OrderDetail($sku);
    }
    $db->__destruct();
?>
