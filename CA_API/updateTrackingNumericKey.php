<?
    require_once("../../common/library/database/mssql/mssql.inc.php");
    require_once("../../common/library/channeladvisor/class.CAAPI.php");
    $db = new MsSQL();
    $db->query("update Tracking set NumericKey=OrderNum where OrderNum<>NumericKey");                                                      
    $db->query("update Packing set PackageID=0 where PackageID<>0");                                                      
    $db->__destruct();
?>