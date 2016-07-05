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

	$info_input = [$name, $gender, $age, $personality_type, $os, $min_age, $max_age];
	
	//checked the input data is valid
	$name_error = ($name == '');
	$gender_error = ($gender != 'M' && $gender != 'F');
	$age_error = ($age < 0 || $age > 99);
	$os_error = ($os != 'Windows' && $os != 'Mac OS' && $os != 'Linux');
	$min_max_error = ($min_age < 0 || $min_age > 100 || $max_age < 0 || $max_age > 100);
	$gender_check_error = ($gender == '');
	$type_error = (($personality_type[0] != 'I' && $personality_type[0] != 'E')
				  ||($personality_type[1] != 'N' && $personality_type[1] != 'S')
				  ||($personality_type[2] != 'F' && $personality_type[2] != 'T')
				  ||($personality_type[3] != 'J' && $personality_type[3] != 'P'));
	if($name_error || $gender_error || $age_error || $os_error || $min_max_error || $gender_check_error || $type_error) { ?>

		<div>
			<p><strong>Error! Invalid data.</strong></p>
			<p>We&#39re sorry. You submitted invalid user information. Please go back and try again.</p>
		</div>

	<?php
		buttom();
		exit();
	} 
	
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