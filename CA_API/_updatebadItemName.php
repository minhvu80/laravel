<?
    ini_set("display_errors","on");
    require_once("../../common/library/database/mssql/mssql.inc.php");
    require_once("../../common/library/channeladvisor/class.CAAPI.php");
    $db = new MsSQL();
    $arrSKUs = $db->getArray("SELECT LocalSKU FROM SQLStoneEdge.dbo.Inventory WHERE ItemName='Fly London Fatale Womens SZ 6 Black Dress Mules Shoes EU 37' and LocalSKU>'32-1C-1254' order by qoh desc,LocalSKU asc");    

    $ChannelAdvisorAPI = new ChannelAdvisorAPI();
    echo "Found ".count($arrSKUs);
    foreach($arrSKUs as $s){
        $sku = $s["LocalSKU"];
        $c++;
        $ChannelAdvisorAPI->updatePrice($sku,false,0);
    }
    $db->__destruct();
?>