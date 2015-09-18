<?php
ini_set("error_reporting", E_ALL);
include_once 'includes/functions.php';
sec_session_start();

$randomuser = null;

if (!isset($_GET['id']))
	$id = 0;
else
{
	$id = (int) $_GET['id'];
	if ($id != $_GET['id'])
		$id = 0;
	$connection = Database::getInstance()->prepare("select * from randomusers where id = ?");
	$connection->execute([$id]);
	$randomuser = $connection->fetch();
	// var_dump($randomuser);
}

if (isset($_POST['save']))
{
	var_dump($_POST['save']);
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Secure Login: Protected Page</title>
	<link rel="stylesheet" href="styles/bootstrap.css">
	<link rel="stylesheet" href="styles/bootstrap-theme.css">
	<link rel="stylesheet" href="styles/main.css">
</head>
<body>
<?php if (login_check() == true) : ?>
	<?php include_once("includes/navbar.php"); ?>

	<div class="container-fluid">

		<img style="float: right; margin-right: 10px" src="<?php echo $randomuser['mediumpic'] ?>">
		<h2>
			<?php echo $randomuser['username'] ?>
		</h2>
		<hr>
		<form class=".col-xs-12 .col-md-8" action="<?php $_SERVER['self'] ?>">
			<div class="col-md-5">
				<label class="col-md-4" for="firstname">First name</label>
				<input class="col-md-8" type="text" name="firstname" id="firstname" value="<?php echo $randomuser['firstname'] ?>">
			</div>
			<div class="col-md-5">
				<label class="col-md-4" for="lastname">Last name</label>
				<input class="col-md-8" type="text" name="lastname" id="lastname" value="<?php echo $randomuser['lastname'] ?>">
			</div>
			<br><br><br>
			<div class="col-md-5">
				<label class="col-md-4" for="email">Email</label>
				<input class="col-md-8" type="email" id="email" name="email" value="<?php echo $randomuser['email'] ?>">
			</div>
			<br><br><br>
			<div class="col-md-5">
				<label class="col-md-4" for="phone">Phone</label>
				<input class="col-md-8" type="text" id="phone" name="phone" value="<?php echo $randomuser['phone'] ?>">
			</div>
			<div class="col-md-5">
				<label class="col-md-4" for="cell">Cell</label>
				<input class="col-md-8" type="text" id="cell" name="cell" value="<?php echo $randomuser['cell'] ?>">
			</div>
			<br><hr>
			<div class="col-md-5">
				<label class="col-md-4" for="password">Password</label>
				<input class="col-md-8" type="password" contenteditable="false" id="password" name="password">
			</div>
			<br><hr>
			<div class="col-md-4 col-md-offset-4">
				<button type="button" class="btn btn-lg btn-primary">Update user</button>
				<button type="button" class="btn btn-lg btn-danger">Delete user</button>
			</div>
		</form>
	</div>
<?php else : ?>
	<p>
		<span class="error">You are not authorized to access this page.</span>Please <a href="index.php">login</a>.
	</p>
<?php endif; ?>


<script src="scripts/jquery-1.11.3.js"></script>
<script src="scripts/bootstrap.min.js"></script>
</body>
</html>