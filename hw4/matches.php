<?php 
	include("common.php");
	top();
?>

	<form action="matches-submit.php" method="get">
		<fieldset>
			<legend>Returning User:</legend>
			<div>
				<strong>Name:</strong>
				<input type="text" size="16" name="name" />
			</div>
			<div>
				<input type="submit" value="View My Matches" />
			</div>
		</fieldset>
	</form>
	
<?php
	buttom();
?>