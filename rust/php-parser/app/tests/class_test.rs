extern crate lib;

use lib::php71;

fn assert_ok(input: &str) {
    assert!(php71::ClassDeclarationStatementParser::new()
        .parse(input)
        .is_ok());
}

#[test]
fn empty_class_definitions() {
    assert_ok("class RegisterUser{}");
    assert_ok("abstract class RegisterUser{}");
    assert_ok("final class RegisterUser{}");
    assert_ok("class RegisterUser{}");
}

#[test]
fn parent_class_definitions() {
    assert_ok("class RegisterUser extends BaseCommand{}");
    assert_ok("abstract class RegisterUser extends BaseCommand{}");
    assert_ok("final class RegisterUser extends BaseCommand{}");
    assert_ok("class RegisterUser extends BaseCommand{}");
    assert_ok("class RegisterUser extends Vendor\\BaseCommand{}");
    assert_ok("class RegisterUser extends \\Vendor\\BaseCommand{}");
}
#[test]
fn single_interface_class_definitions() {
    assert_ok("class RegisterUser implements SomeInterface{}");
    assert_ok("abstract class RegisterUser implements SomeInterface{}");
    assert_ok("final class RegisterUser implements SomeInterface{}");
    assert_ok("class RegisterUser implements SomeInterface{}");
    assert_ok("class RegisterUser implements SomeInterface{}");
    assert_ok("class RegisterUser implements Vendor\\SomeInterface{}");
    assert_ok("class RegisterUser implements \\Vendor\\SomeInterface{}");
}

#[test]
fn parent_and_single_interface_class_definitions() {
    assert_ok("class RegisterUser extends BaseCommand implements SomeInterface{}");
    assert_ok("abstract class RegisterUser extends BaseCommand implements SomeInterface{}");
    assert_ok("final class RegisterUser extends BaseCommand implements SomeInterface{}");
    assert_ok("class RegisterUser extends BaseCommand implements SomeInterface{}");
}
#[test]
fn multi_interface_class_definitions() {
    assert_ok("class RegisterUser implements SomeInterface, AnotherInterface{}");
    assert_ok("abstract class RegisterUser implements SomeInterface, AnotherInterface{}");
    assert_ok("final class RegisterUser implements SomeInterface, AnotherInterface{}");
    assert_ok("class RegisterUser implements SomeInterface, AnotherInterface{}");
}
#[test]
fn parent_and_multi_interface_class_definitions() {
    assert_ok(
        "class RegisterUser extends BaseCommand implements SomeInterface, AnotherInterface{}",
    );
    assert_ok("abstract class RegisterUser extends BaseCommand implements SomeInterface, AnotherInterface{}");
    assert_ok(
        "final class RegisterUser extends BaseCommand implements SomeInterface, AnotherInterface{}",
    );
    assert_ok(
        "class RegisterUser extends BaseCommand implements SomeInterface, AnotherInterface{}",
    );
}

#[test]
fn simple_class_with_1_property() {
    assert_ok("class RegisterUser{int $id;}");
}
#[test]
fn simple_class_with_2_properties() {
    assert_ok("class RegisterUser{int $id;string $firstName;}");
    assert_ok(
        "
        class RegisterUser
        {
            int $id;
            string $firstName;
        }
        ",
    );
}

#[test]
fn class_with_trait() {
    assert_ok("class RegisterUser{use SomeTrait;}");
}
#[test]
fn class_with_traits() {
    assert_ok("class RegisterUser{use SomeTrait;use AnotherTrait;}");
}

#[test]
fn class_with_const() {
    assert_ok("class RegisterUser{const IMPORTANT=1;}");
}
#[test]
fn class_with_visibility_const() {
    assert_ok("class RegisterUser{private const FALSE=false;}");
}

#[test]
fn class_with_properties_and_traits() {
    assert_ok(
        "
        class RegisterUser
        {
            int $id;
            string $firstName;
            use SomeTrait;
            use AnotherTrait;
        }
        ",
    );
}

#[test]
fn class_with_simple_function() {
    assert_ok(
        "
        class RegisterUser
        {
            function doSomething(){}
        }
        ",
    );
}

#[test]
fn class_with_visible_simple_function() {
    assert_ok(
        "
        class RegisterUser
        {
            public function doSomething(){}
        }
        ",
    );
}

#[test]
fn class_with_simple_function_using_argument() {
    assert_ok(
        "
        class RegisterUser
        {
            function doSomething(int $id){}
        }
        ",
    );
}

#[test]
fn class_with_visible_simple_function_using_arguments() {
    assert_ok(
        "
        class RegisterUser
        {
            public function doSomething(int $id,string $name){}
        }
        ",
    );
}

#[test]
fn class_with_visible_simple_function_having_return_type() {
    assert_ok(
        "
        class RegisterUser
        {
            public function doSomething(): int{}
        }
        ",
    );
}

#[test]
fn class_with_method1() {
    assert_ok(
        "
        class RegisterUser
        {
            string $name;
            public function setName(string $name): void{
                $this->name=$name;
            }
        }
        ",
    );
}

#[test]
fn class_with_method2() {
    assert_ok(
        "
        class RegisterUser
        {
            public function getName(): string{
                return $this->name;
            }
        }
        ",
    );
}
