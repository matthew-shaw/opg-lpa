// ***********************************************
// This example commands.js shows you how to
// create various custom commands and overwrite
// existing commands.
//
// For more comprehensive examples of custom
// commands please read more here:
// https://on.cypress.io/custom-commands
// ***********************************************
//
//
// -- This is a parent command --
// Cypress.Commands.add("login", (email, password) => { ... })
//
//
// -- This is a child command --
// Cypress.Commands.add("drag", { prevSubject: 'element'}, (subject, options) => { ... })
//
//
// -- This is a dual command --
// Cypress.Commands.add("dismiss", { prevSubject: 'optional'}, (subject, options) => { ... })
//
//
// -- This will overwrite an existing command --
// Cypress.Commands.overwrite("visit", (originalFn, url, options) => { ... })
//

// work-around for "require.resolve is not a function" error
// as per https://github.com/component-driven/cypress-axe/issues/73#issuecomment-734909801
Cypress.Commands.add("injectAxe2", () => {
  cy.window({ log: false }).then(window => {
      const axe = require('axe-core/axe.js');
      const script = window.document.createElement('script');
      script.innerHTML = axe.source;
      window.document.body.appendChild(script);
  })
});

Cypress.Commands.add("OPGCheckA11y", (skipFailures) => {
    cy.injectAxe2();
    cy.checkA11y(null, null, printAccessibilityViolations, true);
});

Cypress.Commands.add("getLpaId", () => {
    cy.get('@donorPageUrl').then((donorPageUrl) => {
        return donorPageUrl.match(/\/(\d+)\//)[1];
    });
});

// Print cypress-axe violations to the terminal
function printAccessibilityViolations(violations) {
    cy.location().then((location) => {
        cy.task(
            'table',
            violations.map(({ id, impact, description, nodes }) => {
                let snippets = [];
                for (let i = 0; i < nodes.length; i++) {
                    snippets.push(nodes[i].html);
                }

                return {
                    impact,
                    location: `${location}`.replace(Cypress.config('baseUrl'), ''),
                    description: `${description} (${id})`,
                    nodes: snippets.join('; '),
                };
            }),
        );
    });
}

