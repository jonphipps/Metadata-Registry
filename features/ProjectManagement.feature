Feature: Project Management
  In order to Manage projects
  As a Project Administrator
  I need to be able to manage all aspects of the project

  Scenario: edit the project 
    Given I am on a project page
    And I am logged in
    And I am the project administrator
    When I press the edit button
    Then I can see the edit project page

