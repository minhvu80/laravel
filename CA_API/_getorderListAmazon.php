<?
    //exit;
    ini_set("display_errors","on");
    
    
    require_once("../rop/class.gudtech.php");
    
    $MyGudTech = new GudTech_API();
    
     //104-1655896-2353019,43-2A-1136,1
    include_once '../../common/library/GetReport/include_paths.php';

    $today_obj = new DateTime();
    $today = $today_obj->format('Y-m-d');
    $time_start = $today.'T0830';
    $time_end =  $today.'T1130';

    $time_start = "2014-12-07T0000";
    $time_end = "2014-12-08T0000";

    $arrFilter = array("order-status" => "Pending","merchant-order-id" => "");
    //$arrFilter = array("order-status" => "Pending");
    //$arrFilter = array("order-status" => SHIPPED);
    //$arrFilter = array("order-status" => CANCELLED);
    //$arrFilter = array("order-status" => ALL);

    $AGO = new AmazonGetOrders();
    // It may take a couple minutes to get the report.
    // Normally, less than 60 seconds to get a report.
    $orders_report = $AGO->GetOrders($time_start, $time_end, $arrFilter);
    if ($orders_report !== false){
        $output_file = 'orders_report_'.$time_start.'_'.$time_end.'_'.$arrFilter['order-status'].'.txt';
        file_put_contents($output_file, $orders_report);
    }
    exit; 
           
    
    
    
    /*
    $date = mktime();
    $dateGMT = gmdate("Y-m-d\TH:i:s.000\Z",strtotime("2011-11-12 15:00"));
    $dateEndGMT = gmdate("Y-m-d\TH:i:s.000\Z",$date);
    */
    
    $dateGMT = gmdate("Y-m-d\TH:i:s.000\Z",$date);
    $dateEndGMT = gmdate("Y-m-d\TH:i:s.000\Z",mktime());
    
    
    $d = $ChannelAdvisorAPI->getOrderList($dateGMT,$dateEndGMT,1,2);
    echo $totalMatch = $d[0]->NumberOfMatches."\n";
    $totalPages = ceil($totalMatch/50);
    
    if($totalPages>0):
        $handle=fopen("_getOrderList.ini","w");
        fwrite($handle,mktime()-900);
        fclose($handle);        
        for($i=1;$i<=$totalPages;$i++){
            if(count($d) && is_array($d)){
                
                $d = $ChannelAdvisorAPI->getOrderList($dateGMT,$dateEndGMT,$i,50);
                foreach($d as $orders){
                    
                    $clientOrderIdentifier = $orders->ClientOrderIdentifier;
                    $ref_number = $orders->ShoppingCart->CartID;
                    $date = $orders->OrderTimeGMT;   
                    $c[]=$clientOrderIdentifier;
                    
                    $lineItems = $orders->ShoppingCart->LineItemSKUList->OrderLineItemItem;
                    $count=1;
                    if(!is_array($lineItems)) {
                        $sku = $lineItems->SKU;
                        $quantity = $lineItems->Quantity;
                        $theDate = date("Y-m-d H:i:s",strtotime($date)-(8*3600));
                        $theRef = $ref_number."_".$sku;
                        $theClient = $clientOrderIdentifier."_".$count;
                        GudTechReserve($theClient,$theRef,$sku,$quantity,$theDate);
                        
                        
                    }
                    else{
                        foreach($lineItems as $l){
                            $sku = $l->SKU;
                            $quantity = $l->Quantity;
                            //$theRef = $ref_number."_".$count;
                            $theRef = $ref_number."_".$sku;
                            $theClient = $clientOrderIdentifier."_".$count;
                            $theDate = date("Y-m-d H:i:s",strtotime($date)-(8*3600));  
                            GudTechReserve($theClient,$theRef,$sku,$quantity,$theDate);
                            $count++;
                        }
                    }
                    $count=0;
                    
                    
                }
                
                
                //$ChannelAdvisorAPI->markExported($c);
                
                
                
            }
        }
   
    endif;
    
    function GudTechReserve($clientOrderIdentifier,$ref_number,$sku,$quantity,$date){
          global $MyGudTech;
          if(checkBefore($clientOrderIdentifier)){
              
              return;
          }
          else{
              $result = $MyGudTech->reserveSKU($ref_number,$sku,$quantity,$date);
              $reservation_id = $result->reservation_id;
              //if($reservation_id=="") logUnReserved($clientOrderIdentifier,$ref_number,$sku,$quantity);
              echo "[$reservation_id] :: $ref_number,$sku,$quantity,$date\n";
              logReference($ref_number,$sku,$quantity,$reservation_id,$date);
          }
    }
    
    function checkBefore($clientOrderIdentifier){
        global $db;
        $sql = "SELECT ref_number,date from SHOEMETRO_ROP_Reservation WHERE ref_number='$clientOrderIdentifier'";
        $arrData = $db->getArray($sql);
        if(is_array($arrData) && count($arrData)>0){
            echo "$clientOrderIdentifier already reserved on ".$arrData[0]["date"]."\n";
            return true;
        }
        else
            return false;
        
    }
    
    function logReference($ref_number,$sku,$quantity,$reservation_id,$date){
        global $db;
        $sql = "INSERT INTO SHOEMETRO_ROP_Reservation(ref_number,sku,quantity,reservation_id,date) VALUES('$ref_number','$sku','$quantity','$reservation_id','$date')";
        echo "Insert Reference $ref_number";
        $db->query($sql);
        
    }
    function logUnReserved($clientOrderIdentifier,$ref_number,$sku,$quantity){
        global $handle;
        fputcsv($handle,array($clientOrderIdentifier,$ref_number,$sku,$quantity));
    }
    
    
    
    
    
?>

