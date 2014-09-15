<?php
class Category extends Record{
	public $tableName;
	public function __construct(){
		$this->tableName = 'categories';
	}

	public function request(){
		if(!isset($_GET['param2']) || $_GET['param2'] == ''){
			$categoryList = $this->getAll();
			echo '<table align="center" style="border-collapse: collapse" border= "1px">
				<tr>
				<td><b>Category name</b></td>
				</tr>';
			if(count($categoryList) == 0){
				echo    '<tr>
				<td>Sorry no items</td>
				</tr>';
			}
			else{
				foreach ($categoryList as $category){
					echo '<tr">
							<td><a href="/shop/category/' . $category['url_name'] .'">' . $category['name'] . '</td>
						</tr>';
				}
			}
		}elseif(isset($_GET['param2']) && $_GET['param2'] !== ''){
				$query = "SELECT categories_id FROM categories WHERE url_name = '" . $_GET['param2']. "' LIMIT 1";
//				$query = mysql_real_escape_string($query);
				$result = Database::query($query);
				$product = $result[0]['categories_id'];
				$this->tableName = 'products';
				$productsList = $this->findAll(array('category_fk' => $product));
			
			echo '<table align="center" style="border-collapse: collapse" border= "1px">
				<tr>
				<td><b>Category name</b></td>
				</tr>';
			if(count($productsList) == 0){
				echo    '<tr>
				<td>Sorry no items</td>
				</tr>';
			}
			else{
				foreach ($productsList as $product){
					echo '<tr>
							<td><a href="/shop/product/' . $product['url_name'] . '">' . $product['name'] . '</td>
						</tr>';
				}
			}
		}
	}
}