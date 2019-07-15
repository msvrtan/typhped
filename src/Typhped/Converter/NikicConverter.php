<?php

declare(strict_types=1);

namespace Typhped\Converter;

use PhpParser\Node\Expr\Assign;
use PhpParser\Node\Expr\PropertyFetch;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Name;
use PhpParser\Node\Param;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Expression;
use PhpParser\Node\Stmt\Namespace_;
use PhpParser\Node\Stmt\Property;
use PhpParser\Node\Stmt\PropertyProperty;
use PhpParser\Node\Stmt\Return_;
use Typhped\Structure\Statement\StmtClass;
use Typhped\Structure\Statement\StmtNamespace;
use Typhped\Structure\Statement\StmtProperty;
use Typhped\Structure\Statement\StmtStruct;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class NikicConverter implements Converter
{
    private function convertClass(StmtClass $item): Class_
    {
        $subnodes = [];
        if ($item->hasParent()) {
            $subnodes['extends'] = new Name($item->getParentNameAsString());
        }

        if ($item->hasInterfaces()) {
            $subnodes['implements'] = [];

            foreach ($item->getInterfaces() as $interface) {
                $subnodes['implements'][] = new Name($interface->asString());
            }
        }

        return new Class_(new Name($item->getNameAsString()), $subnodes, []);
    }

    /**
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    private function convertStruct(StmtStruct $item): Class_
    {
        $subnodes = [
            'flags' => Class_::MODIFIER_FINAL,
            'stmts' => [],
        ];

        if ($item->hasParent()) {
            $subnodes['extends'] = new Name($item->getParentNameAsString());
        }

        if ($item->hasInterfaces()) {
            $subnodes['implements'] = [];

            foreach ($item->getInterfaces() as $interface) {
                $subnodes['implements'][] = new Name($interface->asString());
            }
        }

        $properties = [];
        $methods    = [];
        foreach ($item->getStatements() as $statement) {
            if ($statement instanceof StmtProperty) {
                $properties[] = new Property(
                    Class_::MODIFIER_PRIVATE,
                    [new PropertyProperty($statement->getName())]
                );
            }
        }

        $constructorParams = [];
        $constructorStmts  = [];

        foreach ($item->getStatements() as $statement) {
            if ($statement instanceof StmtProperty) {
                $constructorParams[] = new Param(
                    new Variable($statement->getName()),
                    null,
                    $statement->getType(),
                    false,
                    false,
                    []
                );

                $constructorStmts[] = new Expression(
                    new Assign(
                        new PropertyFetch(new Variable('this'), $statement->getName()),
                        new Variable($statement->getName())
                    )
                );
            }
        }

        if (count($constructorParams) > 0 || count($constructorStmts) > 0) {
            $methods[] = new ClassMethod(
                '__construct',
                [
                    'flags'  => Class_::MODIFIER_PUBLIC,
                    'params' => $constructorParams,
                    'stmts'  => $constructorStmts,
                ],
                []
            );
        }

        foreach ($item->getStatements() as $statement) {
            if ($statement instanceof StmtProperty) {
                $methods[] = new ClassMethod(
                    'get'.ucfirst($statement->getName()),
                    [
                        'flags'      => Class_::MODIFIER_PUBLIC,
                        'params'     => [],
                        'returnType' => $statement->getType(),
                        'stmts'      => [
                            new Return_(
                                new PropertyFetch(
                                    new Variable('this'),
                                    $statement->getName()
                                )
                            ),
                        ],
                    ],
                    []
                );
            }
        }

        $subnodes['stmts'] = array_merge($properties, $methods);

        return new Class_(new Name($item->getNameAsString()), $subnodes, []);
    }

    public function convert(array $input): array
    {
        //var_dump($input);

        $result = [];

        foreach ($input as $item) {
            if ($item instanceof StmtNamespace) {
                $statements = $this->convert($item->getStatements());

                $result[] = new Namespace_(new Name($item->getNameAsString()), $statements, []);
            } elseif ($item instanceof StmtClass) {
                $result[] = $this->convertClass($item);
            } elseif ($item instanceof StmtStruct) {
                $result[] = $this->convertStruct($item);
            }
        }

        return $result;
    }
}
