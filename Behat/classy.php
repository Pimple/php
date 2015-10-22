<?php

class BankAccount
{
	public $balance = 0.0;
	public $interest = 10;

	private $interestCounter = 0;

	public function deposit($amount)
	{
		$this->balance += $amount;
	}

	public function withdraw($amount)
	{
		$this->balance -= $amount;
	}

	private function beInteresting()
	{
		$this->interestCounter++;
		if ($this->interestCounter == 5)
		{
			$this->balance += ($this->balance * $this->interest);
			$this->interestCounter = 0;
		}
	}
}