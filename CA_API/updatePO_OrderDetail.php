<?
    require_once("../../common/library/database/mssql/mssql.inc.php");
    require_once("../../common/library/channeladvisor/class.CAAPI.php");
    $db = new MsSQL();
    $arrSKUs = $db->getArray("select distinct SKU as LocalSKU from [Order Details] where (Text1 is null or Text1='') and Adjustment=0 and DetailDate>='2012-01-01' order by LocalSKU");
    $ChannelAdvisorAPI = new ChannelAdvisorAPI();
      foreach($arrSKUs as $s){
        $sku = $s["LocalSKU"];
        $ChannelAdvisorAPI->updatePrice($sku);    
        
    } 
    

    $db->__destruct();
?>

