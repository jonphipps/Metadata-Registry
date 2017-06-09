Feature: ViewProjectList
  In order to browse the list of existing projects
  As a guest user
  I need to view the list

  Scenario: see the list 
    Given I am on the projects page
    And I am not logged in
    Then I should see the default project
    And I should not see the Add Project button


