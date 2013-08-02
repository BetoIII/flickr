<?
	require_once("phpFlickr.php");
	
	//create a function to delete the given photo
	function deletePhoto($deletePhotoID) {
	    $apiKey = "b6c475736c71a970e3c485cb62722156";
	    $apiSecret = "1f2ab15d4f172f5d";
	    $permissions  = "delete";
	    $token        = "72157634801710725-fb6a8b937dd29c9b";

	    $f = new phpFlickr($apiKey, $apiSecret, true);
	    $f->setToken($token);
	    return $f->photos_delete($deletePhotoID);
	}

	//Delete photo when button is pushed
	if(isset($_POST['delete'])){
		$deletePhotoID = $_REQUEST['photoid'];
	
		?><script>
			alert("<? echo $deletePhotoID ?>");
		</script><?

		deletePhoto($deletePhotoID);
		
		echo 'Photo successfully deleted! <br> <a href="http://betojuareziii.com/flickr/delete.php"><button>Go back!</button></a>';			
	}
?>