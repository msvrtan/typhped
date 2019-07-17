extern crate lib;

use lib::php71;
use std::fs;

fn assert_file_ok(input: &str) {
    assert!(php71::FileParser::new().parse(input).is_ok());
}

#[test]
fn node_finder() {
    let filename = "tests/3rdPartySources/NodeFinder.php";

    let _contents = fs::read_to_string(filename).expect("Something went wrong reading the file");

    //assert_file_ok(_contents.as_str());
}
