extern crate lib;

use lib::php71;

fn assert_file_ok(input: &str) {
    assert!(php71::FileParser::new().parse(input).is_ok());
}

#[test]
fn empty_php_file() {
    assert_file_ok("<?php");
}
#[test]
fn with_strict_types_declaration() {
    assert_file_ok("<?php declare(strict_types=1);");
    assert_file_ok(
        "
        <?php
            declare(strict_types=1);
        ",
    );
}

#[test]
fn with_namespace() {
    assert_file_ok(
        "
        <?php
            declare(strict_types=1);
            namespace Shop;
        ",
    );
}

#[test]
fn with_long_namespace() {
    assert_file_ok(
        "
        <?php
            declare(strict_types=1);
            namespace Vendor\\Shop;
        ",
    );
}

#[test]
fn with_namespace_and_imports() {
    assert_file_ok(
        "
        <?php
            declare(strict_types=1);
            namespace Shop;

            use Vendor\\FavoriteFramework\\Command\\BaseCommand;
        ",
    );
}

#[test]
fn with_class() {
    assert_file_ok(
        "
        <?php
            declare(strict_types=1);
            class Buy{}
        ",
    );
    assert_file_ok(
        "
        <?php
            declare(strict_types=1);

            namespace Vendor\\Shop\\User;

            class RegisterUser extends BaseCommand implements JsonSerializable,ImportantInterface
            {
                use SomeTrait;
                string $name;

                public function setName(string $name): void{
                    $this->name=$name;
                }
            }
        ",
    );
}
