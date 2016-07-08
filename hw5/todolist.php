<?php
	include("common.php");
	top();

	session_start();
	if(!isset($_SESSION["name"]) || !isset($_SESSION["password"])){
		header("Location: start.php");
		die();
	}

	$name = $_SESSION["name"];
	$password = $_SESSION["password"];
	$time = $_COOKIE["time"];
?>

	<div id="main">
		<h2><?= $name ?>'s To-Do List</h2>

		<ul id="todolist">
			<?php 
				$filename =  "todo_" . $name . ".txt";
				if(!file_exists($filename)) {
					$list = fopen($filename, "wb");
					chmod($filename, 0777);
				} else {
					$list = file($filename, FILE_IGNORE_NEW_LINES); 
					for($i = 0; $i < count($list); $i++) { 
			?>
			
						<li>
							<form action="submit.php" method="post">
								<input type="hidden" name="action" value="delete" />
								<input type="hidden" name="index" value="<?= $i ?>" />
								<input type="submit" value="Delete" />
							</form>
							<?= htmlspecialchars($list[$i]) ?>
						</li>	
			
			<?php
					} 
				}
			
				if(isset($_SESSION["error"])){
			?>
				<p id="error">
					<?= $_SESSION["error"] ?>
				</p>
			<?php
				unset($_SESSION["error"]);
				}
			?>
			
			<li>
				<form action="submit.php" method="post">
					<input type="hidden" name="action" value="add" />
					<input name="item" type="text" size="25" autofocus="autofocus" />
					<input type="submit" value="Add" />
				</form>
			</li>
		</ul>

		<div>
			<a href="logout.php"><strong>Log Out</strong></a>
			<em>(logged in since <?= $time ?>)</em>
		</div>

	</div>

<?php
	buttom();
?>