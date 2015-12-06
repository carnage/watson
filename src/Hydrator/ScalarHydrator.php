<?php

namespace Carnage\Watson\Hydrator;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query;

class ScalarHydrator extends BaseHydrator
{
    protected $type = Query::HYDRATE_SCALAR;
}