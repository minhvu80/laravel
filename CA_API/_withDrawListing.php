<?
    // update fresh Inventory Attributes, the one that missing Attributes
	   
    
    require_once("../../common/library/channeladvisor/class.CAAPI_Listings.php");
    $ChannelAdvisorAPI = new ChannelAdvisorAPI();
    //$ChannelAdvisorAPI->debug=1;
    $lines=file("_withDrawListing.txt");
    $i=1;
    $count=0;
    foreach($lines as $l){
        $l=trim($l,"\r\n");
        if($i%400==0){
            $ChannelAdvisorAPI->WithDrawListings($arrSKU);
            $arrSKU=array();
            echo $count;
            echo "\n";
            $i=1;
        }
        $arrSKU[]=$l;
        $i++;
        $count++;
    }
    
     $ChannelAdvisorAPI->WithDrawListings($arrSKU); 
     echo $count;
     echo "\n";
    
     
    
    
?>

