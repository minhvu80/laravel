<?
    ini_set("display_errors","on");
    require_once("../../common/library/database/mssql/mssql.inc.php");
    require_once("../../common/library/channeladvisor/class.CAAPI.php");
    $db = new MsSQL();
    $offset = 3*24*3600;
    $begin = date("Y-m-d",(mktime()-$offset));
    $today = date("Y-m-d");
    $sql = "SELECT distinct sku FROM dbo.[Order Details] WHERE DetailDate BETWEEN '$begin' AND '$today' AND adjustment=0 AND (LEN(text1)<4 or text1='' or text1 is null) ORDER BY sku";
    
    $arrSKUs = $db->getArray($sql);
    $ChannelAdvisorAPI = new ChannelAdvisorAPI();
      foreach($arrSKUs as $s){
        $sku = $s["sku"];
        $ChannelAdvisorAPI->updatePO($sku);    
    } 
    $db->__destruct();
?>

