<?php
	require_once("../../mainfile.php");
	
	ob_start(); 
	
	// Das header
	require_once("header.php");
	
	spl_autoload_register("autoload_oauth");
	
	if(isset($_REQUEST['oauth_token'])){
		$request_token = Token::findByToken($_REQUEST['oauth_token']);
		if(is_object($request_token)&&$request_token->isRequest()){
			
			$user = OAuthUser::exist($User->username);
			if (is_object($user)) {
				$request_token->setVerifier(Provider::generateVerifier());
				$request_token->setUser($user);
				
				$url = $request_token->getCallback()."?&oauth_token=".$_REQUEST['oauth_token']."&oauth_verifier=".$request_token->getVerifier();
				
				if (headers_sent()) {
					echo '<meta http-equiv="refresh" content="0;URL='.$url.'" />';
				} else {
					header("location: ".$url);
				} 
				
				die;
			} else {
				echo "User not found !";
			}
		} else {
			echo "The specified token does not exist";
		}
	} else {
		echo "Please specify a oauth_token";
	}
	
	ob_end_flush(); 
	require_once("footer.php");
?>