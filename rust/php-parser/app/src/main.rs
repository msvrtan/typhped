use lib::php71;

fn main() {
    assert_ok(
        "

                class RegisterUser extends AnotherClass implements SomeInterface
                {
                    string $name;
                    public function getName(): string{
                        return $this->name;
                    }
                }
            ",
    );

    assert_file_ok("<?php");

    assert!(php71::StructuresParser::new()
        .parse("declare(strict_types=0);")
        .is_ok());

    assert!(php71::StructureParser::new()
        .parse("declare(strict_types=0);")
        .is_ok());

    assert!(php71::NamespaceParser::new()
        .parse("namespace Vendor\\Shop;")
        .is_ok());

    assert!(php71::NamespaceNameParser::new()
        .parse("Vendor\\Shop")
        .is_ok());

    assert!(php71::ImportParser::new()
        .parse("use Vendor\\Shop;")
        .is_ok());

    assert!(php71::ImportNameParser::new().parse("Vendor\\Shop").is_ok());

    assert!(php71::ClassEntryTypeParser::new().parse("class").is_ok());
    assert!(php71::ClassExtendsFromParser::new()
        .parse("extends AnotherClass")
        .is_ok());
    assert!(php71::ClassExtendsFromParser::new()
        .parse("extends \\Vendor\\AnotherClass")
        .is_ok());
    assert!(php71::ClassImplementsParser::new()
        .parse("implements SomeInterface")
        .is_ok());
    assert!(php71::ClassNamesParser::new().parse("RegisterUser").is_ok());

    assert!(php71::ParentClassNameParser::new()
        .parse("Vendor\\RegisterUser")
        .is_ok());

    assert!(php71::ClassStatementParser::new().parse("int $i;").is_ok());
    assert!(php71::ClassStatementsParser::new()
        .parse("int $i; string $name;")
        .is_ok());
    assert!(php71::ClassStatementListParser::new()
        .parse("{int $i; string $name;}")
        .is_ok());

    assert!(php71::MethodArgumentParser::new().parse("int $a").is_ok());
    assert!(php71::MethodArgumentsParser::new()
        .parse("int $a,string $b")
        .is_ok());
    assert!(php71::MethodArgumentListParser::new()
        .parse("(int $a,string $b)")
        .is_ok());

    assert!(php71::MethodStatementParser::new().parse("$a=$b;").is_ok());
    assert!(php71::MethodStatementsParser::new()
        .parse("$a=$b;return $a;")
        .is_ok());
    assert!(php71::MethodStatementListParser::new()
        .parse("{$a=$b;return $a;}")
        .is_ok());

    assert!(php71::ReturnTypeParser::new().parse(": int").is_ok());
    assert!(php71::ValueParser::new().parse("false").is_ok());
    assert!(php71::VisibilityParser::new().parse("private").is_ok());

    assert!(php71::ExprParser::new().parse("$a=$b").is_ok());
}

fn assert_ok(input: &str) {
    assert!(php71::ClassDeclarationStatementParser::new()
        .parse(input)
        .is_ok());
}

fn assert_file_ok(input: &str) {
    assert!(php71::FileParser::new().parse(input).is_ok());
}
