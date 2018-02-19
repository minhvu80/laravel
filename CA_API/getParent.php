<?
    ini_set("display_errors","on");
    require_once("../../common/library/database/mssql/mssql.inc.php");
    require_once("../../common/library/channeladvisor/class.CAAPI.php");
    $db = new MsSQL();
    $arrSKUs = $db->getArray("SELECT SKU from SHOEMETRO_InventoryAttributes WHERE ParentSKU is null ORDER BY SKU");    

    $ChannelAdvisorAPI = new ChannelAdvisorAPI();
    
    foreach($arrSKUs as $s){
        $c++;
        $ChannelAdvisorAPI->getParentSKU($s["SKU"]);
        
    }
    $db->__destruct();
?>