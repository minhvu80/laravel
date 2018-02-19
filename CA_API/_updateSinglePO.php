<?
    ini_set("display_errors","on");
    require_once("../../common/library/database/mssql/mssql.inc.php");
    require_once("../../common/library/channeladvisor/class.CAAPI.php");
    $db = new MsSQL();
    

    $ChannelAdvisorAPI = new ChannelAdvisorAPI();
    $sku = 21077;
    $ChannelAdvisorAPI->updatePO_OrderDetail($sku);
    
    $db->__destruct();
?>
