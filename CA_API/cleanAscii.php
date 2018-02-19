<?php
    require_once("../../common/library/database/mssql/mssql.inc.php");
    $db = new MsSQL();   

    $sql = "SELECT o.OrderNumber,
            shipaddress+ISNULL(ShipAddress2,'')+ISNULL(shipcity,'')+ISNULL(ShipName,'') as hidShipString, 
            ShipAddress,
            ShipAddress2,
            ShipCity,
            ShipName
            FROM dbo.SHOEMETRO_Queue t 
            INNER JOIN orders o ON o.ordernumber=t.OrderNumber
            WHERE flag<>''";
            
    $arrData = $db->getArray($sql);
    
    $pattern = "/[^(\x20-\x7F)]/"; 
    
    foreach($arrData as $d):
        $arrMatches=null;
        preg_match($pattern,$d["hidShipString"],$arrMatches);
        if(strlen($arrMatches[0])>0) $arrOrders[]=$d;
    endforeach;    
    
?>