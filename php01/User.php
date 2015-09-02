<?php

require_once("Database.php");

class User
{
	private $db;
	private $userName;
	private $realName;
	private $password;
	public $validated = false;

	public function __construct($username, $password = '')
	{
		echo 'ANSOUBASAS';
		$this->db = Database::getInstance();

		$sql = "select username, realname from users where username = ? and password = ?";
		$statement = $this->db->prepare($sql);
		$statement->execute([$username, $password]);
		$result = $statement->fetch();

		if (count($result) > 0)
		{
			echo 'Test1';
			$this->userName = $result['username'];
			$this->realName = $result['realname'];
			$this->validated = true;
		}
		else
		{
			echo "Test2";
			$this->realName = '';
			$this->userName = '';
		}
		$this->password = $password;
	}

	/**
	 * @return mixed
	 */
	public function getRealName()
	{
		return $this->realName;
	}

	/**
	 * @param mixed $realName
	 */
	public function setRealName($realName)
	{
		$this->realName = $realName;
	}

	/**
	 * @return mixed
	 */
	public function getUserName()
	{
		return $this->userName;
	}

	/**
	 * @param mixed $userName
	 * @return bool
	 */
	public function setUserName($userName)
	{
		if ($this->validated && $this->isUserNameAvailable())
		{
			$sql = "update users set username = ? where username = ? and password = ?";
			$statement = $this->db->prepare($sql);
			$statement->execute([$userName, $this->userName, $this->password]);
			$this->userName = $userName;
			return true;
		}
		return false;
	}

	private function isUserNameAvailable()
	{
		$sql = "select count(*) as usercount from users where username = ?";
		$statement = $this->db->prepare($sql);
		$statement->execute([$this->userName]);
		$result = $statement->fetch();

		if ($result["usercount"] > 0)
			return true;
		else
			return false;
	}

	private function doesUserExist($username, $password)
	{
		$sql = "select count(*) as usercount from users where username = ? and password = ?";
		$statement = $this->db->prepare($sql);
		$statement->execute([$username, password]);
		$result = $statement->fetch();

		if ($result["usercount"] > 0)
			return true;
		else
			return false;
	}

	public function register()
	{
		if ($this->isUserNameAvailable())
		{
			$sql = "insert into users values(?, ?, ?)";
			$statement = $this->db->prepare($sql);
			$statement->execute([$this->userName, $this->password, $this->realName]);
			return true;
		}
		else
			return false;
	}
}