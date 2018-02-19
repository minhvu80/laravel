<?
    // update fresh Inventory Attributes, the one that missing Attributes
	   
    
    require_once("../../common/library/channeladvisor/class.CAAPI_Listings.php");
    $ChannelAdvisorAPI = new ChannelAdvisorAPI();
    //$ChannelAdvisorAPI->debug=1;
    $handle = fopen("_parent.txt");
    while (($data = fgetcsv($handle, 1000, "\t")) !== FALSE) {
        $strSKU = strtoupper($data[1]);
        
    }
    
    
     
    
    
?>

