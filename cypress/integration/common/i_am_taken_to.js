import { Then } from "cypress-cucumber-preprocessor/steps";

var dashboard = Cypress.config().baseUrl + '/user/dashboard';
var lpaType = Cypress.config().baseUrl + '/lpa/type';
var lpaid;
 
Then(`I am taken to {string}`, (url) => {
  cy.url().should('eq',Cypress.config().baseUrl + url);
})

Then(`I am taken to the login page`, () => {
  cy.url().should('eq',Cypress.config().baseUrl + '/login');
})

Then(`I am taken to the dashboard page`, () => {
  cy.url().should('eq',dashboard);
})
 
Then(`I am taken to the lpa type page`, () => {
  cy.url().should('eq',lpaType);
})

Then(`I am taken to the when lpa starts page`, () => {
    var when_lpa_starts = '/lpa/\\d+/when-lpa-starts';
    cy.get('@donorPageUrl').then(($url) => {
        var lpaId = $url.match(/\/(\d+)\//)[1];
        var whenLpaStartsPath = when_lpa_starts.replace('\\d+', lpaId);
        cy.url().should('eq',Cypress.config().baseUrl + whenLpaStartsPath);
    });
});
 
Then(`I am taken to the donor page for health and welfare`, () => {
  cy.url().should('contain','donor').as('donorPageUrl');
    // in theory, the line below should use a data-cy tag to get this element, in practice, putting the tag in the right place to be searched for, is not straightforward
  cy.get('.accordion li.complete').should('contain','This LPA covers health and welfare');
})

Then(`I am taken to the donor page for property and finance`, () => {
  cy.url().should('contain','donor').as('donorPageUrl');
    // in theory, the line below should use a data-cy tag to get this element, in practice, putting the tag in the right place to be searched for, is not straightforward
  cy.get('.accordion li.complete').should('contain','This LPA covers property and financial affairs');
})

Then(`I am taken to the post logout url`, () => {
  cy.log("I should be on " + Cypress.config().postLogoutUrl );
  cy.url().should('eq',Cypress.config().postLogoutUrl );
})
