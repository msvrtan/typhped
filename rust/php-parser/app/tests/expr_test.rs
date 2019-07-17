extern crate lib;

use lib::php71_expr;

fn assert_ok(input: &str) {
    println!("{:?}", &input);
    assert!(php71_expr::ExprParser::new().parse(input).is_ok());
}

#[test]
fn variable() {
    assert_ok("$a");
}

#[test]
fn arithmetic_operations_with_variables() {
    assert_ok("$a + $b");
    assert_ok("$a+$b");
    assert_ok("$a +$b");
    assert_ok("$a+ $b");
    assert_ok("$a-$b");
    assert_ok("$a*$b");
    assert_ok("$a/$b");
}

#[test]
fn arithmetic_operations_with_values() {
    assert_ok("8 + 4");
    assert_ok("8+4");
    assert_ok("8 +4");
    assert_ok("8+ 4");
    assert_ok("8-4");
    assert_ok("8*4");
    assert_ok("8/4");
    assert_ok("8.2 + 4.0");
    assert_ok("8 + 4.4");
    assert_ok("8.1 + 4");
}

#[test]
fn arithmetic_operations_with_variables_and_values() {
    assert_ok("$a + 4");
    assert_ok("$a+4");
    assert_ok("$a +4");
    assert_ok("$a+ 4");
    assert_ok("$a-4");
    assert_ok("$a*4");
    assert_ok("$a/4");

    assert_ok("8 + $a");
    assert_ok("8+$a");
    assert_ok("8 +$a");
    assert_ok("8+ $a");
    assert_ok("8-$a");
    assert_ok("8*$a");
    assert_ok("8/$a");
}

#[test]
fn multiple_arithmetic_operations_with_variables() {
    assert_ok("$a + $b - $c");
    assert_ok("$a * $b / $c");
    assert_ok("$a * $b - $c");
}

#[test]
fn multiple_arithmetic_operations_with_values() {
    assert_ok("1 + 2 - 3");
    assert_ok("1 * 2 / 3");
    assert_ok("1 * 2 - 3");
}

#[test]
fn multiple_arithmetic_operations_with_variables_and_values() {
    assert_ok("$a + 2 - 3");
    assert_ok("$a * 2 / 3");
    assert_ok("$a * 2 - 3");

    assert_ok("1 + $b - 3");
    assert_ok("1 * $b / 3");
    assert_ok("1 * $b - 3");

    assert_ok("1 + 2 - $c");
    assert_ok("1 * 2 / $c");
    assert_ok("1 * 2 - $c");
}

#[test]
fn arithmetic_operations_with_brackets() {
    assert_ok("($a + $b)");
    assert_ok("$a + ($b - $c)");
    assert_ok("($a + $b) - $c");
    assert_ok("(($a + $b) - $c)");
    assert_ok("(($a + $b) - ($c*$d))");
    assert_ok("($a + $b - ($c*$d))");

    assert_ok("($a + 1)");
    assert_ok("$a + (1 - $c)");
    assert_ok("($a + 1) - $c");
    assert_ok("(($a + 1) - $c)");
    assert_ok("(($a + 1) - ($c*2))");
    assert_ok("($a + 1 - ($c*2))");
}

#[test]
fn comparison_operations() {
    assert_ok("$a==$b");
    assert_ok("$a<$b");
    assert_ok("$a>$b");
    assert_ok("$a>=$b");
    assert_ok("$a===$b");
    assert_ok("$a!=$b");
    assert_ok("$a<>$b");
    assert_ok("$a!==$b");
    assert_ok("$a<=$b");
    assert_ok("$a<=>$b");
}
#[test]
fn comparison_operations_with_values() {
    assert_ok("1==2");
    assert_ok("1<2");
    assert_ok("1>2");
    assert_ok("1>=2");
    assert_ok("1===2");
    assert_ok("1!=2");
    assert_ok("1<>2");
    assert_ok("1!==2");
    assert_ok("1<=2");
    assert_ok("1<=>2");
}
#[test]
fn comparison_operations_of_variables_and_values() {
    assert_ok("4==$b");
    assert_ok("4<$b");
    assert_ok("4>$b");
    assert_ok("4>=$b");
    assert_ok("4===$b");
    assert_ok("4!=$b");
    assert_ok("4<>$b");
    assert_ok("4!==$b");
    assert_ok("4<=$b");
    assert_ok("4<=>$b");

    assert_ok("$a==6");
    assert_ok("$a<6");
    assert_ok("$a>6");
    assert_ok("$a>=6");
    assert_ok("$a===6");
    assert_ok("$a!=6");
    assert_ok("$a<>6");
    assert_ok("$a!==6");
    assert_ok("$a<=6");
    assert_ok("$a<=>6");
}

#[test]
fn assignement() {
    assert_ok("$a=$b");
}

#[test]
fn assignement_with_arithmetic_operation() {
    //assert_ok("$a=$b+1");
    assert_ok("$a=$b+$c");
}

#[test]
fn assignement_with_comparison_operation() {
    //assert_ok("$a=$b>1");
    assert_ok("$a=$b<=$c");
}
