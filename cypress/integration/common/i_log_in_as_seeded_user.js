import { When } from "cypress-cucumber-preprocessor/steps";

When(`I log in as seeded user`, () => {
    cy.visit("/login").title().should('include','Sign in');
    cy.get("input#email.form-control").clear().type(Cypress.env("seeded_email"));
    cy.get("input#password.form-control").clear().type(Cypress.env("seeded_password"));
    cy.get("input#signin-form-submit.button").click();
    cy.log("Successfully logged in as " + Cypress.env("seeded_email"));
})
