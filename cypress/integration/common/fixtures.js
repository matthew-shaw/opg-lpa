const {
  Then, After,
} = require("cypress-cucumber-preprocessor/steps");

// For tagged Scenarios, clean up lpa test fixture used by the scenario
// but only if we're not running under CI. In CI we leave it intact for 
// the next scenario, to simulate the user journey
After({ tags: "@CleanupFixtures" }, () => {
    if (!Cypress.env('CI')) {
        cy.get('@testFixtureLpaId').then((lpaId) => {
            cy.exec("python3 service-api/deleteLpa.py -i " + lpaId).its('stdout').then(deleteResult => {
                cy.log("Deleting test fixture lpa with id " + lpaId + " gave result " + deleteResult);
            });
        });
    }
});

Then(`I create PF LPA test fixture`, () => {
    // TODO check whether testFixtureLpaId is set, indicating that test fixture already exists. if not, create the fixture
    cy.exec("python3 service-api/createPFLpa.py").its('stdout').as('testFixtureLpaId').then(lpaId => {
        cy.log("Created PF LPA test fixture through the API with id " + lpaId);
    });
})
 
Then(`I create HW LPA test fixture`, () => {
    cy.exec("python3 service-api/createHWLpa.py").its('stdout').then(lpaId => {
        cy.log("Created HW LPA test fixture through the API with id " + lpaId);
    });
})
