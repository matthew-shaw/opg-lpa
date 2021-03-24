@CreateLpa
Feature: Create a Health and Welfare LPA

    I want to create a Health and Welfare LPA

    Background:
        Given I ignore application exceptions
        And I create HW LPA test fixture with a donor, attorneys and replacement attorneys

    @focus, @CleanupFixtures
    Scenario: Create LPA normal path
        When I log in as appropriate test user
        And I visit the certificate provider page for the test fixture lpa
        # ** CUT Above Here ** This comment line needed for stitching feature files. Please do not remove

        When I click "add-certificate-provider"
        Then I can see popup
        And I can find "form-cancel"
        And I can find "name-title" with 8 options
        # todo - casper just looked for use-my-details. We need ultimately to actually test this
        And I can find "use-my-details"
        When I select "Mr" on "name-title"
        And I force fill out
            | name-first | Reece |
            | name-last | Richards |
            | address-address1 | 11 Brookside |
            | address-address2 | Cholsey |
            | address-address3 | Wallingford, Oxfordshire |
            | address-postcode | OX10 9NN |
        And I click "form-save"
        # check certificate provider is listed and save points to replacement attorney page
        Then I see "Mr Reece Richards" in the page text
        And I can find save pointing to people to notify page
        # Casper checked for existence of delete link, here we click it then cancel, which is more thorough
        When I click "delete-certificate-provider"
        And I click "cancel"
        And I click "view-change-certificate-provider"
        Then I can see popup
        And I see "name-title" prepopulated with "Mr"
        And I see form prepopulated with
            | name-first | Reece |
            | name-last | Richards |
            | address-address1 | 11 Brookside |
            | address-address2 | Cholsey |
            | address-address3 | Wallingford, Oxfordshire |
            | address-postcode | OX10 9NN |
        And I click "form-cancel"
        When I click "save"
        Then I am taken to the people to notify page

        # Certificate Provider tests end and Person to Notify Tests start. Ultimately a good place to start a new Scenario

        When I click "add"
        Then I can see popup
        And I can find "form-cancel"
        And I can find "name-title" with 8 options
        # todo - casper just looked for use-my-details. We need ultimately to actually test this
        And I can find "use-my-details"
        When I select "Other" on "name-title"
        And I force fill out
            | name-title | Sir |
            | name-first | Anthony |
            | name-last | Webb |
            | address-address1 | Brickhill Cottage |
            | address-address2 | Birch Cross |
            | address-address3 | Marchington, Uttoxeter, Staffordshire |
            | address-postcode | BS18 6PL |
        And I click "form-save"
        Then I see "Sir Anthony Webb" in the page text
        When I click "view-change"
        Then I can see popup
        And I see form prepopulated with
            | name-title | Sir |
            | name-first | Anthony |
            | name-last | Webb |
            | address-address1 | Brickhill Cottage |
            | address-address2 | Birch Cross |
            | address-address3 | Marchington, Uttoxeter, Staffordshire |
            | address-postcode | BS18 6PL |
        And I click "form-cancel"
        When I click "save"

        # Person to notify tests end here and Instructions tests start. Ultimately a good place to start a new Scenario
        
        Then I am taken to the instructions page
        When I click "add-extra-preferences"
        And I force fill out  
            | instruction | Lorem Ipsum |
            | preferences | Neque porro quisquam |
        When I click "save"
        Then I am taken to the applicant page
        When I click occurrence 9 of "accordion-view-change"
        Then I see in the page text
            | Lorem Ipsum |
            | Neque porro quisquam |
        When I click "save"
        Then I am taken to the applicant page
        When I click occurrence 9 of "accordion-view-change"
        Then I see in the page text
            | Lorem Ipsum |
            | Neque porro quisquam |
        When I click "save"
        Then I am taken to the applicant page
        When I visit link containing "preview the LPA"

        # Instructions tests end here and Summary tests start. Ultimately a good place to start a new Scenario
        
        Then I am taken to the summary page
        And I see the following summary information
            | Type | Health and welfare | |
            | Donor | | |
            | Name | Mrs Nancy Garrison | donor |
            | Date of birth | 22 October 1988 | |
            | Email address | opglpademo+NancyGarrison@gmail.com | |
            | Address | Bank End Farm House $ Undercliff Drive$ Ventnor, Isle of Wight $ PO38 1UL | |
            | The donor can physically sign or make a mark on the LPA | No | |
            | Life-sustaining treatment | The attorneys can make decisions | life-sustaining |
            | 1st attorney | | |
            | Name | Mrs Amy Wheeler | primary-attorney |
            | Date of birth | 22 October 1988 | |
            | Email address | opglpademo+AmyWheeler@gmail.com | |
            | Address | Brickhill Cottage $ Birch Cross $ Marchington, Uttoxeter, Staffordshire $ ST14 8NX | |
            | 2nd attorney | | |
            | Name | Mr David Wheeler | primary-attorney |
            | Date of birth | 12 March 1972 | |
            | Email address | opglpademo+DavidWheeler@gmail.com | |
            | Address | Brickhill Cottage $ Birch Cross $ Marchington, Uttoxeter, Staffordshire $ ST14 8NX | |
            | Attorney decisions | | |
            | How decisions are made | The attorneys will act jointly and severally | how-primary-attorneys-make-decision |
            | 1st replacement attorney | | |
            | Name | Ms Isobel Ward | replacement-attorney | 
            | Date of birth | 1 February 1937 | |
            | Address | 2 Westview $ Staplehay $ Trull, Taunton, Somerset $ TA3 7HF | |
            | 2nd replacement attorney | | |
            | Name | Mr Ewan Adams | replacement-attorney |
            | Date of birth | 12 March 1972 | |
            | Address | 2 Westview $ Staplehay $ Trull, Taunton, Somerset $ TA3 7HF | |
            | Replacement attorney decisions | | |
            | When they step in | The replacement attorneys will only step in when none of the original attorneys can act | when-replacement-attorney-step-in | 
            | How decisions are made | The replacement attorneys will act jointly and severally | how-replacement-attorneys-make-decision |
            | Certificate provider | | |
            | Name | Mr Reece Richards | certificate-provider |
            | Address | 11 Brookside $ Cholsey $ Wallingford, Oxfordshire $ OX10 9NN | |
            | Person to notify | | |
            | Name | Sir Anthony Webb | people-to-notify |
            | Address | Brickhill Cottage $ Birch Cross $ Marchington, Uttoxeter, Staffordshire $ BS18 6PL | |
        And I can find draft download link
        When I visit link in new tab containing "download a preview"
        #Then I can download "Draft-Lasting-Power-of-Attorney-LP1H.pdf"
        When I click back
        And I click "continue"

        # Summary tests end here and Applicant tests start. Ultimately a good place to start a new Scenario
        
        Then I am taken to the applicant page
        When I click "save"
        Then I see in the page text
            | There is a problem |
            | Select the person who is applying to register the LPA |
        # select the attorney as applicant
        When I check occurrence 1 of checkbox
        When I check occurrence 0 of radio button
        And I click "save"

        # Applicant tests end here and Correspondent tests start. Ultimately a good place to start a new Scenario
        
        Then I am taken to the correspondent page
        And I can find "contactInWelsh-0"
        And I can find "contactInWelsh-1"
        When I click "change-correspondent"
        Then I can see popup
        And I see "Which details would you like to reuse?" in the page text
