Feature: Create a Health and Welfare LPA

    I want to create a Health and Welfare LPA

    Background:
        Given I ignore application exceptions
 
    #@focus
    Scenario: Create LPA with error first
        Given I log in as appropriate test user
        Then I visit the type page
        When I click "save"
        Then I see in the page text
            | There was a problem submitting the form |
            | You need to do the following: |
            | Choose a type of LPA |
        Then I choose Health and Welfare
        When I click "save"
        Then I am taken to the donor page for health and welfare
        And I see "Who is the donor for this LPA?" in the page text
        And I get lpaid
        # save button should be missing initially
        And I cannot find "save-and-continue"
        When I click "add-donor-details"
        Then I can see popup

    @focus
    Scenario: Create LPA normal path
        Given I log in as appropriate test user
        Then I visit the type page
        Then I choose Health and Welfare
        When I click "save"
        Then I am taken to the donor page for health and welfare
        And I see "Who is the donor for this LPA?" in the page text
        And I get lpaid
        # save button should be missing initially
        And I cannot find "save-and-continue"
        When I click "add-donor-details"
        Then I can see popup
