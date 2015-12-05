<?php

namespace Carnage\Watson\Hydrator;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query;

class Object extends BaseHydrator
{
    protected $type = Query::HYDRATE_OBJECT;
}