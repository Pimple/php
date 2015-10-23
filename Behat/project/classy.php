<?php

class BankAccount
{
	public $balance = 0.0;
	public $interest = 10;

	public $interestCounter = 0;

	public function deposit($amount)
	{
		$this->balance += $amount;
		$this->beInteresting();
	}

	public function withdraw($amount)
	{
		$this->balance -= $amount;
		$this->beInteresting();
	}

	private function beInteresting()
	{
		$this->interestCounter++;
		if ($this->interestCounter >= 5)
		{
			$this->balance += round($this->balance * $this->interest / 100);
			$this->interestCounter = 0;
		}
	}
}