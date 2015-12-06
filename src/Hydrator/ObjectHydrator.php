<?php

namespace Carnage\Watson\Hydrator;

use Doctrine\ORM\Query;

class ObjectHydrator extends BaseHydrator
{
    protected $type = Query::HYDRATE_OBJECT;
}