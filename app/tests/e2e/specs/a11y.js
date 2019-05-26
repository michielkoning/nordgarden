// https://docs.cypress.io/api/introduction/api.html

describe('a11y', () => {
  it.only('home', () => {
    cy.visit('/');
    cy.injectAxe();
    cy.checkA11y();
  });
  it('tour', () => {
    cy.visit('/tour');
    cy.injectAxe();
    cy.checkA11y();
  });
  it('albums', () => {
    cy.visit('/albums');
    cy.injectAxe();
    cy.checkA11y();
  });
  it('videos', () => {
    cy.visit('/videos');
    cy.injectAxe();
    cy.checkA11y();
  });
  it('biography', () => {
    cy.visit('/biography');
    cy.injectAxe();
    cy.checkA11y();
  });
});
