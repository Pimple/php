<?php
include_once 'Database.php';

$error_msg = "";

if (isset($_POST['username'], $_POST['email'], $_POST['p']))
{
	$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
	$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
	$email = filter_var($email, FILTER_VALIDATE_EMAIL);

	if (!filter_var($email, FILTER_VALIDATE_EMAIL))
		$error_msg .= '<p class="error">The email address you entered is not valid</p>';

	$password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
	if (strlen($password) != 128)
		$error_msg .= '<p class="error">Invalid password configuration.</p>';

	$database = Database::getInstance();
	$sql = "SELECT id FROM members WHERE email = ? LIMIT 1";
	$connection = $database->prepare($sql);

	if ($connection !== null)
	{
		$connection->execute([$email]);

		if ($connection->rowCount() == 1)
		{
			$error_msg .= '<p class="error">A user with this email address already exists.</p>';
			$connection->close();
		}
		$connection = null;
	}
	else
	{
		$error_msg .= '<p class="error">Database error Line 36</p>';
		$connection = null;
	}

	$sql = "SELECT id FROM members WHERE username = ? LIMIT 1";
	$connection = $database->prepare($sql);

	if ($connection !== null)
	{
		$connection->execute([$username]);

		if ($connection->rowCount() == 1)
		{
			$error_msg .= '<p class="error">A user with this username already exists</p>';
			$connection->close();
		}
		$connection = null;
	}
	else
	{
		$error_msg .= '<p class="error">Database error line 56</p>';
		$connection = null;
	}

	if (empty($error_msg))
	{
		$random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));

		$password = hash('sha512', $password . $random_salt);

		if ($connection = $database->prepare("INSERT INTO members (username, email, password, salt) VALUES (?, ?, ?, ?)"))
			if (!$connection->execute([$username, $email, $password, $random_salt]))
				header('Location: ../error.php?err=Registration failure: INSERT');

		header('Location: ./register_success.php');
	}
}
else
	$error_msg .= "\"This should never happen.\"";