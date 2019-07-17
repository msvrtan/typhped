//use std::fmt::{Debug, Error, Formatter};

type NamespaceName = String;
type ImportName = String;

pub struct File {
    pub content: Vec<Structure>,
}

impl File {
    pub fn new(content: Vec<Structure>) -> File {
        File { content }
    }
}

pub enum Structure {
    OpenTag,
    //CloseTag,
    Declare(Declare),
    Namespace(NamespaceName),
    Import(ImportName),
    Class(ClassDeclarationStatement),
}

pub enum Declare {
    StrictTypesOn,
    StrictTypesOff,
}

pub struct ClassDeclarationStatement {
    pub entry_type: ClassEntryType,
    pub name: String,
    pub extends: Option<String>,
    pub implements: Vec<String>,
    pub statements: Vec<ClassStatement>,
}

impl ClassDeclarationStatement {
    pub fn simple(
        entry_type: ClassEntryType,
        name: String,
        statements: Vec<ClassStatement>,
    ) -> ClassDeclarationStatement {
        ClassDeclarationStatement {
            entry_type,
            name,
            extends: None,
            implements: vec![],
            statements,
        }
    }
    pub fn with_parent(
        entry_type: ClassEntryType,
        name: String,
        extends: String,
        statements: Vec<ClassStatement>,
    ) -> ClassDeclarationStatement {
        ClassDeclarationStatement {
            entry_type,
            name,
            extends: Some(extends),
            implements: vec![],
            statements,
        }
    }
    pub fn with_interface(
        entry_type: ClassEntryType,
        name: String,
        implements: Vec<String>,
        statements: Vec<ClassStatement>,
    ) -> ClassDeclarationStatement {
        ClassDeclarationStatement {
            entry_type,
            name,
            extends: None,
            implements,
            statements,
        }
    }
    pub fn with_parent_and_interface(
        entry_type: ClassEntryType,
        name: String,
        extends: String,
        implements: Vec<String>,
        statements: Vec<ClassStatement>,
    ) -> ClassDeclarationStatement {
        ClassDeclarationStatement {
            entry_type,
            name,
            extends: Some(extends),
            implements,
            statements,
        }
    }
}

pub enum ClassEntryType {
    Class,
    Abstract,
    Final,
}

pub enum ClassStatement {
    Const(Const),
    Trait(String),
    Property(Property),
    Method(Method),
}

pub struct Const {
    pub visibility: Visibility,
    pub name: String,
    pub value: Value,
}

impl Const {
    pub fn new(visibility: Visibility, name: String, value: Value) -> Const {
        Const {
            visibility,
            name,
            value,
        }
    }
    pub fn public(name: String, value: Value) -> Const {
        Const {
            visibility: Visibility::Public,
            name,
            value,
        }
    }
}

pub struct Property {
    pub visibility: Visibility,
    pub type_of: String,
    pub name: String,
}

impl Property {
    pub fn new(visibility: Visibility, type_of: String, name: String) -> Property {
        Property {
            visibility,
            type_of,
            name,
        }
    }
    pub fn private(type_of: String, name: String) -> Property {
        Property {
            visibility: Visibility::Private,
            type_of,
            name,
        }
    }
}

pub struct Method {
    pub visibility: Visibility,
    pub name: String,
    pub arguments: Vec<MethodArgument>,
    pub return_type: Option<String>,
    pub statements: Vec<MethodStatement>,
}

impl Method {
    pub fn new(
        visibility: Visibility,
        name: String,
        arguments: Vec<MethodArgument>,
        return_type: Option<String>,
        statements: Vec<MethodStatement>,
    ) -> Method {
        Method {
            visibility,
            name,
            arguments,
            return_type,
            statements,
        }
    }
    pub fn public(
        name: String,
        arguments: Vec<MethodArgument>,
        return_type: Option<String>,
        statements: Vec<MethodStatement>,
    ) -> Method {
        Method {
            visibility: Visibility::Public,
            name,
            arguments,
            return_type,
            statements,
        }
    }
}

pub struct MethodArgument {
    pub type_of: Option<String>,
    pub name: String,
}

impl MethodArgument {
    pub fn new(type_of: String, name: String) -> MethodArgument {
        MethodArgument {
            type_of: Some(type_of),
            name,
        }
    }
}

pub enum MethodStatement {
    Expr(Expr),
}

pub enum Expr {
    Assignement(String, String),
    Return(String),
}

pub enum Value {
    Bool(bool),
    Null,
    Number(Number),
}

pub enum Number {
    Int(i32),
    Float(f64),
}

pub enum Visibility {
    Public,
    Protected,
    Private,
}

/*

impl Debug for Expr {
    fn fmt(&self, fmt: &mut Formatter) -> Result<(), Error> {
        use self::Expr::*;
        match *self {
            Number(n) => write!(fmt, "{:?}", n),
            Op(ref l, op, ref r) => write!(fmt, "({:?} {:?} {:?})", l, op, r),
            Error => write!(fmt, "error"),
        }
    }
}

impl Debug for Opcode {
    fn fmt(&self, fmt: &mut Formatter) -> Result<(), Error> {
        use self::Opcode::*;
        match *self {
            Mul => write!(fmt, "*"),
            Div => write!(fmt, "/"),
            Add => write!(fmt, "+"),
            Sub => write!(fmt, "-"),
        }
    }
}
*/
