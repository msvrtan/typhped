@parser
Feature:
  As a developer
  In order to transpile definitions
  We need to support simple tyPHPed classes too

  Scenario: Parsing simple tyPHPed struct
    Given tyPHPed content is
    """
namespace Example;
struct SimpleClass
{
}
    """
    When I convert it
    Then PHP output is:
    """
namespace Example;

final class SimpleClass
{
}
    """

  Scenario: Parsing tyPHPed struct having integer property
    Given tyPHPed content is
    """
namespace Example;
struct SimpleClass
{
    int $value;
}
    """
    When I convert it
    Then PHP output is:
    """
namespace Example;

final class SimpleClass
{
        private $value;
        public function __construct(int $value)
        {
            $this->value = $value;
        }
        public function getValue() : int
        {
            return $this->value;
        }
}
    """

  Scenario: Parsing tyPHPed struct having array property
    Given tyPHPed content is
    """
namespace Example;
struct SimpleClass
{
    array $data;
}
    """
    When I convert it
    Then PHP output is:
    """
namespace Example;

final class SimpleClass
{
        private $data;
        public function __construct(array $data)
        {
            $this->data = $data;
        }
        public function getData() : array
        {
            return $this->data;
        }
}
    """


  Scenario: Parsing tyPHPed struct having multiple integer properties
    Given tyPHPed content is
    """
namespace Example;
struct SimpleClass
{
    int $value1;
    int $value2;
}
    """
    When I convert it
    Then PHP output is:
    """
namespace Example;

final class SimpleClass
{
        private $value1;
        private $value2;
        public function __construct(int $value1, int $value2)
        {
            $this->value1 = $value1;
            $this->value2 = $value2;
        }
        public function getValue1() : int
        {
            return $this->value1;
        }
        public function getValue2() : int
        {
            return $this->value2;
        }
}
    """