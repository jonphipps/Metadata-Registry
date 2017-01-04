Feature: ViewProjectList
  In order to browse the list of existing projects
  As a guest user
  I need to view the list

  Scenario: see the list 
    Given I am on "/projects"
    Then I should see "NSDL Registry"
    And I should not see "Add Project"


