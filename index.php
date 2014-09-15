<?php
require_once('config.php');
require_once('Database.php');
require_once('Record.php');
require_once('Product.php');
require_once('Category.php');
require_once('User.php');
print_r($_GET);
echo '<a href="/shop">Main page</a><br/>';
echo '<a href="/shop/auth">Log In</a><br/>';

if($_GET['action'] == 'product'){
		$controller = new Product();
	}
	
elseif($_GET['action'] == 'profile' || $_GET['action'] == 'auth' || $_GET['action'] == 'reg' || $_GET['action'] == 'logout'){
		$controller = new User();
	}
	
else{
	$controller = new Category();
}

$controller->request();