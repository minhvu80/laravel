<?
    if($_GET["date_start"]!=""){
        require_once("../../common/library/channeladvisor/class.CAAPI.php");
        require_once("../../common/library/database/mssql/mssql.inc.php");
        $ChannelAdvisorAPI = new ChannelAdvisorAPI();
            
        
        //$date_start = strtotime("2013-02-12 05:00");
        //$date_end = strtotime("2013-02-12 06:00");
        
        $date_start = strtotime($_GET["date_start"]);
        $date_end = strtotime($_GET["date_end"]);
        
        $dateGMT = gmdate("Y-m-d\TH:i:s.000\Z",$date_start);
        $dateEndGMT = gmdate("Y-m-d\TH:i:s.000\Z",$date_end);
        
        
        $d = $ChannelAdvisorAPI->getCheckOut($dateGMT,$dateEndGMT,1,2);
        
        echo $totalMatch = $d[0]->NumberOfMatches."\n";
        $totalPages = ceil($totalMatch/50);
        
        if($totalPages>0):
            for($i=1;$i<=$totalPages;$i++){
                if(count($d) && is_array($d)){
                    
                    $d = $ChannelAdvisorAPI->getCheckOut($dateGMT,$dateEndGMT,$i,50);
                    print_r($d);
                    exit;
                    foreach($d as $orders){
                       print_r($orders);          
                       exit; 
                        
                    }
                    
                  
                        
                    
                    
                }
            }
       
        endif;
    }
    
   
    
    
    
    
    
?>

