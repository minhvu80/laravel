<?
    //exit;
    ini_set("display_errors","on");
    
    
    require_once("../../common/library/channeladvisor/class.CAAPI.php");
    
    $ChannelAdvisorAPI = new ChannelAdvisorAPI();
    $ChannelAdvisorAPI->getSKUWithQuantity();
    
    
    
?>

