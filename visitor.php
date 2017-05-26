<?php

/**
 * @author Naim Ahmed
 * @copyright 2017
 */

require ('ua.php');
require ('db.php');

// For Local host
if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

/*
// For web host
if ($_SERVER['HTTP_CLIENT_IP'])
    $ip = $_SERVER['HTTP_CLIENT_IP'];
else if($_SERVER['HTTP_X_FORWARDED_FOR'])
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
else if($_SERVER['HTTP_X_FORWARDED'])
    $ip = $_SERVER['HTTP_X_FORWARDED'];
else if($_SERVER['HTTP_FORWARDED_FOR'])
    $ip = $_SERVER['HTTP_FORWARDED_FOR'];
else if($_SERVER['HTTP_FORWARDED'])
    $ip = $_SERVER['HTTP_FORWARDED'];
else if($_SERVER['REMOTE_ADDR'])
    $ip = $_SERVER['REMOTE_ADDR'];
else
    $ip = 'UNKNOWN';
*/

// For debug
$ip = "138.68.56.74";

/** ==== Get IP info from ip-api ==== */
$query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));

/** ==== Check query is success or not. If failed then script will stop ==== */
if($query && $query['status'] != 'success') {
  echo 'Unable to get location';
  exit;
}

$country = $query['country'];
$countryCode = $query['countryCode'];
$regionName = $query['regionName'];
$region = $query['region'];
$city = $query['city'];
$zip = $query['zip'];
$lat = $query['lat'];
$lon = $query['lon'];
$timezone = $query['timezone'];
$isp = $query['isp'];
$org = $query['org'];
$asn = $query['as'];
// for debuging
//echo "$ip<br />$country<br />$countryCode<br />$regionName<br />$region<br />$city<br />$zip<br />$lat<br />$lon<br />$timezone<br />$isp<br />$org<br />$asn<br />";


/*
//ipinfodb api
$api= "764cbf512be6a4ab9f4016e2bbd0bf30b0ef171519d3473c0b47c15f51ec180c" ;  
$city = "http://api.ipinfodb.com/v3/ip-city/?key=$api&ip=$ip";
$country = "http://api.ipinfodb.com/v3/ip-country/?key=$api&ip=$ip";

// cURL
//Prepare connection and parse results into variables 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "$city");
//Ask cURL to return the contents in a variable instead of simply echoing them to the browser.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//Execute the cURL session
$contents = curl_exec($ch);
//echo curl contents
echo $contents. "<br />";
//Close cURL session
curl_close ($ch);

// Break a string into an array
$break = explode(";", $contents) ;
$country = $break['4'] ;
$countryCode = $break['3'] ;
$city = $break['6'] ;
$city2 = $break['5'] ;
*/

/** ==== Get more about visitor ==== */
date_default_timezone_set("Asia/Riyadh");
$date = date("Y-m-d");
$time = date("h:ia");
$query_string = $_SERVER['QUERY_STRING'];
$http_referer = isset( $_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "no referer";
$web_page = $_SERVER['SCRIPT_NAME'];
$isbot = is_Bot() ? '1' : '0';
// for debuging
//echo "$date<br />$time<br />$query_string<br />$http_referer<br />$os<br />$browser<br />$web_page<br />$isbot";


/** ==== Save Visitor Info Into MySQL ==== */
$sql = "INSERT INTO visitor (ip, country, countryCode, regionName, region, city, zip, lat, lon, timezone, isp, org, date, time, query_string, http_referer, os, browser, web_page, isbot) 
VALUES ('$ip', '$country', '$countryCode', '$regionName', '$region', '$city', '$zip', '$lat', '$lon', '$timezone', '$isp', '$org', '$date', '$time', '$query_string', '$http_referer', '$os', '$browser', '$web_page', '$isbot')";
$conn->query($sql);
$visitorCount = $conn->insert_id;
/*
// For debug
if ($conn->query($sql) === TRUE) {
    $visitorCount = $conn->insert_id;
    echo "Visitor info saved successfully. This visitor number is ID is: " . $visitorCount;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
*/
$conn->close();
/** ==== End Save Visitor Info Into MySQL ==== */



/** ==== Detect if visitor is a "bot" ==== */
function is_bot() {
    $botlist = getBotList() ;
    foreach($botlist as $bot) {
        if(strpos($_SERVER['HTTP_USER_AGENT'] , $bot) !== false)
        return true ;
	}
    return false ;
}
/** ==== end function is_bot ==== */


	
/** ==== Parse the bot.txt file into an array ==== */
function getBotList(){
    if (($handle = fopen("bot.txt", "r")) !== FALSE) {
        $count= 1 ;
        $bots = array() ;
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        if (strchr($data[0] , "robot-id:")) {
            //echo $count ." $data[0]"."<br>"; // for debuging
	       $botId = substr("$data[0]", 9) . "<br>" ;
	       array_push($bots, "$botId") ;
	       $count++ ;		
	       }
	   }    
    fclose($handle);
    return $bots ;
	}
} 
/** ==== end function getBotList ==== */
?>