<?php

class Database
{
	private static $db_link;

	private function __construct()
	{
	}

	private function __clone()
	{
	}

	public static function getInstance()
	{
		if (!self::$db_link)
		{
			try
			{
				self::$db_link = new PDO("mysql:host=localhost;port=8889;dbname=php01;charset=utf8", "php01", "php01");
				self::$db_link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
				// self::$db_link->setFetchMode(PDO::FETCH_OBJ);
			}
			catch (PDOException $ex)
			{
				die($ex->getMessage());
			}
		}

		return self::$db_link;
	}
}