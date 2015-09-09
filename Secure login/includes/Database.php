<?php
include_once("psl-config.php");

class Database
{
	private static $db_link;

	private function __construct() {}

	private function __clone() {}

	public static function getInstance()
	{
		if (!self::$db_link)
		{
			try
			{
				self::$db_link = new PDO("mysql:host=" . HOST . ";port=8889;dbname=" . DATABASE . ";charset=utf8", USER, PASSWORD);
				self::$db_link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			}
			catch (PDOException $ex)
			{
				die($ex->getMessage());
			}
		}

		return self::$db_link;
	}
}