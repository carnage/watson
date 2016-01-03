<?php

namespace Carnage\Watson\Logger;

class SimpleLogger implements LoggerInterface
{
    private $queries;

    private $queryCount;

    public function nextQuery()
    {
        return ++$this->queryCount;
    }

    public function logQuerySource($file, $line)
    {
        $this->queries[$this->queryCount]['file'] = $file;
        $this->queries[$this->queryCount]['line'] = $line;
    }

    public function logHydration($inputRows, $outputRows)
    {
        $this->queries[$this->queryCount]['hydrationInputRows'] = $inputRows;
        $this->queries[$this->queryCount]['hydrationOutputRows'] = $outputRows;
        $this->queries[$this->queryCount]['hydrationRowEfficiency'] =
            $this->queries[$this->queryCount]['hydrationOutputRows'] /
            $this->queries[$this->queryCount]['hydrationInputRows'];
    }

    /**
     * {@inheritdoc}
     */
    public function startQuery($sql, array $params = null, array $types = null)
    {
        $this->queries[$this->queryCount]['sql'] = $sql;
        $this->queries[$this->queryCount]['params'] = $params;
        $this->queries[$this->queryCount]['types'] = $types;
        $this->queries[$this->queryCount]['startMs'] = microtime(true);
    }

    /**
     * {@inheritdoc}
     */
    public function stopQuery()
    {
        $this->queries[$this->queryCount]['endMs'] = microtime(true);
        $this->queries[$this->queryCount]['executionMS'] =
            $this->queries[$this->queryCount]['endMs'] -
            $this->queries[$this->queryCount]['startMs'];
    }

    public function getQueries()
    {
        return $this->queries;
    }
}