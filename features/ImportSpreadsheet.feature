Feature: Import Google Spreadsheet
  In order to import vocabs into a project
  As a Project Administrator user
  I need to Process a Google Spreadsheet with multiple Worksheets

  Scenario: Create an Import Batch 
    Given I am on the project dashboard
    When I press the Add Import button
    Then I am on the Import Create page
    And I enter a processable URL
    And I press the Next button
    Then I am on the Worksheet Page
    And I see a new batch entry in the database

