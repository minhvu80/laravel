<?
    ini_set("display_errors","on");
    require_once("../../common/library/channeladvisor/class.CAAPI.php");
    
    
    $ChannelAdvisorAPI = new ChannelAdvisorAPI();
    $sku = "1916208";
    $result = $ChannelAdvisorAPI->getSKUInfo($sku);
    print_r($result);
    
?>

