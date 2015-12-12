<?php

namespace Carnage\Watson;

use Carnage\Watson\Logger\LoggerInterface;
use Doctrine\Common\Cache\ArrayCache;
use Doctrine\ORM\Configuration as DoctrineConfig;

class Configuration extends DoctrineConfig
{
    public function __construct(DoctrineConfig $config)
    {
        $this->_attributes = $config->_attributes;
        $this->_attributes['addQueryComment'] = true;
    }

    /**
     * Caching query's messes with logging their source, this prevents query caching
     *
     * @return ArrayCache
     */
    public function getQueryCacheImpl()
    {
        return new ArrayCache();
    }

    public function setWatsonLogger(LoggerInterface $logger)
    {
        $this->_attributes['watsonLogger'] = $logger;
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