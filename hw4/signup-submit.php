<?php 
	include("common.php");
	top();
	$name = $_POST["name"];
	$gender = $_POST["gender"];
	$age = $_POST["age"];
	$personality_type = $_POST["personality_type"];
	$os = $_POST["favorite_OS"];
	$min_age = $_POST["min_age"];
	$max_age = $_POST["max_age"];

	file_put_contents("singles.txt",
					  $name . "," . $gender . "," . $age . "," . $personality_type. "," . $os. "," . $min_age . "," . $max_age. "\n",
					  FILE_APPEND);
?>
	<div>
		<p><strong>Thank you!</strong></p>
		<p>Welcome to NerdLuv, Marty Stepp!</p>
		<p>Now <a href="matches.php">log in to see your matches</a></p>
	</div>
	
<?php
	buttom();
?>