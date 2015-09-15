Feature: Original To Planck
  In order to achieve smaller file size
  As a Client
  I need to be able to take long identities, classes, and selectors (originals) and make them into their smallest possible form (Plancks.)

Scenario: Turn 1 Original into 1 Planck
  Given I have content "#idee"
  When I turn original into planck 
  Then I should get "a"

Scenario: Turn 3 Originals into 3 Plancks
  Given I have content "#idee,.classy,identifier"
  When I turn originals into plancks
  Then I should get "a,b,c"
