<?php

namespace Carnage\Watson\Walker;

use Doctrine\ORM\Query;
use Doctrine\ORM\Query\SqlWalker as BaseWalker;
use Carnage\Watson\Watson;

class SqlWalker extends BaseWalker
{
    /**
     * @param \Doctrine\ORM\Query\AST\SelectClause $selectClause
     * @return mixed|string
     */
    public function walkSelectClause($selectClause)
    {
        /** @var \Carnage\Watson\Configuration $config */
        $config = $this->getEntityManager()->getConfiguration();

        $logger = $config->getWatsonLogger();
        $logger->nextQuery();

        $sql = parent::walkSelectClause($selectClause);

        $querySource = $this->findQuerySource();

        if ($config->addQueryComment()) {
            $comment = ' -- ' . $querySource['file'] . ':' . $querySource['line'] . "\n";
            $sql = preg_replace('/SELECT/', 'SELECT ' . $comment, $sql, 1);
        }

        $logger->logQuerySource($querySource['file'], $querySource['line']);

        $this->attachHydrator();

        return $sql;
    }

    private function findQuerySource()
    {
        foreach (debug_backtrace() as $row) {
            if (stripos($row['file'], 'vendor') === false) {
                return $row;
            }
        }

        return ['file' => '*unknown*', 'line' => 0];
    }

    private function attachHydrator()
    {
        $mode = $this->getQuery()->getHydrationMode();
        switch ($mode) {
            case Query::HYDRATE_OBJECT:
                $this->getQuery()->setHydrationMode(Watson::HYDRATE_OBJECT);
                break;
            case Query::HYDRATE_ARRAY:
                $this->getQuery()->setHydrationMode(Watson::HYDRATE_ARRAY);
                break;
            case Query::HYDRATE_SCALAR:
                $this->getQuery()->setHydrationMode(Watson::HYDRATE_SCALAR);
                break;
            case Query::HYDRATE_SINGLE_SCALAR:
                $this->getQuery()->setHydrationMode(Watson::HYDRATE_SINGLE_SCALAR);
                break;
            case Query::HYDRATE_SIMPLEOBJECT:
                $this->getQuery()->setHydrationMode(Watson::HYDRATE_SIMPLEOBJECT);
                break;
        }
    }
}