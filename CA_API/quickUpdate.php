<?
    require_once("../../common/library/database/mssql/mssql.inc.php");
    require_once("../../common/library/channeladvisor/class.CAAPI.php");
    $db = new MsSQL();
    $arrSKUs = $db->getArray("select i.LocalSKU from Inventory i 
                                inner join SHOEMETRO_POSupplier p on p.PO=i.Text5 
                                where (MapPrice=1 or MSRP=1) and QOH>0 ORDER BY LocalSKU");    

    $ChannelAdvisorAPI = new ChannelAdvisorAPI();
    foreach($arrSKUs as $s){
        $sku = $s["LocalSKU"];
        $ChannelAdvisorAPI->updatePrice($sku);
    } 
    
    $db->__destruct();
?>

