import { Then } from "cypress-cucumber-preprocessor/steps";

/* Element testing and handling */

// map from natural language text to number
const MapNumberTextToNumber = {
    'a single': 1,
    'one': 1,
    'two': 2
};

// map from natural language text to HTML tag name
const MapElementSpecifierToTag = {
    'level 1 heading': 'H1',
    'level 2 heading': 'H2'
};

const checkNumberOfElements = (numberText, elementSpecifier) => {
    let tag = MapElementSpecifierToTag[elementSpecifier];
    let numberExpected = MapNumberTextToNumber[numberText];

    cy.document().then((doc) => {
        // select elements matching the specifier and count them
        expect(doc.querySelectorAll(tag).length).to.equal(numberExpected);
    });
};

/**
 * Check that a specified element has a particular tag
 *
 * dataCyReference: reference to the data-cy attribute value on the element
 * elementSpecifier: type of element dataCyReference is expected to be,
 *     expressed as a key from the MapElementSpecifierToTag array
 */
Then('{string} is a {string} element', (dataCyReference, elementSpecifier) => {
    cy.get("[data-cy=" + dataCyReference + "]").then((els) => {
        expect(els.length).to.equal(1);
        expect(els[0].tagName).to.equal(MapElementSpecifierToTag[elementSpecifier]);
    });
});

/**
 * Check that there is/are a specific number of elements of a particular tag
 * in the document
 *
 * numberText: key from MapNumberTextToNumber, e.g. "is a single", "are two"
 * elementSpecifier: type of element dataCyReference is expected to be,
 *     expressed as a key from the MapElementSpecifierToTag array
 */
Then('there is {string} {string} element on the page', (numberText, elementSpecifier) => {
    checkNumberOfElements(numberText, elementSpecifier);
});

Then('there are {string} {string} elements on the page', (numberText, elementSpecifier) => {
    checkNumberOfElements(numberText, elementSpecifier);
});
