<?
    ini_set("display_errors","on");
    require_once("../../common/library/channeladvisor/class.CAAPI.php");
    require_once("../../common/library/database/mssql/mssql.inc.php");
    $db = new MsSQL();
    $channel = "AU";
    
    $ChannelAdvisorAPI = new ChannelAdvisorAPI($channel);
    $sql = "SELECT id,sku from SM_Intranet.dbo.CA_PurgeSKU where complete=0 and channel='$channel' order by id";
    $arrData = $db->getArray($sql);
    echo count($arrData);
    
    foreach($arrData as $a){
        $sku = $a["sku"];
        $id = $a["id"];
        $data = $ChannelAdvisorAPI->DeleteInventoryItem($sku);
        echo $sku." => ".$data->DeleteInventoryItemResult->Status." :: id => $id\n";
        //if($id%100==0) sleep(5);
        if($id%200==0) $db->query("UPDATE SM_Intranet.dbo.CA_PurgeSKU set complete=1 where id<=$id and channel='$channel'");
        
    }
    
    
    //$data = $ChannelAdvisorAPI->RemoveLabelListFromInventoryItemList(array("2042061"),array("Juggler Inventory"));
    //print_r($data);
    
    
?>

