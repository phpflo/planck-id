Feature: HandleAll
  In order to achieve smaller file size
  As a Client
  I need to be able to take long identities, classes, and selectors (originals) and make them into their smallest possible form (Plancks.)

Scenario: Extract and Minify Markup and Style Selectors from Contents
  Given I am in a directory "test"
  And I have contents:
  """
  <style type="text/css">#section-acebf433-a6ec-43f6-8166-55c8d129353a {
  text-shadow:0 1px 0 rgba(22, 24, 29, 0.5);
  }</style><style type="text/css" scoped="scoped">@media (max-width: 399px) {
  #post-simple-media-adjacent-left-8-media {}}
  @media (min-width: 400px) and (max-width: 589px) {#post-simple-media-adjacent-left-8-media {}}@media (min-width: 590px) {#post-simple-media-adjacent-left-8-media {}<section id="section-acebf433-a6ec-43f6-8166-55c8d129353a" class="post-simple media-adjacent left else" style="background-color:rgb(45, 49, 57); position:relative"><style type="text/css">#section-acebf433-a6ec-43f6-8166-55c8d129353a { </style>
  """
  When I extract selectors from style blocks
  Then I should gets:
  """
  section-acebf433-a6ec-43f6-8166-55c8d129353a,post-simple-media-adjacent-left-8-media
  """

Scenario: Extract and Minify Markup and Style Selectors from Contents
  Given I am in a directory "test"
  And I have a file named "scenario-input.html"
  And I have input from file "scenario-input.html"
  When I extract and minify
  And I write output to a file named "test-output.html"
  Then I should get the same output as the contents of the file "test-output.html"
