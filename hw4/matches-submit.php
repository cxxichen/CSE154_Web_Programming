<?php 
	include("common.php");
	top();
	$name_search = $_GET["name"];
	
	//find if the user is in the database
	$valid = false;
	$handle = fopen("singles2.txt", "r");
	while (($buffer = fgets($handle)) !== false) {
		if (strpos($buffer, $name_search) !== false) {
			$valid = TRUE;
			break; 
		}      
	}
	fclose($handle);
	if(!$valid){ ?>
	
		<div>
			<p><strong>Error!</strong></p>
			<p>We&#39re sorry. This person is not in the database.</p>
		</div>

	<?php	
		buttom();
		exit();
	} else { ?>

		<h1>Matches for <?= $name_search ?></h1>

	<?php
		$data = file("singles2.txt", FILE_IGNORE_NEW_LINES);
		$info = array();
		foreach($data as $item){
			list($name, $gender, $age, $personality, $os, $min_age, $max_age, $s_gender) = explode(",", $item);
			if($name == $name_search){
				$info = array("name"=>$name, "gender"=>$gender, "age"=>$age, "personality"=>$personality, "os"=>$os, "min_age"=>$min_age, "max_age"=>$max_age, "seek_gender"=>$s_gender);
			}
		}

		foreach($data as $item){
			if( !isset($personality) ) 
				$personality = 'NULL' ;
			list($name, $gender, $age, $personality, $os, $min_age, $max_age, $seek_gender) = explode(",", $item);
			$gender_match = gender($gender, $info["gender"], $seek_gender, $info["seek_gender"]);
			$age_match_1 = age($age, $info["min_age"], $info["max_age"]);
			$age_match_2 = age($info["age"], $min_age, $max_age);
			$os_match = os($os, $info["os"]);
			$personality_match = personality($personality, $info["personality"]);
			$match = $gender_match && $age_match_1 && $age_match_2 && $os_match && $personality_match;

			if($match) { 
				if($name != $info["name"]){ ?>

					<div class="match">
						<p>
							<img src="<?= img_url($name) ?>" alt="<?= $name ?>" />
							<?= $name ?>
						</p>
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
		}
		buttom();
	}

function gender($gender1, $gender2, $seek_gender1, $seek_gender2){
	$match1 = false;
	$match2 = false;
	if($seek_gender1 != 'MF'){
		if($seek_gender1 == $gender2){
			$match1 = true;
		}
	} else {
		$match1 = true;
	}
	if($seek_gender2 != 'MF'){
		if($seek_gender2 == $gender1){
			$match2 = true;
		}
	} else {
		$match2 = true;
	}
	return ($match1 && $match2);
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

function img_url($user){
	$user_name = strtolower(preg_replace("/\s/", "_", $user));	
	$url_remote = "https://webster.cs.washington.edu/images/nerdluv/" . $user_name . ".jpg";
	$url_local = "images/" . $user_name . ".jpg";
	if(file_exists($url_local)){
		return $url_local;
	} else {
		return $url_remote;
	}
} 
?>