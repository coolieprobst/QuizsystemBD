<?php

class Application_Model_OptionMapper
{
    protected $_dbTable;

    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }

        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }

        $this->_dbTable = $dbTable;
        return $this;
    }

    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Option');
        }

        return $this->_dbTable;
    }

    public function save(Application_Model_Option $oQuestion)
    {
        $aData = array(
            'question' => $oQuestion->getQuestion(),
            'created' => $oQuestion->getCreated()
        );

        if (null === ($iId = $oQuestion->getId())) {
            unset($aData['question_id']);
            $aData['date_input']  = date('Y-m-d H:i:s');
            $oQuestion->setId($this->getDbTable()->insert($aData));
        } else {
            $this->getDbTable()->update($aData, array('question_id = ?' => $iId));
        }
    }

    public function find($iId, Application_Model_Option $oOption)
    {
        $oResult = $this->getDbTable()->find($iId);
        if (0 == count($oResult)) {
            return;
        }

        $oRow = $oResult->current();
        self::mapObjectToModel($oRow, $oOption);
    }

    public function getOptionIds2Question($iQuestionId)
    {
        $oWhere = $this->getDbTable()->select()->where('question_id = ?', $iQuestionId);
        $oRows = $this->getDbTable()->fetchAll($oWhere);

        if (0 == count($oRows)) {
            return;
        }

        return self::mapEntriesToModels($oRows);
    }

    public function fetchAll()
    {
        $oResultSet = $this->getDbTable()->fetchAll();
        return self::mapEntriesToModels($oResultSet);
    }

    public static function mapEntriesToModels(Zend_Db_Table_Rowset_Abstract $oRows)
    {
        $aEntries = array();
        foreach ($oRows as $oRow) {
            $aEntries[] = self::mapObjectToModel($oRow);
        }
        return $aEntries;
    }

    public static function mapObjectToModel(Zend_Db_Table_Row_Abstract $oRow, Application_Model_Option $oOption = null)
    {
        if (null === $oOption) {
            $oOption = new Application_Model_Option();
        }
        $oOption->setOptionId($oRow->option_id)->setQuestionId($oRow->question_id)->setType($oRow->type)->setCreated($oRow->date_input);

        return $oOption;
    }
}