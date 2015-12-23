<?php

namespace Carnage\Watson;

use Carnage\Watson\Logger\LoggerInterface;
use Doctrine\Common\Cache\ArrayCache;
use Carnage\Watson\Walker\SqlWalker;
use Doctrine\DBAL\Logging\SQLLogger;
use Doctrine\ORM\Configuration as DoctrineConfig;
use Doctrine\ORM\Query;

class Configuration extends DoctrineConfig
{
    const HYDRATE_OBJECT = 'watson-hydrate-object';
    const HYDRATE_ARRAY = 'watson-hydrate-array';
    const HYDRATE_SCALAR = 'watson-hydrate-scalar';
    const HYDRATE_SINGLE_SCALAR = 'watson-hydrate-single-scalar';
    const HYDRATE_SIMPLEOBJECT = 'watson-hydrate-simple-object';

    public function __construct(DoctrineConfig $config)
    {
        $this->_attributes = $config->_attributes;

        $this->setDefaultQueryHint(Query::HINT_CUSTOM_OUTPUT_WALKER, SqlWalker::class);
        $this->setCustomHydrationModes([
            static::HYDRATE_OBJECT => Hydrator\ObjectHydrator::class,
            static::HYDRATE_ARRAY => Hydrator\ArrayHydrator::class,
            static::HYDRATE_SCALAR => Hydrator\ScalarHydrator::class,
            static::HYDRATE_SINGLE_SCALAR => Hydrator\SingleScalarHydrator::class,
            static::HYDRATE_SIMPLEOBJECT => Hydrator\SimpleObjectHydrator::class
        ]);

        $this->_attributes['addQueryComment'] = true;
    }

    /**
     * Caching query's messes with logging their source, this prevents query caching
     *
     * @TODO maybe do something about trashing people's configs
     *
     * @return ArrayCache
     */
    public function getQueryCacheImpl()
    {
        return new ArrayCache();
    }

    /**
     * @TODO write code to prevent trashing of existing log setup
     * @param LoggerInterface $logger
     */
    public function setWatsonLogger(LoggerInterface $logger)
    {
        $this->_attributes['watsonLogger'] = $logger;
        $this->setSQLLogger($logger);
    }

    public function setSQLLogger(SQLLogger $logger = null)
    {
        null;
    }

    /**
     * @return LoggerInterface
     */
    public function getWatsonLogger()
    {
        return $this->_attributes['watsonLogger'];
    }

    public function setAddQueryComment($addQueryComment)
    {
        $this->_attributes['addQueryComment'] = (bool) $addQueryComment;
    }

    public function addQueryComment()
    {
        return $this->_attributes['addQueryComment'];
    }
}