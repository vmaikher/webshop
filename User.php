<?php
class User extends Record{
	protected $tableName;
	public function __construct(){
		$this->tableName = 'users';
		session_start();
	}
	private function getUserInfo(){
		if(!isset($_SESSION['successfully']) || $_SESSION['successfully'] == 0){
			header("Location: /shop/auth");
			exit();
		}
		if(!isset($_GET['param2']) || $_GET['param2'] == ''){
			exit();
		}
		elseif(isset($_GET['param2']) && $_GET['param2'] !== ''){
			$user = $_GET['param2'];
			$userInfo = $this->findOne(array('url_name'=>$user));
		}
		echo '<a href="/shop/logout">Log out</a>';
		echo '<table align="center" style="border-collapse: collapse" border= "1px">
				<tr>
					<td><b>Login</b></td><td><b>Email</b></td><td><b>First name</b></td><td><b>Last name</b></td><td><b>Date create</b></td>
				</tr>';
		foreach ($userInfo as $user){
			echo '<tr">
					<td>' . $user['login'] . '</td>
					<td>' . $user['email'] . '</td>
					<td>' . $user['first_name'] . '</td>
					<td>' . $user['last_name'] . '</td>
					<td>' . $user['date_create'] . '</td>
				</tr>';
		}
	}
	
	private function authentication(){
		if(!isset($_SESSION['successfully']) || $_SESSION['successfully'] == 0){
			include('form_login.php');
			if(isset($_POST['login']) && isset($_POST['password']) ){
				$login = $_POST['login'];
				$password = $_POST['password'];
				if($login == ''){
					die('login can not be empty');
				}
				$userItems = $this->findOne(array('login' => $login));
				if(count($userItems) < 1){
					die("User $login not registered");
				}
				if($password === $userItems[0]['password']){
					$_SESSION['successfully'] = 1;
					$_SESSION['login'] = $login;
				}else{
					die('Login or password incorrect');
				}
			}
		}
		if($_SESSION['successfully'] == 1){
			$login = $_SESSION['login'];
			header("Location: /shop/profile/$login");
		}
	}
	
	private function registration(){
	
	}
	
	private function logout(){
		session_destroy();
		header("Location: /shop/auth");
	}
	
	public function request(){
		if($_GET['action'] == 'profile'){
			$this->getUserInfo();
		}
		if($_GET['action'] == 'auth'){
			$this->authentication();
		}
		if($_GET['action'] == 'reg'){
			$this->registration();
		}
		if($_GET['action'] == 'logout'){
			$this->logout();
		}
	}
}