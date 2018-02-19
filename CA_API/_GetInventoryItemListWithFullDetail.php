<?
    ini_set("display_errors","on");
    //require_once("../../common/library/database/mssql/mssql.inc.php");
    require_once("../../common/library/channeladvisor/class.CAAPI.php");
    $mySKU = new ChannelAdvisorAPI();
    $data = $mySKU->getSKUInfo("42-9B-1187");
    print_r($data);
    
?>

