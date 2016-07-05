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
	
	//form validation
	$error = false;
	if(empty($name)){
		$error = true;
	}

	if($gender != 'M' && $gender != 'F'){
		$error = true;
	}

	if($age < 0 || $age > 99){
		$error = true;
	}

	if($os != 'Windows' && $os != 'Mac OS' && $os != 'Linux'){
		$error = true;
	}

	if(($min_age < 0) || ($min_age > 99) || ($max_age < 0) || ($max_age > 99) || ($min_age > $max_age)){
		$error = true;
	}

	#seeking gender check
	#	to do
	#
	#

	if(strlen($personality_type) != 4 ||
	  		($personality_type[0] != 'I' && $personality_type[0] != 'E') ||
	  		($personality_type[1] != 'N' && $personality_type[1] != 'S') ||
	  		($personality_type[2] != 'F' && $personality_type[2] != 'T') ||
	  		($personality_type[3] != 'J' && $personality_type[3] != 'P')) {
		$error = true;
	}

	if($error){ ?>

		<div>
			<p><strong>Error! Invalid data.</strong></p>
			<p>We&#39re sorry. You submitted invalid user information. Please go back and try again.</p>
		</div>

	<?php
		buttom();
		exit();
	}

	//check whether the person has already in the file
	$resubmit_error = false;
	$data = file("singles.txt");
	foreach($data as $item){
		$user_info = explode(",", $item);
		if($user_info[0] == $name){
			$resubmit_error = true;
		}
	}
	
	if($resubmit_error){ ?>

		<div>
			<p><strong>Error!</strong></p>
			<p>We&#39re sorry. You have already submitted your information.</p>
		</div>
	
	<?php
		buttom();
		exit();
	} else {
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
	}?>