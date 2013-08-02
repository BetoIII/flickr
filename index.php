<?php
	require_once("phpFlickr/phpFlickr.php");
	
	$error=0;
	$f = null;
	if($_POST){
	    if(!$_POST['name'] || !$_FILES["file"]["name"]){
	        $error=1;
	    }else{
	        if ($_FILES["file"]["error"] > 0){
	            echo "Error: " . $_FILES["file"]["error"] . "<br />";
	        }else if($_FILES["file"]["type"] != "image/jpg" && $_FILES["file"]["type"] != "image/jpeg" && $_FILES["file"]["type"] != "image/png" && $_FILES["file"]["type"] != "image/gif"){
	            $error = 3;
	        }else if(intval($_FILES["file"]["size"]) > 525000){
	            $error = 4;
	        }else{
	            $dir= dirname($_FILES["file"]["tmp_name"]);
	            $newpath=$dir."/".$_FILES["file"]["name"];
	            rename($_FILES["file"]["tmp_name"],$newpath);
	            //Instantiate phpFlickr
	            $status = uploadPhoto($newpath, $_POST["name"]);
	            if(!$status) {
	                $error = 2;
	            }
	         }
	     }
	}

	function uploadPhoto($path, $title) {
	    $apiKey = "b6c475736c71a970e3c485cb62722156";
	    $apiSecret = "1f2ab15d4f172f5d";
	    $permissions  = "delete";
	    $token        = "72157634801710725-fb6a8b937dd29c9b";

	    $f = new phpFlickr($apiKey, $apiSecret, true);
	    $f->setToken($token);
	    return $f->async_upload($path, $title);
	}
?>

<html>
	<title>Flickr API Test</title>
<head>
</head>
<body>
	<h1>Hello world. This is a Flickr test application.</h1>
	<h2>Upload some photos to Beto's stream</h2>
	<?php
		if (isset($_POST['name']) && $error==0) {
		    echo "  <h3>Your file has been uploaded to <a href='http://www.flickr.com/photos/98605209@N04/' target='_blank'>Beto's photo stream</a></h3>";
		}else {
		    if($error == 1){
		        echo "  <font color='red'>Please provide both name and a file</font>";
		    }else if($error == 2) {
		        echo "  <font color='red'>Unable to upload your photo, please try again</font>";
		    }else if($error == 3){
		        echo "  <font color='red'>Please upload JPG, JPEG, PNG or GIF image ONLY</font>";
		    }else if($error == 4){
		        echo "  <font color='red'>Image size greater than 512KB, Please upload an image under 512KB</font>";
		    }
		}
	?>
	
	<h3>Upload your Pic!</h3>
	<form  method="post" accept-charset="utf-8" enctype='multipart/form-data'>
	 	<p>Name: &nbsp; <input type="text" name="name" value="" ></p>
		<p>Picture: <input type="file" name="file"/></p>
		<p><input type="submit" value="Submit"></p>
	</form>
	
</body>
</html>