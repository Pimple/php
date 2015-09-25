<?php
include_once 'functions.php';

secure_session_start();

if (isset($_POST['email'], $_POST['p']))
{
	$email = $_POST['email'];
	$password = $_POST['p'];
	$encrypted = hash("sha512", $password . SALT);

	if (login($email, $password) == true)
		header("Location: ../protected_page.php?encrypted={$encrypted}");
	else
		header("Location: ../index.php?error=1&email={$email}&password={$password}");
}
else
{
	echo 'Invalid Request';
	var_dump($_POST);

}