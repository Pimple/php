<?php
include_once("Database.php");
// include_once("psl-config.php");

function sec_session_start()
{
	$session_name = 'sec_session_id';
	$secure = SECURE;

	$httponly = true;

	if (ini_set('session.use_only_cookies', 1) === FALSE) {
		header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
		exit();
	}

	$cookieParams = session_get_cookie_params();
	session_set_cookie_params($cookieParams["lifetime"],
		$cookieParams["path"],
		$cookieParams["domain"],
		$secure,
		$httponly);

	session_name($session_name);
	session_start();
	session_regenerate_id(true);
}

function login($email, $password)
{
	$database = Database::getInstance();
	if ($connection = $database->prepare("SELECT id, username, password, salt FROM members WHERE email = ? LIMIT 1"))
	{
		$connection->execute([$email]);
		$result = $connection->fetch();

		$userId = $result["id"];
		$username = $result["username"];
		$db_password = $result["password"];
		$salt = $result["salt"];

		$password = hash('sha512', $password . $salt);

		if ($connection->rowCount() == 1)
		{
			if (checkbrute($userId, $database) == true)
				return false;
			else
			{
				if ($db_password == $password)
				{
					$user_browser = $_SERVER['HTTP_USER_AGENT'];

					// XSS protection as we might print this value
					$user_id = preg_replace("/[^0-9]+/", "", $userId);
					$_SESSION['user_id'] = $user_id;

					// XSS protection as we might print this value
					$username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username);
					$_SESSION['username'] = $username;
					$_SESSION['login_string'] = hash('sha512', $password . $user_browser);

					return true;
				}
				else
				{
					$now = time();
					$database->query("INSERT INTO login_attempts(user_id, time) VALUES ('$userId', '$now')");
					return false;
				}
			}
		}
		else
		{
			// No user exists.
			return false;
		}
	}
}

function checkbrute($user_id)
{
	$database = Database::getInstance();

	$now = time();

	$valid_attempts = $now - (2 * 60 * 60);

	if ($connection = $database->
		prepare("SELECT time FROM login_attempts WHERE user_id = ? AND time > '$valid_attempts'"))
	{
		$connection->execute([$user_id]);

		if ($connection->rowCount() > 5)
			return true;
		else
			return false;
	}
}

function login_check()
{
	$database = Database::getInstance();

	// Check if all session variables are set
	if (isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string']))
	{

		$userId = $_SESSION['user_id'];
		$login_string = $_SESSION['login_string'];
		$username = $_SESSION['username'];

		$user_browser = $_SERVER['HTTP_USER_AGENT'];

		if ($connection = $database->prepare("SELECT password FROM members WHERE id = ? LIMIT 1"))
		{
			$connection->execute([$userId]);

			if ($connection->rowCount() == 1)
			{
				$result = $connection->fetch();

				$password = $result["password"];

				$login_check = hash('sha512', $password . $user_browser);

				if ($login_check == $login_string)
					return true;
				else
					return false;
			}
			else
				return false;
		}
		else
			return false;
	}
	else
		return false;
}

function esc_url($url)
{
	if ('' == $url)
		return $url;

	$url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);

	$strip = array('%0d', '%0a', '%0D', '%0A');
	$url = (string) $url;

	$count = 1;
	while ($count)
		$url = str_replace($strip, '', $url, $count);

	$url = str_replace(';//', '://', $url);

	$url = htmlentities($url);

	$url = str_replace('&amp;', '&#038;', $url);
	$url = str_replace("'", '&#039;', $url);

	if ($url[0] !== '/')
		return '';
	else
		return $url;
}

function fetchRandomUsers($n)
{
	$user = file_get_contents("http://api.randomuser.me/?results=" . $n); // &format=json
	$list = json_decode($user, true);

	$database = Database::getInstance();

	foreach($list['results'] as $user)
	{
		$firstName = $user['user']['name']['first'];
		$lastName = $user['user']['name']['last'];
		$username = $user['user']['username'];
		$password = $user['user']['password'];
		$salt = $user['user']['salt'];
		$passwordHash = $user['user']['sha256'];
		$gender = $user['user']['gender'];
		$email = $user['user']['email'];
		$phone = $user['user']['phone'];
		$cell = $user['user']['cell'];
		$thumbnail = $user['user']['picture']['thumbnail'];
		$largePicture = $user['user']['picture']['large'];
		$mediumPicture = $user['user']['picture']['medium'];

		$sql = "INSERT INTO
				randomusers
			SET
				firstname = ?,
				lastname = ?,
				username = ?,
				password = ?,
				salt = ?,
				hash = ?,
				gender = ?,
				email = ?,
				phone = ?,
				cell = ?,
				thumbnail = ?,
				largepic = ?,
				mediumpic = ?;";

		$connection = $database->prepare($sql);
		$connection->execute([$firstName, $lastName, $username, $password, $salt, $passwordHash, $gender, $email,
			$phone, $cell, $thumbnail, $largePicture, $mediumPicture]);
		// echo $username . " added.<br>";
	}
}