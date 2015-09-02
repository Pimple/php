<?php
var_dump($_POST);
require_once('User.php');
if (isset($_POST['login']))
{
	echo 'asdfasdf';
	$user = new User($_POST['username'], $_POST['password']);
	if ($user->validated)
	{
		session_start();
		$_SESSION['user'] = $user;
		header('Location:frontpage.php');
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>HerpDerp</title>
</head>
<body>

<form name="loginForm" action="index.php" method="post">

	<label for="username">Username: </label>
	<input type="text" name="username" value="<?php if (isset($user)) echo $user->getUserName();?>" /><br>
	<label for="password">Password: </label>
	<input type="password" name="password" /><br>
	<button name="login">
		Log in
	</button>
</form>

</body>
</html>