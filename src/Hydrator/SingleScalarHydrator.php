<?php

namespace Carnage\Watson\Hydrator;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query;

class SingleScalarHydrator extends BaseHydrator
{
    protected $type = Query::HYDRATE_SINGLE_SCALAR;
}