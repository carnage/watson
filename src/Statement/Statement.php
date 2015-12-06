<?php
namespace Carnage\Watson\Statement;

use Doctrine\DBAL\Driver\Statement as DoctrineStatement;

class Statement implements DoctrineStatement
{
    /**
     * @var DoctrineStatement
     */
    private $wrapped;

    private $rows = 0;

    public function __construct($wrapped)
    {
        $this->wrapped = $wrapped;
    }

    public function closeCursor()
    {
        return $this->wrapped->closeCursor();
    }

    public function columnCount()
    {
        return $this->wrapped->columnCount();
    }

    public function setFetchMode($fetchMode, $arg2 = null, $arg3 = null)
    {
        return $this->wrapped->setFetchMode($fetchMode, $arg2, $arg3);
    }

    public function fetch($fetchMode = null)
    {
        $this->rows++;
        return $this->wrapped->fetch($fetchMode);
    }

    public function fetchAll($fetchMode = null)
    {
        $return = $this->wrapped->fetchAll($fetchMode);

        $this->rows += count($return);

        return $return;
    }

    public function fetchColumn($columnIndex = 0)
    {
        return $this->wrapped->fetchColumn($columnIndex);
    }

    public function bindValue($param, $value, $type = null)
    {
        return $this->wrapped->bindValue($param, $value, $type);
    }

    public function bindParam($column, &$variable, $type = null, $length = null)
    {
        return $this->wrapped->bindParam($column, $variable, $type, $length);
    }

    public function errorCode()
    {
        return $this->wrapped->errorCode();
    }

    public function errorInfo()
    {
        return $this->wrapped->errorInfo();
    }

    public function execute($params = null)
    {
        return $this->wrapped->execute($params);
    }

    public function rowCount()
    {
        return $this->wrapped->rowCount();
    }

    public function getRows()
    {
        return $this->rows;
    }
}