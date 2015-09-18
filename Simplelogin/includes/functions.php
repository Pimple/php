<?php

include_once("config.php");

/**
 * Funktionen sec_session_start gør lidt mere end bare at skrive session_start(), som ellers er den funktion man
 * i PHP bruger til det. Se kommentarerne nedenfor for årsager til denne udvidede funktion.
 */
function secure_session_start()
{
	$session_name = 'secure_session_id';
	$secure = SECURE;
	$httponly = HTTPONLY;

	if (ini_set('session.use_only_cookies', 1) === FALSE)
	{
		header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
		// TODO erstat med ... noget? Hvad end der skal ske hvis ikke cookies er slået til.
		exit();
	}

	/**
	 * Her henter vi de nuværende cookie parametre, så vi kan køre funktionen til at opdatere dem uden at ændre på
	 * de tre første parametre, lifetime, path og domain. De to sidste sættes til at det skal være secure og kun
	 * kan tilgåes via HTTP protokollen.
	 *
	 * Se mere her: http://php.net/manual/en/function.session-set-cookie-params.php
	 */
	$cookieParams = session_get_cookie_params();
	var_dump($cookieParams);
	session_set_cookie_params($cookieParams["lifetime"],
		$cookieParams["path"],
		$cookieParams["domain"],
		$secure,
		$httponly);

	// Og endelig starter vi en session.
	session_name($session_name);
	session_start();
	session_regenerate_id(true); // http://php.net/manual/en/function.session-regenerate-id.php
}

/**
 * Logger brugeren ind.
 *
 * @param $username
 * @param $password
 * @return bool
 */
function login($username, $password)
{
	$realPassword = hash('sha512', PASSWORD . SALT);
	$passwordEntered = hash('sha512', $password . SALT);

	if ($username == USERNAME && $passwordEntered == $realPassword)
	{
		$user_browser = $_SERVER['HTTP_USER_AGENT'];

		/**
		 * XSS beskyttelse i tilfælde af at $_SESSION['username'] skal printes noget sted.
		 * Forstår det ikke helt, og hvis ikke $_SESSION['username'] printes noget sted er det ligegyldigt.
		 *
		 * Se mere: https://en.wikipedia.org/wiki/Cross-site_scripting
		 */
		$username = preg_replace("/[^0-9]+/", "", $username);
		$username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username);

		/**
		 * Her sættes session variablerne som bruges til at genkende at brugeren er logget ind.
		 */
		$_SESSION['username'] = $username;
		$_SESSION['login_string'] = hash('sha512', $realPassword . $user_browser);

		return true;
	}
	else
	{
		/**
		 * Her kunne man vælge at gemme tid og brugernavn for hver forsøgte login, og så ovenfor tjekke om
		 * denne bruger har forsøgt at logge ind flere gange end er tilladt indenfor et stykke tid. Det ville
		 * gøre at koden ikke kan knækkes vha. brute force, altså hvor man laver et script som forsøger sig
		 * med et password efter et andet indtil det får det rigtigt.
		 *
		 * Hvis man altså gad.
		 */
		return false;
	}
}

/**
 * Tjekker om brugeren er logget ind.
 *
 * @return bool
 */
function login_check()
{
	/**
	 * Hvis brugeren er logget ind bør session variablerne 'username' og 'login_string' (fordi vi kaldte dem det)
	 * være sat. Så vi tjekker om det er tilfældet,
	 */
	if(!isset($_SESSION['username'], $_SESSION['login_string']))
	{
		return false;
	}
	else
	{
		$login_string = $_SESSION['login_string'];
		$username = $_SESSION['username'];

		$user_browser = $_SERVER['HTTP_USER_AGENT'];

		/**
		 * Så længe $_SESSION['username'] kun kan blive sat hvis det brugernavn og den kode man tastede ind er rigtige,
		 * så behøver vi kun at tjekke om $_SESSION['username'] matcher det rigtige brugernavn for at vide om brugeren
		 * er logget ind.
		 */
		if ($username == USERNAME)
		{
			$password = PASSWORD;
			$login_check = hash('sha512', $password . $user_browser);

			/**
			 * Men for at være helt sikker laver vi en login streng på samme måde som da brugeren loggede ind,
			 * og tjekker om den matcher. Den eneste variabel som her kommer fra brugeren (ganske vist uden han/hun
			 * selv skal taste det ind) er brugerens browser string, som fortæller hvilken browser brugeren benytter.
			 *
			 * Hvis ikke det er samme browser som succesfuldt loggede ind, som forsøger at tilgå siden, er der
			 * noget galt, og vi returnerer false.
			 */

			if ($login_check == $login_string)
				return true;
			else
				return false;
		}
		else
		{
			echo "Session username does not match admin username. This shouldn't happen. Like, ever. WHy am I writing this?";
			return true;
		}
	}
}