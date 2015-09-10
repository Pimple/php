<?php
// echo crypt("unlock", "lakrids");
	
require_once("setup.php");
$smarty = SmartyPants::instance();

$smarty->assign("rootDir", $rootDir);

$smarty->assign("welcome", "Front page title");
$smarty->assign("message", "<p>Welcome message, including markup and stuff.</p>");

$smarty->display("overview.tpl");