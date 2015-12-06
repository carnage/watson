<?php

namespace Carnage\Watson\Hydrator;

use Doctrine\ORM\Query;

class SimpleObjectHydrator extends BaseHydrator
{
    protected $type = Query::HYDRATE_SIMPLEOBJECT;
}