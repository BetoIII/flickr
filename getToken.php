<?
require_once("phpFlickr/phpFlickr.php");
$apiKey = "b6c475736c71a970e3c485cb62722156";
$secret = "1f2ab15d4f172f5d";
$perms = "delete";

$f = new phpFlickr($apiKey,$secret);


//Redirect to flickr for authorization
    if(!$_GET['frob']){
        $f->auth($perms);
    }else {
        //If authorized, print the token
        $tokenArgs = $f->auth_getToken($_GET['frob']);
        echo "<pre>"; var_dump($tokenArgs); echo "</pre>";
    }
?>