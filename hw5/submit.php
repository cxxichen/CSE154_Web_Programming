<?php
	session_start();
	if(!isset($_SESSION["name"]) || !isset($_SESSION["password"])){
		header("Location: start.php");
		die();
	}

	$name = $_SESSION["name"];
	$action = $_POST["action"];
	echo $name;
	if(isset($action)){
		$filename = "todo_" . $name . ".txt";
		if($action == "add"){
			file_put_contents($filename, $_POST["item"] . "\n", FILE_APPEND);
		} else {
			$content = file($filename);
			$index = $_POST["index"];
			$content[$index] = "";
			file_put_contents($filename, $content);
		}
		header("Location: todolist.php");
	}
?>