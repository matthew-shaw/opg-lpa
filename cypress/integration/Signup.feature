Feature: Signup
 
  I want to be able to sign up
  
  @focus
  Scenario: Visit guidance
    Given I visit "/signup"
    Then I see "Create an account" in the title
