<?
    require_once("../../common/library/database/mssql/mssql.inc.php");
    require_once("../../common/library/channeladvisor/class.CAAPI.php");
    $db = new MsSQL();
    
    
    $ChannelAdvisorAPI = new ChannelAdvisorAPI();
    $arrSKU = $db->getArray("select SKU from shoemetro_caexport except select localsku from Inventory");
    
    foreach($arrSKU as $s){
        $sku = $s["SKU"];
        $ChannelAdvisorAPI->addSKUToInventory($sku);
    }
    
    
    $db->__destruct();
?>