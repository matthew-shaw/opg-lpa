import { Given, Then } from "cypress-cucumber-preprocessor/steps";

Given(`I visit {string}`, (url) => {
    // note that cy.visit will follow redirects, and require the status code to be 2xx after that
    cy.visit(url);
    cy.OPGCheckA11y();
})

Then(`I visit the login page`, () => {
    cy.visit('/login');
    cy.OPGCheckA11y();
})

Then(`I visit the type page`, () => {
    cy.visit('/lpa/type');
    cy.OPGCheckA11y();
})

// The reason the step below exists is that a newly Signed-up user gets taken 
// automatically to type page on first logon, but existing test users get taken
// to dashboard, and we wish to cater for both
Then(`If I am on dashboard I visit the type page`, () => {
    cy.url().then(urlStr => {
        if (urlStr.includes('dashboard')) {
            cy.visit('/lpa/type');
            cy.OPGCheckA11y();
        }
    });
})

Then(`I visit the admin sign-in page`, () => {
    cy.visit(Cypress.env('adminUrl') + '/sign-in');
    cy.OPGCheckA11y();
})


Then(`I visit the donor page for the in-progress lpa`, () => {
        cy.get('@lpaId').then((lpaId) => {
            cy.visit('/lpa/' + lpaId + '/donor');
            cy.OPGCheckA11y();
        });
})
