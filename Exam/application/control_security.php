<?php

// developer
define("USERNAME", "developer");
// unlock
define("PASSWORD", "3dd8260cc78551cdaa062bdf144723e9abe7514ba41482af330582d024829f7b7420ac08b6a87f07c81f7f7b4a95c0b151a867f9fa9a2e37b69b9aaa94e6ada2");
// gibberish
define("SALT", "_I^_8@IfasH1)D7qH03J9kuwQY7b#AZt%@gvw#3U#dk8@O3*AuFWIqwgpLnZC1vN");

function secure_session_start()
{
	$session_name = 'secure_session_id';
	$secure = false;
	$httponly = true;

	if (ini_set('session.use_only_cookies', 1) === FALSE)
	{
		// header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
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
	session_regenerate_id(true); // http://php.net/manual/en/function.session-regenerate-id.php
}

/**
 * Logs in user
 *
 * @param $username
 * @param $password
 * @return bool
 */
function login($username, $password)
{
	$realPassword = hash('sha512', PASSWORD . SALT);
	$passwordEntered = hash('sha512', $password . SALT);

//	echo $realPassword . "<br>" . hash("sha512", PASSWORD . SALT) . "<br><br>";
//	echo $passwordEntered . "<br>" . hash("sha512", $password . SALT) . "<br><br>";
//	echo $username . "<br>";
//	echo USERNAME . "<br><br>";
//	echo $password . "<br>";
//	echo PASSWORD;
//
//	echo $username == USERNAME ? "Username equal" : "Username NOT equal";
//	echo hash_equals($passwordEntered, $realPassword) ? "Password equal" : "Password NOT equal";
//	echo strcmp($username, USERNAME) . " - " . (hash_equals($passwordEntered, $realPassword) ? "true" : "false");

	if (strcmp($username, USERNAME) == 0 and hash_equals($passwordEntered, $realPassword))
	{
		$user_browser = $_SERVER["HTTP_USER_AGENT"];

		$_SESSION["username"] = $username;
		$_SESSION["login_string"] = hash('sha512', $realPassword . $user_browser);

		return true;
	}
	else
		return false;
}

/**
 * Checks if user is logged in
 *
 * @return bool
 */
function login_check()
{
	if(!isset($_SESSION["username"], $_SESSION["login_string"]))
		return false;

	$login_string = $_SESSION["login_string"];
	$username = $_SESSION["username"];

	$user_browser = $_SERVER["HTTP_USER_AGENT"];

	if (strcmp($username, USERNAME) == 0)
	{
		$password = hash("sha512", PASSWORD . SALT);
		$login_check = hash('sha512', $password . $user_browser);

		return hash_equals($login_check, $login_string);
	}
	else
	{
		echo "Session username does not match admin username. This shouldn't happen. Like, ever. Why am I writing this?";
		return false;
	}
	return false;
}

/**
 * @param $redirect_to
 */
function logout($redirect_to)
{
	session_unset();

	$params = session_get_cookie_params();

	setcookie(session_name(),
		'', time() - 42000,
		$params["path"],
		$params["domain"],
		$params["secure"],
		$params["httponly"]);

	session_destroy();
	header("Location: $redirect_to");
}