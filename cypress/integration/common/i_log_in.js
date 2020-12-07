import { When } from "cypress-cucumber-preprocessor/steps";

When(`I log in with user {string} password {string}`, (user, password) => {
    logIn(user, password);
})

When(`I log in as seeded user`, () => {
    logIn(Cypress.env("seeded_email"),Cypress.env("seeded_password"));
})

When(`I log in as standard test user`, () => {
    logIn(Cypress.env("email"),Cypress.env("password"));
})

function logIn(user, password){
    cy.visit("/login").title().should('include','Sign in');
    cy.get("input#email.form-control").clear().type(user);
    cy.get("input#password.form-control").clear().type(password);
    cy.get("input#signin-form-submit.button").click();
    cy.log("Successfully logged in as " + user);
}
