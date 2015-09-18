<?php
include_once("includes/functions.php");
secure_session_start();

if (login_check() == true)
	$logged = 'in';
else
	$logged = 'out';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Almost reasonably secure login</title>
	<script type="text/JavaScript" src="js/sha512.js"></script>
	<script type="text/JavaScript" src="js/forms.js"></script>
</head>
<body>
<form action="includes/authentorizatificationizor0r.php" method="post" name="login_form">
	Email: <input type="text" name="email" />
	Password: <input type="password"
	                 name="password"
	                 id="password"/>
	<input type="button"
	       value="Login"
	       onclick="formhash(this.form, this.form.password);" />
</form>

<?php
if (login_check() == true)
{
	echo '<p>Currently logged ' . $logged . ' as ' . htmlentities($_SESSION['username']) . '.</p>';
	echo '<p>Do you want to change user? <a href="includes/logout.php">Log out</a>.</p>';
}
else
{
	echo '<p>Currently logged ' . $logged . '.</p>';
}
?>
</body>
</html>