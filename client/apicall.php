<?php
	require_once("../../mainfile.php");
	
	ob_start(); 
	
	// Das header
	require_once("header.php");
	
	spl_autoload_register("autoload_oauth");

	if (isset($_POST['token'])) {
		try {
			$oauth_client = new Oauth(API_PROVIDER_KEY, API_PROVIDER_SECRET);
			$oauth_client->enableDebug();
			$oauth_client->setToken($_POST['token'],$_POST['token_secret']);
			$oauth_client->fetch("http://cesium.railpage.org/oauth/oauth/api/user");
			echo "API RESULT : ".$oauth_client->getLastResponse();
		} catch (OAuthException $E) {
			printArray($E->debugInfo, true);
		}
	} else {
		?>
	<form method="post">
		Access token : <input type="text" name="token" value="<?=$_REQUEST['token'];?>" /> <br />
		Access token secret : <input type="text" name="token_secret" value="<?=$_REQUEST['token_secret'];?>" /> <br />
		<input type="submit" value="do An api call" />
	</form>
	<? }  
	
	ob_end_flush(); 
	require_once("footer.php");
?>