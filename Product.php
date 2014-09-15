<?php
class Product extends Record{
	protected $tableName;
	public function __construct(){
		$this->tableName = 'products';
	}
	
	public function getMostCheap(){
		$query = "SELECT name, MIN(price) FROM `products`";
		$items = Database::query($query);
		return $items;
	}
	
	public function getByCategoryId($categoryId){
		$query = "SELECT name FROM `products` WHERE category_fk = $categoryId";
		$query = mysql_real_escape_string($query);
		$items = Database::query($query);
		for($i = 0; $i < count($items); $i++){
			$productsName[] = $items[$i]['name'];
		}
		return $productsName;
	}
	
	public function request(){
		if(!isset($_GET['param2']) || $_GET['param2'] == ''){
			$productsList = $this->getAll();
		}
		elseif(isset($_GET['param2']) && $_GET['param2'] !== ''){
			$product = $_GET['param2'];
			$productsList = $this->findOne(array('url_name'=>$product));
		}
		echo '<table align="center" style="border-collapse: collapse" border= "1px">
				<tr>
					<td><b>Product name</b></td><td><b>Description</b></td><td><b>Price</b></td><td><b>Quantity</b></td>
				</tr>';
		foreach ($productsList as $products){
			echo '<tr">
					<td>' . $products['name'] . '</td>
					<td>' . $products['description'] . '</td>
					<td>' . $products['price'] . '</td>
					<td>' . $products['quantity'] . '</td>
				</tr>';
		}
	}
}