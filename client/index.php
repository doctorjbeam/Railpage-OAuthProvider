<?php
	require_once("../../mainfile.php"); 
	require_once("header.php");
	
	$oauth_client = new Oauth(API_PROVIDER_KEY, API_PROVIDER_SECRET);
	$oauth_client->enableDebug();
	try {
		$info = $oauth_client->getRequestToken("http://cesium.railpage.org/oauth/oauth/request_token?oauth_callback=http://cesium.railpage.org/oauth/client/callback.php");
		
		#$User->oauth_key = $info['oauth_token'];
		echo "<h1>We have a request token !</h1>";
		echo "<strong>Request token</strong> : ".$info['oauth_token']."<br />";
		echo "<strong>Request token secret</strong> : ".$info['oauth_token_secret']."<br />";
		echo "to authenticate go <a href=\"".$info['authentification_url']."?oauth_token=".$info['oauth_token']."\">here</a>";
	} catch(OAuthException $E){
		echo "<pre>".print_r($E->debugInfo, true)."</pre>";
	}
	
	require_once("footer.php");
?>
