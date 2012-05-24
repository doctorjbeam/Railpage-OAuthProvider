<?php
	require(dirname(__FILE__)."/../interfaces/IUser.php");
	
	class OAuthUser implements IUser {
		
		private $id;
		private $login;
		private $pdo;
		
		/* bogus function to mimic authentification */
		public static function exist($login) {
			$pdo = Db::singleton();
			$check = $pdo->query("select user_id from nuke_users where username = '".$login."'");
			if ($check->rowCount() == 1) {
				$check = $check->fetch();
				return new OAuthUser($check['user_id']);
			} else {
				return null;
			}
		}
		
		public function __construct($id = 0) {
			$this->pdo = Db::singleton();
			if ($id != 0) {
				$this->id = $id;
				$this->load();
			}
		}
		
		private function load() {
			$info = $this->pdo->query("select * from nuke_users where user_id = ".$this->id)->fetch();
			$this->login 	= $info['username'];
			$this->id 		= $info['user_id'];
		}

		public function getId() {
			return $this->id;
		}
		
		public function getLogin() {
			return $this->login;
		}
	}
?>