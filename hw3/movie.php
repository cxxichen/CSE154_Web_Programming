<!DOCTYPE html>
<html lang="en-US">

<?php 
	if(!isset($_GET["film"]) || !is_dir($_GET["film"])){  
	//if movie name is not entered or not found
?>
		<head>
			<title>Page Not Found</title>
			<meta charset="utf-8" />
			<link rel="stylesheet" type="text/css" href="css/movie.css" />
		</head>
		<body>
			<h1>Film not found: foobar.</h1>
			<div id="links">
				<a href="https://webster.cs.washington.edu/validate-html.php"><img class="validator" src="https://webster.cs.washington.edu/images/w3c-html.png" alt="Valid HTML5" /></a><br />
				<a href="https://webster.cs.washington.edu/validate-css.php"><img class="validator" src="https://webster.cs.washington.edu/images/w3c-css.png" alt="Valid CSS" /></a>
			</div>
		</body>
<?php
	} else {
		$movie = $_GET["film"]; 				//movie name
		$info = file("$movie/info.txt");
		$overview = file("$movie/overview.txt");

		$fresh = "fresh";					
		if($info[2] < 60) {
			$fresh = "rotten";
		}

		$reviews = glob("$movie/review*.txt");
		$num = count($reviews);					//number of reveiws
		if(isset($_GET["reviews"])){			//number of screen shown reviews
			$show_review = $_GET["reviews"];
		} else{
			$show_review = $num;
		}
		if($show_review < 0){
			$show_review = 0;
		} elseif($show_review > $num) {
			$show_review = $num;
		}
?>
		<head>
			<title>
				Rancid Tomatoes - <?= $info[0] ?>
			</title>
			<meta charset="utf-8" />
			<link rel="stylesheet" type="text/css" href="css/movie.css" />
			<link href="https://webster.cs.washington.edu/images/<?= $fresh ?>.gif" type="image/gif" rel="shortcut icon" />
		</head>

		<body>
			<div id="banner_top">
				<img src="https://webster.cs.washington.edu/images/rancidbanner.png" alt="Rancid Tomatoes" />
			</div>

			<h1>
				<?= $info[0] ?> (<?= $info[1] ?>)
			</h1>

			<div id="content">
				<div id="rate">
					<img src="https://webster.cs.washington.edu/images/<?= $fresh ?>large.png" alt="Rotten" />
					<span id="score"><?= $info[2] ?>%</span>
				</div>
				
				<div id="right">
					<div>
						<img src="<?= $movie ?>/overview.png" alt="general overview" />
					</div>

					<dl>
						<?php 
							foreach($overview as $item) {
								$introduction = explode(":", $item);
						?>
						<dt><?= $introduction[0] ?></dt>
						<dd><?= $introduction[1] ?></dd>
						<?php
							}
						?>
					</dl>
				</div>

				<div id="left">
					<div>
						<div class="reviews">
							<?php 
								for($i = 0; $i < round($show_review/2); $i++) {
									$left_review = file($reviews[$i]);
							?>
								<p class="review">
									<img src="https://webster.cs.washington.edu/images/<?= strtolower($left_review[1]) ?>.gif" alt="<?= strtolower($left_review[1]) ?>" />
									<q>
										<?= $left_review[0] ?>
									</q>
								</p>
								<p class="reviewer">
									<img src="https://webster.cs.washington.edu/images/critic.gif" alt="Critic" />
									<?= $left_review[2] ?><br />
									<span><?= $left_review[3] ?></span>
								</p>
							<?php 
								}
							?>
						</div>

						<div class="reviews">
							<?php 
								for($i = round($show_review/2); $i < $show_review; $i++) {
									$right_review = file($reviews[$i]);
							?>
								<p class="review">
									<img src="https://webster.cs.washington.edu/images/<?= strtolower($right_review[1]) ?>.gif" alt="<?= strtolower($right_review[1]) ?>" />
									<q>
										<?= $right_review[0] ?>
									</q>
								</p>
								<p class="reviewer">
									<img src="https://webster.cs.washington.edu/images/critic.gif" alt="Critic" />
									<?= $right_review[2] ?><br />
									<span><?= $right_review[3] ?></span>
								</p>
							<?php 
								}
							?>
						</div>
					</div>
										
				</div>
				
				<?php 
					$show_page = "";
					if($show_review <= 0) {
						$show_page = "0";
					} else {
						$show_page = "1-$show_review";
					}
				?>
				<p id="page">(<?= $show_page ?>) of <?= $num ?></p>
				
				<div id="rate">
					<img src="https://webster.cs.washington.edu/images/<?= $fresh ?>large.png" alt="Rotten" />
					<span id="score"><?= $info[2] ?>%</span>
				</div>
			</div>

			<div id="banner_bottom">
				<img src="https://webster.cs.washington.edu/images/rancidbanner.png" alt="Rancid Tomatoes" />
			</div>
			
			<div id="links">
				<a href="https://webster.cs.washington.edu/validate-html.php"><img class="validator" src="https://webster.cs.washington.edu/images/w3c-html.png" alt="Valid HTML5" /></a><br />
				<a href="https://webster.cs.washington.edu/validate-css.php"><img class="validator" src="https://webster.cs.washington.edu/images/w3c-css.png" alt="Valid CSS" /></a>
			</div>
		</body>
	<?php 
		}
	?>
</html>
