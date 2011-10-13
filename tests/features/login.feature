# features/login.feature
Feature: login
  In order to gain access to secure pages
  As a website user
  I need to be able to login with my credentials

  Scenario: Logging in with correct credentials
    Given I am on "/auth/login"
    When I fill in "email" with "testaccount"
    And I fill in "password" with "testpassword"
    And I press "login"
    Then I should see "Welcome testaccount"

  Scenario: Logging in with incorrect credentials
    Given I am on "/auth/login"
    When I fill in "email" with "failaccount"
    And I fill in "password" with "failpassword"
    And I press "login"
    Then I should see "Logged in failed"