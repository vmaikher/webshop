<?php
abstract class Record{
	protected $tableName;
	protected $items;
	
	public function __construct(){
	}
	
	public function getAll(){
		$query = "SELECT * FROM $this->tableName";
		$items = Database::query($query);
		return $items;
	}
	
	public function findAll(array $params){
		$query = "SELECT * FROM $this->tableName WHERE ";
		$end = end($params);
		reset($params);
		
		foreach($params as $key => $value){
			$query.= "$key=$value";
			if($value !== $end){
				$query.= ' AND ';
			}
		}
		$query = mysql_real_escape_string($query);
		$this->items = Database::query($query);
		return $this->items;
	}
	
	public function findOne(array $params){
		$query = "SELECT * FROM $this->tableName WHERE ";
		$end = end($params);
		reset($params);
		
		foreach($params as $key => $value){
			$query.= "$key = '$value'";
			if($value !== $end){
				$query.= ' AND ';
			}
		}
		$query .= ' LIMIT 1';
		echo $query;
		//$query = mysql_real_escape_string($query);
		$this->items = Database::query($query);
		
		return $this->items;
	}
	
	public function __get($name){

		$fields = array_keys($this->items[0]);
		if(!in_array($name, $fields)){
			throw new Exception("Field $name not exist");
		}
		$field = $this->items[0][$name];
		
		return $field;
	}
}