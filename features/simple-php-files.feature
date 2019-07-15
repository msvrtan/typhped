@parser
Feature:
  As a developer
  In order to transpile definitions
  We need to support simple PHP classes too

  Scenario: Parsing simple PHP class
    Given PHP content is
    """
namespace Example;
class SimpleClass
{
}
    """
    When I convert it
    Then PHP output is:
    """
namespace Example;

class SimpleClass
{
}
    """

  Scenario: Parsing PHP class with parent
    Given PHP content is
    """
namespace Example;
class ChildClass extends \stdClass
{
}
    """
    When I convert it
    Then PHP output is:
    """
namespace Example;

class ChildClass extends \stdClass
{
}
    """

  Scenario: Parsing PHP class with interface
    Given PHP content is
    """
namespace Example;
class ChildClass implements \JsonSerializable
{
}
    """
    When I convert it
    Then PHP output is:
    """
namespace Example;

class ChildClass implements \JsonSerializable
{
}
    """

  Scenario: Parsing PHP class with multiple interfaces
    Given PHP content is
    """
namespace Example;
class ChildClass implements \JsonSerializable,AnotherInterface
{
}
    """
    When I convert it
    Then PHP output is:
    """
namespace Example;

class ChildClass implements \JsonSerializable, AnotherInterface
{
}
    """

  Scenario: Parsing PHP class with parent and interface
    Given PHP content is
    """
namespace Example;
class ChildClass extends \stdClass implements \JsonSerializable
{
}
    """
    When I convert it
    Then PHP output is:
    """
namespace Example;

class ChildClass extends \stdClass implements \JsonSerializable
{
}
    """
