<?php
	require_once("phpFlickr/phpFlickr.php");
	require_once("phpFlickr/config.php");
?>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Delete a Flickr Photo</title>
	<meta name="generator" content="TextMate http://macromates.com/">
	<meta name="author" content="Beto Juarez III">
	<!-- Date: 2013-07-26 -->
	<style>
	.photobox{
		float:left;
		padding:20px;
	}
	</style>
</head>
<body>
	<?
		// Istantiate the phpFlickr class with our API details in config.php
		// The third parameter is set to `true`, which will die on error and output error information.
		// In a production website, this should be set to `false` and the error retrieved from the 
		// getErrorMsg() & getErrorCode() methods in the phpFlickr class when false is returned.
		$flickr      = new phpFlickr(FLICKR_API_KEY, FLICKR_API_SECRET, true);

		// Specify a flickr user to retrieve results for.
		$flickr_user = 'betojuareziii';

		// Get the user's details by their username.
		// You can also lookup a user by the people_findByEmail() method.
		// Check this for a `false` value on error, Example: 
		if( $user === false )
		    die('User not found.  Check privacy settings/username. Error:'. $flickr->getErrorMsg());
		$user        = $flickr->people_findByUsername($flickr_user);

		// Get the user's base photo URL needed for linking retrieved images.
		$base_url    = $flickr->urls_getUserPhotos($user['id']);

		// Get the user's 10 most-recent public photos (number determined by the 4th parameter).
		// Here's the method and it's parameters for reference:
		// people_getPublicPhotos ($user_id, $safe_search = NULL, $extras = NULL, $per_page = NULL, $page = NULL)
		$photos      = $flickr->people_getPublicPhotos($user['id'], NULL, NULL, 5);
		
		// At this point, we should have some photo results if nothing failed!
		// Uncomment the following two lines to dump the results, which should be an array:
		// echo '<pre>'. print_r($photos, true) .'</pre>'; // If nothing is shown, change to var_dump().
		// exit();
	?>
	<h1>Go ahead, delete a photo!</h1>
	<?php
		$i=0;
		foreach( $photos['photos']['photo'] as $photo ):
			$i++ ?>
	    	<div class="photobox">
				<h4>Recent Photo #<? echo $i ?></h4>
	        	<a href="<?php echo $base_url . $photo['id']; ?>" title="<?php echo $photo['title']; ?>" target="_blank"><img alt="<?php echo $photo['title']; ?>" src="<?php echo $flickr->buildPhotoURL($photo, 'square'); ?>" /></a>
				<?
					$photoID = $photo['id'];
				?>
				<form action="phpFlickr/deletePhoto.php" method="post">
					<input type="hidden" name="photoid" value="<? echo $photoID; ?>">
					<p><input type="submit" name="delete" value="Delete"></p>
				</form>
	        </div>
	<?php endforeach; ?>
</body>
</html>
