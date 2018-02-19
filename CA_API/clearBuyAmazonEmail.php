<?
    require_once("../../common/library/database/mssql/mssql.inc.php");
    $db = new MsSQL();
    $today = date("Y-m-d");
    $sql = "update t set EmailSent=1,StatusSent=1 from Tracking t
            inner join Orders o on t.OrderNum=o.OrderNumber
            where DateAdded between '$today' and '$today 23:00' and LocalSortText2 in('Buy.com','Amazon Seller Central - US') and (EmailSent<>1)";
    $db->query($sql);
    
?>