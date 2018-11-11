@parser
Feature:
  As a customer
  In order to manage which GitHub repositories can be accessed
  We need to create Janus

  Scenario: Parsing simple PHP class
    Given PHP content is
    """
namespace Example;
class SimpleClass
{
}
    """
    When parser parses it
    Then parsed output is:
    """

    """
