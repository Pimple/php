<?php
include_once 'functions.php';

secure_session_start();

if (isset($_POST['email'], $_POST['p']))
{
	$email = $_POST['email'];
	$password = $_POST['p'];

	if (login($email, $password) == true)
		header('Location: ../protected_page.php');
	else
		header('Location: ../index.php?error=1');
}
else
	echo 'Invalid Request';