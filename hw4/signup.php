<?php
	include("common.php");
	top();
?>
	<form action="signup-submit.php" method="post">
		<fieldset>
			<legend>New User Signup:</legend>
			<div>
				<strong>Name:</strong>
				<input type="text" name="name" size="16" />
			</div>
			<div>
				<strong>Gender:</strong>
				<label><input type="radio" name="gender" value="M" />Male</label>
				<label><input type="radio" name="gender" value="F" checked="checked" />Female</label>
			</div>
			<div>
				<strong>Age:</strong>
				<input type="text" name="age" size="6" maxlength="2" />
			</div>
			<div>
				<strong>Personality type:</strong>
				<input type="text" name="personality_type" size="6" maxlength="4" />
				(<a href="http://www.humanmetrics.com/cgi-win/JTypes2.asp">Don't know your type?</a>)
			</div>
			<div>
				<strong>Favorite OS:</strong>
				<select name="favorite_OS">
					<option selected="selected">Windows</option>
					<option>Mac OS</option>
					<option>Linux</option>
				</select>
			</div>
			<div>
				<strong>Seeking age:</strong>
				<input type="text" size="6" name="min_age" maxlength="2" placeholder="min" />
				to
				<input type="text" size="6" name="max_age" maxlength="2" placeholder="max" />
			</div>
			<div>
				<input type="submit" value="Sign Up" />
			</div>
		</fieldset>
	</form>
	
<?php 
	buttom();
?>