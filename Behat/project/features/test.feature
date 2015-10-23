Feature: Imagine a very detailed description of something interesting.
  Instead this is just a dummy bank account. For every fifth deposit and/or
  withdrawal, the interest rate will be added to the balance.

  Scenario: Deposit 500 dkk
    Given the account holds 15 dkk
    When I insert 500 dkk
    Then I should have 515 dkk

  Scenario: Withdraw 894 dkk
    Given the account holds 100 dkk
    When I withdraw 894
    Then I should have 106 dkk

  Scenario Outline: Make lots of deposits
    Given the account holds <initialAmount>
    And the interest counter is reset
    And the interest rate is 10 percent
    When I insert <first> amount
    And I insert <second> amount
    And I insert <third> amount
    And I insert <fourth> amount
    And I insert <fifth> amount
    Then I should have <amountWithoutRent> dkk

    Examples:
    | initialAmount | first | second  | third | fourth  | fifth | amountWithoutRent |
    | 0             | 100   | 100     | 100   | 100     | 100   | 550               |
    | 423           | 25    | 5       | 77    | 48      | 5     | 641               |

  Scenario: Trigger interest adjustment
    Given the account holds 0 dkk
    And the interest counter is reset
    When I insert 100 dkk 5 times
    Then I should have 550 dkk