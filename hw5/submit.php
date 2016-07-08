<?php
	session_start();
	if(!isset($_SESSION["name"]) || !isset($_SESSION["password"])){
		header("Location: start.php");
		die();
	}

	if(!isset($_POST["action"])){
		$_SESSION["error"] = "Please add or delete something.";
		header("Location: todolist.php");
		die();
	}
	
	$name = $_SESSION["name"];
	$action = $_POST["action"];

	if(isset($action)){
		$filename = "todo_" . $name . ".txt";
		if($action == "add"){
			if(preg_match("/^\s*$/", $_POST["item"])){
				$_SESSION["error"] = "Do not submit a blan to-do list.";
				header("Location: todolist.php");
				die();
			}
			file_put_contents($filename, $_POST["item"] . "\n", FILE_APPEND);
		} else {
			$content = file($filename);
			$index = $_POST["index"];
			if(!preg_match("/\d/", $index) || $content[$index] == null){
				$_SESSION["error"] = "Invalid operation.";
				header("Location: todolist.php");
				die();
			}
			$content[$index] = "";
			file_put_contents($filename, $content);
		}
		header("Location: todolist.php");
	}
?>