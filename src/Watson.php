<?php
namespace Carnage\Watson;

use Carnage\Watson\Walker\SqlWalker;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\Query;

class Watson
{
    const HYDRATE_OBJECT = 'watson-hydrate-object';
    const HYDRATE_ARRAY = 'watson-hydrate-array';
    const HYDRATE_SCALAR = 'watson-hydrate-scalar';
    const HYDRATE_SINGLE_SCALAR = 'watson-hydrate-single-scalar';
    const HYDRATE_SIMPLEOBJECT = 'watson-hydrate-simple-object';

    public static function init(Configuration $config)
    {
        $config->setDefaultQueryHint(Query::HINT_CUSTOM_OUTPUT_WALKER, SqlWalker::class);
        $config->setCustomHydrationModes([
            static::HYDRATE_OBJECT => Hydrator\ObjectHydrator::class,
            static::HYDRATE_ARRAY => Hydrator\ArrayHydrator::class,
            static::HYDRATE_SCALAR => Hydrator\ScalarHydrator::class,
            static::HYDRATE_SINGLE_SCALAR => Hydrator\SingleScalarHydrator::class,
            static::HYDRATE_SIMPLEOBJECT => Hydrator\SimpleObjectHydrator::class
        ]);
    }
}