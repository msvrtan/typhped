#[derive(Debug)]
pub enum Expr {
    Variable(String),
    Value(Value),
    Operation(Box<Expr>, ArithmeticOperation, Box<Expr>),
    Comparison(Box<Expr>, ComparisonOperation, Box<Expr>),
    Brackets(Box<Expr>),
    Assignment(Box<Expr>, AssignmentOperation, Box<Expr>),
}

#[derive(Debug)]
pub enum Value {
    String(String),
    Int(u32),
    Float(f64),
    Bool(bool),
}

#[derive(Debug)]
pub enum ArithmeticOperation {
    Add,
    Sub,
    Mul,
    Div,
}

#[derive(Debug)]
pub enum ComparisonOperation {
    IsEqual,
    IsSmaller,
    IsGreater,
    IsGreaterOrEqual,
    IsIdentical,
    IsNotEqual,
    IsNotIdentical,
    IsSmallerOrEqual,
    Spaceship,
}
#[derive(Debug)]
pub enum AssignmentOperation {
    Assign,
}

impl Expr {
    pub fn operation(first: Expr, op: ArithmeticOperation, second: Expr) -> Expr {
        Expr::Operation(Box::new(first), op, Box::new(second))
    }
    pub fn comparison(first: Expr, op: ComparisonOperation, second: Expr) -> Expr {
        Expr::Comparison(Box::new(first), op, Box::new(second))
    }
    pub fn assignement(first: Expr, op: AssignmentOperation, second: Expr) -> Expr {
        Expr::Assignment(Box::new(first), op, Box::new(second))
    }
}
