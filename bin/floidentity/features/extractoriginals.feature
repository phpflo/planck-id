Feature: ExtractOriginals
  In order to achieve smaller file size
  As a Client
  I need to be able to take long identities, classes, and selectors (originals) and make them into their smallest possible form (Plancks.)

Scenario: Extract 1 Identity from a Selector
  Given I have content "element.selector#idee[attr='eh']"
  When I extract style identities
  And I put that into a file named "/files/test4.txt"
  Then I should get "idee"

Scenario: Extract 2 Originals from Markup
  Given I have contents:
    """
      <a href="sdfsf" id="mu_idee" class="eh">link</a>
      <p id="wtf"></p>
    """
  When I extract markup identification
  Then I should get "mu_idee,wtf"
  
Scenario: Extract 1 Class from a Selector
  Given I have content "element.classOriginal#idee[attr='eh']"
  When I extract style classes
  Then I should gets: 
    """
    classOriginal
    """

Scenario: Extract 2 Originals from Styles without context: 1 Identity 1 Class
  Given I have content "element.classOriginal#idee[attr='eh']"
  When I extract originals without context
  Then I should gets: 
    """
    classOriginal,idee
    """