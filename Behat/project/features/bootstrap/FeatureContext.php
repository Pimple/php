<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

// require_once 'PHPUnit/Autoload.php';
// require_once 'PHPUnit/Framework/Assert/Functions.php';
require_once 'classy.php';

/**
 * Features context.
 */
class FeatureContext extends BehatContext
{
	private $account = null;

    /**
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        $this->account = new BankAccount();
    }

	/**
	 * @Given /^the account holds (\d+) dkk$/
	 */
	public function theAccountHoldsDkk2($balance)
	{
		$this->account->balance = $balance;
		if ($this->account->balance != $balance)
			throw new Exception("Actual balance is " . $this->account->balance);
	}

	/**
	 * @When /^I insert (\d+) dkk$/
	 */
	public function iInsertDkk2($deposit)
	{
		$this->account->deposit($deposit);
	}

	/**
	 * @Then /^I should have (\d+) dkk$/
	 */
	public function iShouldHaveDkk2($balance)
	{
		if ($this->account->balance != $balance)
			throw new Exception("Actual balance is " . $this->account->balance);
	}

	/**
	 * @When /^I withdraw (\d+)$/
	 */
	public function iWithdraw2($withdrawal)
	{
		$this->account->withdraw($withdrawal);
	}

	/**
	 * @Given /^the account holds (\d+)$/
	 */
	public function theAccountHolds2($balance)
	{
		$this->account->balance = $balance;
		if ($this->account->balance != $balance)
			throw new Exception("Actual balance is " . $this->account->balance);
	}

	/**
	 * @When /^I insert (\d+) amount$/
	 */
	public function iInsertAmount2($deposit)
	{
		$this->account->deposit($deposit);
	}

	/**
	 * @Given /^the interest rate is (\d+) percent$/
	 */
	public function theInterestRateIsPercent($interest)
	{
		$this->account->interest = $interest;
		if ($this->account->interest != $interest)
			throw new Exception("Actual interest is " . $this->account->interest);
	}

	/**
	 * @When /^I insert (\d+) dkk (\d+) times$/
	 */
	public function iInsertDkkTimes($deposit, $n)
	{
		for ($i = 0; $i > $n; $i++)
			$this->account->deposit($deposit);
	}

	/**
	 * @Given /^the interest counter is reset$/
	 */
	public function theInterestCounterIs()
	{
		$this->account->interestCounter = 0;
		if ($this->account->interestCounter != 0)
			throw new Exception("The interest counter was not reset");
	}
}