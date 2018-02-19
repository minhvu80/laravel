<?
    require_once("../../common/library/database/mssql/mssql.inc.php");
    require_once("../../common/library/channeladvisor/class.CAAPI.php");
    $db = new MsSQL();
    $today = date("Y-m-d");
    removeAsciiCharacter();
    $arrSKUs = $db->getArray("select distinct SKU,flag,cartIdentifier,o.OrderNumber,LocalSortText2,round from [Order Details] od 
                             inner join SHOEMETRO_Queue t on od.OrderNumber=t.OrderNumber 
                             inner join Orders o on o.OrderNumber=od.OrderNumber 
                             where Adjustment=0 and t.date='$today' and round in(Select MAX(round) from SHOEMETRO_Queue) order by SKU");    
    $today = date("Y-m-d");
    //$db->query("DELETE FROM SHOEMETRO_OverSold WHERE date='$today'");
    $ChannelAdvisorAPI = new ChannelAdvisorAPI();
    
    foreach($arrSKUs as $s){
        $ChannelAdvisorAPI->checkNegative($s["OrderNumber"],$s["SKU"],$s["round"]);
        
        
    } 
    
    $db->__destruct();
    
    function removeAsciiCharacter(){
        global $db;
        global $today;
        $GLOBALS['normalizeChars'] = array(
                '�'=>'S', '�'=>'s', '�'=>'Dj','�'=>'Z', '�'=>'z', '�'=>'A', '�'=>'A', '�'=>'A', '�'=>'A', '�'=>'A',
                '�'=>'A', '�'=>'A', '�'=>'C', '�'=>'E', '�'=>'E', '�'=>'E', '�'=>'E', '�'=>'I', '�'=>'I', '�'=>'I',
                '�'=>'I', '�'=>'N', '�'=>'O', '�'=>'O', '�'=>'O', '�'=>'O', '�'=>'O', '�'=>'O', '�'=>'U', '�'=>'U',
                '�'=>'U', '�'=>'U', '�'=>'Y', '�'=>'B', '�'=>'Ss','�'=>'a', '�'=>'a', '�'=>'a', '�'=>'a', '�'=>'a',
                '�'=>'a', '�'=>'a', '�'=>'c', '�'=>'e', '�'=>'e', '�'=>'e', '�'=>'e', '�'=>'i', '�'=>'i', '�'=>'i',
                '�'=>'i', '�'=>'o', '�'=>'n', '�'=>'o', '�'=>'o', '�'=>'o', '�'=>'o', '�'=>'o', '�'=>'o', '�'=>'u',
                '�'=>'u', '�'=>'u','�' => 'u', '�'=>'y', '�'=>'y', '�'=>'b', '�'=>'y', '�'=>'f', '&' => 'and'
            );
        $sql = "SELECT top 1 round from SHOEMETRO_Queue where date='$today' order by round desc";
        $arrData = $db->getArray($sql);
        if(is_array($arrData) && count($arrData)):
            $round = $arrData[0]['round'];
            $sql = "SELECT o.OrderNumber,ShipName,ShipCompany,ShipAddress,ShipAddress2,ShipCity,ShipState from Orders o
                inner join SHOEMETRO_Queue t on t.OrderNumber=o.OrderNumber
                where ShipCountry<>'United States' and round=$round
                ";
            $arrData = $db->getArray($sql);
            foreach($arrData as $d):
                foreach($d as $key  =>  $value){
                    $newValue = strtr($value,$GLOBALS['normalizeChars']);
                    $newValue = preg_replace("/[^\x9\xA\xD\x20-\x7F]/", "?", $newValue);       
                    $newValue  = str_replace("'","''",$newValue);
                    if($newValue!=" " && $newValue!="  ") $arrUpdate[$d["OrderNumber"]][] = "$key='$newValue'";
                }
                
            endforeach;

            foreach($arrUpdate as $key => $a){
                $sql = "UPDATE Orders SET ".join(",",$a)." WHERE OrderNumber=$key";
                $db->query($sql);
                
            }
        endif;
    }
?>