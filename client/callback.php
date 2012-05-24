<?php
	require_once("../../mainfile.php");
	
	ob_start(); 
	
	// Das header
	require_once("header.php");
	
	spl_autoload_register("autoload_oauth");
	
	if (isset($_REQUEST['oauth_token']) && isset($_REQUEST['oauth_verifier'])) {
		if (isset($_POST['oauth_token'])) {
			try {
				$oauth_client = new Oauth(API_PROVIDER_KEY, API_PROVIDER_SECRET);
				$oauth_client->enableDebug();
				$oauth_client->setToken($_POST['oauth_token'], $_POST['oauth_token_secret']);
				$info = $oauth_client->getAccessToken("http://cesium.railpage.org/oauth/oauth/access_token", NULL, $_POST['oauth_verifier']);
				echo "<h1>Congrats !</h1>";
				echo "<strong>AccessToken</strong> ".$info['oauth_token']."<br />";
				echo "<strong>AccessToken Secret</strong> ".$info['oauth_token_secret'];
				echo "<a href=\"apicall.php?token=".$info['oauth_token']."&token_secret=".$info['oauth_token_secret']."\">get your user id with an api call</a>";
			} catch (OAuthException $E) {
				echo printArray($E->debugInfo);
			}
		} else {
		?>
			<form method="post" action="callback.php">
				<label>token</label>
				<input type="text" name="oauth_token" value="<?=$_REQUEST['oauth_token'];?>" /><br />
				<label>secret</label>
				<input type="text" name="oauth_token_secret" value="" />
				<span>This is not passed by url, a real client would have stored this somewhere, you can get it from the db</span>
				<br />
				<label>verifier</label>
				<input type="text" name="oauth_verifier" value="<?=$_REQUEST['oauth_verifier']?>" />
				<input type="submit" value="OK">
			</form>
		<?php
		}
	}
	
	ob_end_flush(); 
	require_once("footer.php");
?>