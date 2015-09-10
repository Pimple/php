<?php
	class Service
	{
		private static $instance;

		private function __clone() {}
		private function __wakeup() {}
		private function __construct() {}
		
		public static function instance()
		{
			if (!isset(self::$instance))
			{
				$service = new Service();

				self::$instance = $service;
			}
			return self::$instance;
		}
	}
?>