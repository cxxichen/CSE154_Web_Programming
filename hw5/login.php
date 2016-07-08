<?php
	$name = $_POST["name"];
	$password = $_POST["password"];
	
	if(empty($name) || empty($password)) {
		header("Location: start.php");
		die();
	} else {
		if(preg_match("/$name/", $password)){
			session_start();
			$_SESSION["error"] = "The password cannot contain the username.";
			header("Location: start.php");
			die();	
		}
		date_default_timezone_set("America/New_York");
		setcookie("time", date("D y M d, g:i:s a"), time()+60*60*24*7);
		if(!file_exists("user.txt")) {
			#if the user.txt file does not exist, create it in the folder
			$data = fopen("user.txt", "wb");
			chmod("user.txt", 0777);
		} else {
			#if the user.txt already exists, oepen it
			$data = file("user.txt", FILE_IGNORE_NEW_LINES);
		}
		$user = array();
		$user_find = false;
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
				session_start();
				$_SESSION["error"] = "The password is uncorrect.";
				header("Location: start.php");
				die();
			}
		} else {
			#if the user name is not in the list, check whether the user name and password is valid
			if((preg_match("/^[a-z][a-z0-9]{2,7}$/", $name)) && (preg_match("/^[0-9].{5,10}\W$/", $password))){
				file_put_contents("user.txt", $name . ":" . $password . "\n", FILE_APPEND);
			} elseif(!preg_match("/^[a-z][a-z0-9]{2,7}$/", $name)) {
				session_start();
				$_SESSION["error"] = "The username is invalid.";
				header("Location: start.php");
				die();
			} else {
				session_start();
				$_SESSION["error"] = "The password is invalid.";
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