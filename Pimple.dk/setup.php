<?php

$rootDir = "http://localhost/pimple.dk";
$imageDir = "/media/images/";

// define("SMARTY_DIR", str_replace("\\", "/", getcwd()) . "/includes/Smarty-3.1.17/libs/");
define("SMARTY_DIR", str_replace("\\", "/", getcwd()) . "/vendor/smarty/smarty/libs/");

require_once (SMARTY_DIR . "Smarty.class.php");

class SmartyPants
{
	private static $instance;

	private function __clone() {}

	private function __wakeup() {}

	private function __construct() {}

	public static function instance()
	{
		if (!isset(self::$instance))
		{
			$smarty = new Smarty();

			// $smarty->setTemplateDir("/templates");
			// $smarty->setCompileDir("/templates_c/");
			// $smarty->setConfigDir("/configs/");
			// $smarty->setCacheDir("/cache/");

			$smarty->caching = Smarty::CACHING_LIFETIME_CURRENT;
			$smarty->assign("app_name", "Pimple.dk");

			$smarty->debugging = false;

			$smarty->assign("title", "HenrikBN.dk");
			$smarty->assign("header", "HenrikBN.dk");
			$smarty->assign("footer", "Henrik B. Nørgaard &lt;kontakt@henrikbn.dk&gt;");

			self::$instance = $smarty;
		}
		return self::$instance;
	}
}