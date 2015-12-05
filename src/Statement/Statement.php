<?php
namespace Carnage\Watson\Statement;

class Statement implements \Doctrine\DBAL\Driver\Statement
{
    private $wrapped;

    public function __construct($wrapped)
    {
        $this->wrapped = $wrapped;
    }

    public function closeCursor()
    {
        // TODO: Implement closeCursor() method.
    }

    public function columnCount()
    {
        // TODO: Implement columnCount() method.
    }

    public function setFetchMode($fetchMode, $arg2 = null, $arg3 = null)
    {
        // TODO: Implement setFetchMode() method.
    }

    public function fetch($fetchMode = null)
    {
        // TODO: Implement fetch() method.
    }

    public function fetchAll($fetchMode = null)
    {
        // TODO: Implement fetchAll() method.
    }

    public function fetchColumn($columnIndex = 0)
    {
        // TODO: Implement fetchColumn() method.
    }

    function bindValue($param, $value, $type = null)
    {
        // TODO: Implement bindValue() method.
    }

    function bindParam($column, &$variable, $type = null, $length = null)
    {
        // TODO: Implement bindParam() method.
    }

    function errorCode()
    {
        // TODO: Implement errorCode() method.
    }

    function errorInfo()
    {
        // TODO: Implement errorInfo() method.
    }

    function execute($params = null)
    {
        // TODO: Implement execute() method.
    }

    function rowCount()
    {
        // TODO: Implement rowCount() method.
    }

}