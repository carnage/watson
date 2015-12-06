<?php

namespace Carnage\Watson\Hydrator;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query;

class ArrayHydrator extends BaseHydrator
{
    protected $type = Query::HYDRATE_ARRAY;
}