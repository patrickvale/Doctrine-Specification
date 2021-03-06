<?php

namespace tests\Happyr\DoctrineSpecification\Operand;

use Doctrine\ORM\QueryBuilder;
use Happyr\DoctrineSpecification\Operand\Field;
use Happyr\DoctrineSpecification\Operand\Operand;
use PhpSpec\ObjectBehavior;

/**
 * @mixin Field
 */
class FieldSpec extends ObjectBehavior
{
    private $fieldName = 'foo';

    public function let()
    {
        $this->beConstructedWith($this->fieldName);
    }

    public function it_is_a_field()
    {
        $this->shouldBeAnInstanceOf(Field::class);
    }

    public function it_is_a_operand()
    {
        $this->shouldBeAnInstanceOf(Operand::class);
    }

    public function it_is_transformable(QueryBuilder $qb)
    {
        $dqlAlias = 'a';
        $expression = 'a.foo';

        $this->transform($qb, $dqlAlias)->shouldReturn($expression);
    }

    public function it_is_change_dql_alias(QueryBuilder $qb)
    {
        $dqlAlias = 'a';
        $expression = 'b.foo';

        $this->beConstructedWith($this->fieldName, 'b');
        $this->transform($qb, $dqlAlias)->shouldReturn($expression);
    }
}
