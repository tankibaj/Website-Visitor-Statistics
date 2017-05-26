<?php

/**
 * @author Naim Ahmed
 * @copyright 2017
 */


$ua = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "no User-agent" ;


/**    ====    Detect the OS    ====    */

    // Android
    $android        = strpos($ua, 'Android') ? true : false;

    // BlackBerry
    $blackberry     = strpos($ua, 'BlackBerry') ? true : false;

    // iPhone
    $iphone         = strpos($ua, 'iPhone') ? true : false;

    // Palm
    $palm           = strpos($ua, 'Palm') ? true : false;

    // Linux
    $linux          = strpos($ua, 'Linux') ? true : false;

    // Macintosh
    $mac            = strpos($ua, 'Macintosh') ? true : false;

    // Windows
    $win            = strpos($ua, 'Windows') ? true : false;

/**    ============================    */



/**    ====    Detect the UA    ====    */

    // Chrome
    $chrome         = strpos($ua, 'Chrome') ? true : false;        // Google Chrome
    
    // Firefox
    $firefox        = strpos($ua, 'Firefox') ? true : false;    // All Firefox
    
    // Internet Exlporer
    $msie           = strpos($ua, 'MSIE') ? true : false;        // All Internet Explorer
    
    // Opera
    $opera          = preg_match("/\bOpera\b/i", $ua);                    // All Opera
    
    // Safari
    $safari         = strpos($ua, 'Safari') ? true : false;        // All Safari

/**    ============================    */



/**    ====    Print OS info    ====    */
if ($ua) {

    // macOS
    if ($mac) {                    
        $os= 'macOS';
    }
            
    // Windows OS   
    elseif ($win) {                    
        $os= 'Windows';
    }
        
    // Linux Desktop    
    elseif ($linux) {                    
        $os= 'Linux';
    }
        
    // Android      
    elseif ($android) {                    
        $os = 'Android';
    }
    
    // Blackbery    
    elseif ($blackbery) {                    
        $os = 'Blackbery';
    }
        
    // iPhone
    elseif ($iphone) {                    
        $os = 'iOS';
    }
        
    // Palm
    elseif ($palm) {                    
        $os = 'Palm';
    }
  
    // If none of the above
    else {                              
        $os = "Couldn't detect os";
    }     
/**    ============================    */        

        
        
/**    ====    Print UA info    ====    */

    // Firefox
    if ($firefox) {
        $browser = 'Firefox';
    }

    // Chrome
    elseif ($chrome) {
        $browser = 'Chrome';
    }

    // Safari
    elseif ($safari) {
        $browser = 'Safari';
    }

    // Explorer
    elseif ($msie) {
        $browser = 'Internet Explorer';
    }

    // Opera
    elseif ($opera) {
        $browser = 'Opera';
    }

    // If none of the above
    else {
        $browser = "Couldn't detect browser";
    }
}
/**    ============================    */

// For debug
//echo $os."<br />".$browser;
?>