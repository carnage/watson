<?php

namespace Carnage\Watson\Walker;

use Doctrine\ORM\Query;
use Doctrine\ORM\Query\SqlWalker as BaseWalker;

class SqlWalker extends BaseWalker
{
    /**
     * @param \Doctrine\ORM\Query\AST\SelectClause $selectClause
     * @return mixed|string
     */
    public function walkSelectClause($selectClause)
    {
        $sql = parent::walkSelectClause($selectClause);

        foreach (debug_backtrace() as $row) {
            if (stripos($row['file'], 'vendor') === false) {
                $comment = ' -- ' . $row['file'] . ':' . $row['line'] . "\n";
                $sql = preg_replace('/SELECT/', 'SELECT ' . $comment, $sql, 1);
                return $sql;
            }
        }

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

        return $sql;
    }
}