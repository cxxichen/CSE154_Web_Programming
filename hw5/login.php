<?php
	$name = $_POST["name"];
	$password = $_POST["password"];
	
	if(empty($name) || empty($password)) {
		header("Location: start.php");
		die();
	} else {
		setcookie("time", date("D y M d, g:i:s a"), time()+60*60*24*7);
		$user = array();
		$user_find = false;
		$data = file("user.txt", FILE_IGNORE_NEW_LINES);
		foreach($data as $value) {
			$user_info = explode(":", $value);
			#check if the user name is in the list
			if($user_info[0] == $name) {
				$user = array("name"=>$user_info[0], "password"=>$user_info[1]);
				$user_find = true;
				break;
			}
		}
		if($user_find) {
			#if the user name is in the list but the password is not correct
			if($user["password"] != $password){
				header("Location: start.php");
				die();
			}
		} else {
			#if the user name is not in the list, check whether the user name and password is valid
			if((preg_match("/^[a-z][a-z0-9]{2,7}$/", $name)) && (preg_match("/^[0-9].{5,10}\W$/", $password))){
				file_put_contents("user.txt", $name . ":" . $password . "\n", FILE_APPEND);
			} else {
				header("Location: start.php");
				die();
			}
		}
	}
	session_start();
	$_SESSION["name"] = $name;
	$_SESSION["password"] = $password;
	header("Location: todolist.php");
?>
	