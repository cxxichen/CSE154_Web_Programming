<!DOCTYPE html>
<html lang="en-US">
<head>
	<title>NerdLuv</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="nerdluv.css" />
	<link rel="icon" type="image/gif" href="https://webster.cs.washington.edu/images/nerdluv/heart.gif" />
</head>

<body>
	<div id="bannerarea">
		<img src="https://webster.cs.washington.edu/images/nerdluv/nerdluv.png" alt="banner logo" /> <br />
		where meek geeks meet
	</div>
	
	<form action="signup-submit.php">
		<fieldset>
			<legend>New User Signyp:</legend>
			<div>
				<strong>Name:</strong>
				<input type="text" name="name" size="16" />
			</div>
			<div>
				<strong>Gender:</strong>
				<label><input type="radio" name="gender" value="Male" />Male</label>
				<label><input type="radio" name="gender" value="Female" checked="checked" />Female</label>
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
</body>
</html>