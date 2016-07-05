<?php 
	include("common.php");
	top();
	$name_search = $_GET["name"];
?>

	<h1>Matches for <?= $name_search ?></h1>
		<?php
			$data = file("singles.txt");
			$info = array();
			foreach($data as $item){
				list($name, $gender, $age, $personality, $os, $min_age, $max_age) = explode(",", $item);
				if($name == $name_search){
					$info = array("name"=>$name, "gender"=>$gender, "age"=>$age, "personality"=>$personality, "os"=>$os, "min_age"=>$min_age, "max_age"=>$max_age);
				}
			}

			foreach($data as $item){
				if( !isset($personality) ) 
					$personality = 'NULL' ;
				list($name, $gender, $age, $personality, $os, $min_age, $max_age) = explode(",", $item);
				$gender_match = gender($gender, $info["gender"]);
				$age_match_1 = age($age, $info["min_age"], $info["max_age"]);
				$age_match_2 = age($info["age"], $min_age, $max_age);
				$os_match = os($os, $info["os"]);
				$personality_match = personality($personality, $info["personality"]);
				$match = $gender_match && $age_match_1 && $age_match_2 && $os_match && $personality_match;
			
				if($match) { 
		?>
			<div class="match">
				<p><img src="https://webster.cs.washington.edu/images/nerdluv/user.jpg " alt="user" /><?= $name ?></p>
				<ul>
					<li><strong>gender:</strong><?= $gender ?></li>
					<li><strong>age:</strong><?= $age ?></li>
					<li><strong>type:</strong><?= $personality ?></li>
					<li><strong>os:</strong><?= $os ?></li>
				</ul>
			</div>
		<?php
				}
			}

		function gender($gender1, $gender2){
			if($gender1 != $gender2) {
				return true;
			} else {
				return false;
			}
		}

		function age($age, $min_age, $max_age){
			if($age >= $min_age && $age <= $max_age) {
				return true;
			} else {
				return false;
			}
		}

		function os($os1, $os2){
			if($os1 == $os2) {
				return true;
			} else {
				return false;
			}
		}

		function personality($personality1, $personality2){
			if(!empty($personality1)){
				if($personality1[0] != $personality2[0] && $personality1[1] != $personality2[1] 
				   && $personality1[2] != $personality2[2] && $personality1[3] != $personality2[3]) {
					return false;
				} else {
					return true;
				}
			}
		}
	buttom();
?>