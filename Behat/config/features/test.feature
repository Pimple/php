Feature: Imagine a very detailed description of something interesting.
  Instead this is just a dummy bank account. For every fifth deposit and/or
  withdrawal, the interest rate will be added to the balance.

  Scenario: Deposit 500.5 dkk to a 15.2 dkk account
    Given the account holds 15.2 dkk
    When I insert 500.5 dkk
    Then I should have 515.7 dkk

  Scenario: Withdraw 894.2
    Given the account holds 515.7 dkk
    When I withdraw 894.2
    Then I should have 0 dkk

  Scenario Outline: I make more than 5 deposits and/or withdrawals
    Given the account holds <initialAmount>
    And the interest rate is 10 percent
    When I insert <first> amount
    And I insert <second> amount
    And I insert <third> amount
    And I insert <fourth> amount
    And I insert <fifth> amount
    Then I should have <amountWithoutRent> dkk left
    And 2 plus 2 equals 5

    Examples:
    | initialAmount | first | second  | third | fourth  | fifth | amountWithoutRent |
    | 0.0           | 100.0 | 100.0   | 100.0 | 100.0   | 100.0 | 550.0             |
    | 423.2         | 25.6  | 5.1     | 77.23 | 48.6    | 5.0   | 643.2             |