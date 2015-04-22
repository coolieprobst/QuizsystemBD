<?php

abstract class Application_Model_AbstractMapper
{
    protected $_dbTable;

    public function __construct($dbTable)
    {
        $this->setDbTable($dbTable);
    }

    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }

        if (!$dbTable instanceof Application_Model_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }

        $this->_dbTable = $dbTable;
        return $this;
    }

    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            throw new Exception('Table object is not set.');
        }

        return $this->_dbTable;
    }
}