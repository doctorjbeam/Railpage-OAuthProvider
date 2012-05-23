<?php
/* this is nothing else but a PDO wrapper */
class Db {
	
	private $pdoInstance;
   
    private static $instance;
	
	private $dbhost	= "cerium.railpage.org";
	private $dbname	= "sparta";
	private $dbuser	= "rpuser";
	private $dbpass = "choochoo";
 
    private function __construct() {
		$this->pdoInstance = new PDO("mysql:host=".$this->dbhost.";dbname=".$this->dbname, $this->dbuser, $this->dbpass);
        $this->pdoInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        $this->pdoInstance->exec("set names 'utf8'");
	}
   
    private function __clone() {}
   
    public static function singleton() {
		
		if (!isset(self::$instance)) {
        		$c = __CLASS__;
        		self::$instance = new $c;
		}
		
		return self::$instance;
    
    }
    
    /* pdo functions */
    
    public function quote($str){
		return $this->pdoInstance->quote($str);
	}
	
	public function lastInsertId(){
		return $this->pdoInstance->lastInsertId();
	}
	
	public function query($str){
		try {
			return $this->pdoInstance->query($str);
		} catch (PDOException $e) {
			echo "Error : <br />".$str."<br />". $e->getMessage() . "<br />".$e->getTraceAsString();
			exit;
		}
	}
	
	public function exec($str){
		try {
			return $this->pdoInstance->exec($str);
		} catch (PDOException $e) {
			echo "Error : <br />".$str."<br />". $e->getMessage() . "<br />".$e->getTraceAsString();
			exit;
		}
	}
   
}
?>
