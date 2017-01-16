Feature: LoginPage
  In order to ...
  As a ...
  I need to ...

  Scenario: valid LoginPage
    Given I am on "/login"
    Then I should see "Login Name"
    And I should see "Password"
    And I fill in the following:
      | name     | defaultuser |
      | password | 1234        |
    And I press "Login"
    Then I should be on "/dashboard"

  Scenario: invalid LoginPage
    Given I am on "/login"
    Then I should see "Login Name"
    And I should see "Password"
    And I fill in the following:
      | name     | defaultuser |
      | password | 123456        |
    And I press "Login"
    Then I should see "do not match our records"

  Scenario: Password Reset with valid user name
    Given I am on "/password/reset"
    Then I should see "Login Name"
    And I fill in the following:
      | name     | defaultuser |
    And I press "Send Password Reset Link"
    Then I should see "do not match our records"

  Scenario: Password Reset with valid user name
    Given I am on "/password/reset"
    Then I should see "Login Name"
    And I fill in the following:
      | name | joey |
    And I press "Send Password Reset Link"
    Then I should see "We can't find a user with that login name"
