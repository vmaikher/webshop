<?php
class Database{
	private static $dbConnection = null;
	private static $object;
	private function __construct(){
		try{
			self::$dbConnection = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
			if (!self::$dbConnection){
			throw new Exception('Unable to connect to host');
			}
		}
		catch (Exception $e){
			echo '<p> Exception was thrown: ',  $e->getMessage(), '</p>';
		}
		mysql_select_db(DB_NAME, self::$dbConnection);
	}
	
	public static function query($query){
		echo "<p>$query</p>";
		if(is_null(self::$dbConnection)){
			self::$object = new self();
		}
		try{
			$results = mysql_query($query);
		if(mysql_error(self::$dbConnection)){
			$error = mysql_error(self::$dbConnection);
			$errorNum = mysql_errno(self::$dbConnection);
			
			throw new Exception("Unable to execute query: {$query}."
								. " Error text: {$error}."
								. " Error details: {$errorNum}");
		}
		}
		catch (Exception $e){
			echo '<p> Exception was thrown: ',  $e->getMessage(), '</p>';
		}
		
		$items = array();
		
		while($row = mysql_fetch_assoc($results)){
			$items[] = $row;
		}
		return $items;
	}
}