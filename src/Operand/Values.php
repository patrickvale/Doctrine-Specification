<?php

namespace Happyr\DoctrineSpecification\Operand;

use Doctrine\ORM\QueryBuilder;
use Happyr\DoctrineSpecification\ValueConverter;

class Values implements Operand
{
    /**
     * @var array
     */
    private $values;

    /**
     * @var int|string|null
     */
    private $valueType;

    /**
     * @param array           $values
     * @param int|string|null $valueType PDO::PARAM_* or \Doctrine\DBAL\Types\Type::* constant
     */
    public function __construct($values, $valueType = null)
    {
        $this->values = $values;
        $this->valueType = $valueType;
    }

    /**
     * @param QueryBuilder $qb
     * @param string       $dqlAlias
     *
     * @return string
     */
    public function transform(QueryBuilder $qb, $dqlAlias)
    {
        $values = $this->values;
        foreach ($values as $k => $v) {
            $values[$k] = ValueConverter::convertToDatabaseValue($v, $qb);
        }

        $paramName = sprintf('comparison_%d', $qb->getParameters()->count());
        $qb->setParameter($paramName, $values, $this->valueType);

        return sprintf(':%s', $paramName);
    }
}
