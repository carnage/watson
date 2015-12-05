<?php
namespace Carnage\Watson;

use Carnage\Watson\Hydrator\Object;
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
            static::HYDRATE_OBJECT => Object::class,
            static::HYDRATE_ARRAY => '',
            static::HYDRATE_SCALAR => '',
            static::HYDRATE_SINGLE_SCALAR => '',
            static::HYDRATE_SIMPLEOBJECT => ''
        ]);
    }
}