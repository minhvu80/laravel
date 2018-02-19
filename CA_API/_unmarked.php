<?
    ini_set("display_errors","on");
    require_once("../../common/library/channeladvisor/class.CAAPI.php");
    require_once("../rop/class.gudtech.php");
    $ChannelAdvisorAPI = new ChannelAdvisorAPI();
    $MyGudTech = new GudTech_API();
     //104-1655896-2353019,43-2A-1136,1
    //$d = $ChannelAdvisorAPI->getOrderList("2011-11-02");
    
    $c = array(10221400,10221401);
    $ChannelAdvisorAPI->markUnExported($c);      
    
   /* $handle = fopen("unreserved.txt","w");
    if(count($d) && is_array($d)){
        $totalFound = $d[0]->NumberOfMatches;
        echo "Found: $totalFound\n";
        
        foreach($d as $orders){
            $clientOrderIdentifier = $orders->ClientOrderIdentifier;
            $ref_number = $orders->ShoppingCart->CartID;
            $date = $orders->OrderTimeGMT;   
            $c[]=$clientOrderIdentifier;
            
            $lineItems = $orders->ShoppingCart->LineItemSKUList->OrderLineItemItem;
            if(!is_array($lineItems)) {
                $sku = $lineItems->SKU;
                $quantity = $lineItems->Quantity;
                GudTechReserve($clientOrderIdentifier,$ref_number,$sku,$quantity,$date);
                
            }
            else{
                foreach($lineItems as $l){
                    $sku = $l->SKU;
                    $quantity = $l->Quantity;
                    GudTechReserve($clientOrderIdentifier,$ref_number,$sku,$quantity,$date);
                }
            }
            
            
        }
        
        
        $ChannelAdvisorAPI->markExported($c);
        
        
        
    }
    fclose($handle);     
    function GudTechReserve($clientOrderIdentifier,$ref_number,$sku,$quantity,$date){
          global $MyGudTech;
          $result = $MyGudTech->reserveSKU($ref_number,$sku,$quantity,$date);
          $reservation_id = $result->reservation_id;
          if($reservation_id=="") logUnReserved($clientOrderIdentifier,$ref_number,$sku,$quantity);
          echo "[$reservation_id] :: $clientOrderIdentifier,$sku,$quantity,$date\n";
    }
    
    function logUnReserved($clientOrderIdentifier,$ref_number,$sku,$quantity){
        global $handle;
        fputcsv($handle,array($clientOrderIdentifier,$ref_number,$sku,$quantity));
    }
                        */
    
    
    
    
?>

