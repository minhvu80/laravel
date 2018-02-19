<?
	ini_set("display_errors","on");
    require_once("../../common/library/database/mssql/mssql.inc.php");
    $db = new MsSQL();   
    clearOverflow();
	
	function clearOverflow(){
        global $db;
        $sql = "SELECT Bin,SKU FROM SHOEMETRO_tmpoverflow";
        $arrData = $db->getArray($sql);
        foreach($arrData as $d){
            $sql = "UPDATE shoemetro_cyclecount SET qty=qty-1 WHERE bin='{$d["Bin"]}' and SKU='{$d["SKU"]}'";
            $db->query($sql);
        }
        $db->query("Truncate Table shoemetro_tmpoverflow");
    }
?>