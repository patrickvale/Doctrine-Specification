<?php

namespace tests\Happyr\DoctrineSpecification\Result;

use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\Query;
use Happyr\DoctrineSpecification\Result\AsArray;
use Happyr\DoctrineSpecification\Result\ResultModifier;
use PhpSpec\ObjectBehavior;

/**
 * @mixin AsArray
 */
class AsArraySpec extends ObjectBehavior
{
    public function it_is_a_result_modifier()
    {
        $this->shouldBeAnInstanceOf(ResultModifier::class);
    }

    public function it_sets_hydration_mode_to_array(AbstractQuery $query)
    {
        $query->setHydrationMode(Query::HYDRATE_ARRAY)->shouldBeCalled();

        $this->modify($query);
    }
}
