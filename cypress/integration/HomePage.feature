Feature: Homepage 
 
  I want to be able to visit a valid homepage and follow the links
  
  @focus
  Scenario: Visit home page links
    Given I visit "/home"
    Then I see "Make a lasting power of attorney" in the title
    And I visit link containing "Sign in"
    And I am taken to "/login"
    When I click back
    Then I visit link in new tab containing "Terms of use"
    And I am taken to "/terms"
    And I see "Terms of use" in the title
    Then I visit link in new tab containing "Privacy notice"
    And I am taken to "/privacy-notice"
    And I see "Privacy notice" in the title
    # for now we must click back to home because cookies link behaves differently from privacy page
    When I click back
    Then I visit link in new tab containing "Cookies"
    And I am taken to "/cookies"
    And I see "Cookies" in the title
    #When I click back
    #And I visit link named "a.js-guidance"
