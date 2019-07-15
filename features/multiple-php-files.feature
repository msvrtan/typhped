@parser
Feature:
  As a developer
  In order to manage multiple class definitions in one file
  We need to support processing multiple classes

  Scenario: Parsing simple PHP class
    Given PHP content is
    """
namespace Example;
class FirstClass
{
}
class SecondClass
{
}
    """
    When I convert it
    Then PHP output is:
    """
namespace Example;

class FirstClass
{
}
class SecondClass
{
}
    """
