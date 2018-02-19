<?
    require_once("../../common/library/database/mssql/mssql.inc.php");
    require_once("../../common/library/channeladvisor/class.CAAPI.php");
    $db = new MsSQL();
    $ChannelAdvisorAPI = new ChannelAdvisorAPI();
    $ChannelAdvisorAPI->CAUpdatePriceNightly();
    $db->__destruct();
?>

