<?php
    /* Last updated with phpFlickr 1.4
     *
     * If you need your app to always login with the same user (to see your private
     * photos or photosets, for example), you can use this file to login and get a
     * token assigned so that you can hard code the token to be used.  To use this
     * use the phpFlickr::setToken() function whenever you create an instance of 
     * the class.
     */

	require_once("phpFlickr.php");
	
	$apiKey = "b6c475736c71a970e3c485cb62722156";
	$secret = "1f2ab15d4f172f5d";
	$perms = "delete";
	
    require_once("phpFlickr.php");
    $f = new phpFlickr($apiKey, $secret);
    
    //change this to the permissions you will need
    $f->auth($perms);

	//Redirect to flickr for authorization
	    if(!$_GET['frob']){
	        $f->auth($perms);
	    }else {
	        //If authorized, print the token
	        $tokenArgs = $f->auth_getToken($_GET['frob']);
	        echo "<pre>"; var_dump($tokenArgs); echo "</pre>";
	    }
    
    echo "Copy this token into your code: " . $_SESSION['phpFlickr_auth_token'];
    
?>