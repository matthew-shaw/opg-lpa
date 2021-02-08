import { Then } from "cypress-cucumber-preprocessor/steps";
 
Then(`I click {string}`, (clickable) => {
    cy.get("[data-cy=" + clickable + "]").click();
    cy.OPGCheckA11y();
})

Then(`I click first occurrence of {string}`, (clickable) => {
    cy.get("[data-cy=" + clickable + "]").eq(0).click();
    cy.OPGCheckA11y();
})

Then(`I click second occurrence of {string}`, (clickable) => {
    cy.get("[data-cy=" + clickable + "]").eq(1).click();
    cy.OPGCheckA11y();
})

Then(`I click third occurrence of {string}`, (clickable) => {
    cy.get("[data-cy=" + clickable + "]").eq(2).click();
    cy.OPGCheckA11y();
})

Then(`I click fourth occurrence of {string}`, (clickable) => {
    cy.get("[data-cy=" + clickable + "]").eq(3).click();
    cy.OPGCheckA11y();
})

Then(`I click fifth occurrence of {string}`, (clickable) => {
    cy.get("[data-cy=" + clickable + "]").eq(4).click();
    cy.OPGCheckA11y();
})

Then(`I force click {string}`, (clickable) => {
    cy.get("[data-cy=" + clickable + "]").click({ force: true });
    cy.OPGCheckA11y();
})

Then(`I click element marked {string}`, (text) => {
    cy.contains(text).click();
    cy.OPGCheckA11y();
})

// this step exists because newly signed-up user goes straight to type page whereas existing user may get taken to dashboard
Then(`If I am on dashboard I click to create lpa`, () => {
    cy.url().then(urlStr => {
        if (urlStr.includes('dashboard')) {
            cy.get("[data-cy=createnewlpa]").click();
            cy.OPGCheckA11y();
        }
    });
})

