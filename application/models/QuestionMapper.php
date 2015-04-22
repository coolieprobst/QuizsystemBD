<?php

class Application_Model_QuestionMapper
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
            $this->setDbTable('Application_Model_DbTable_Question');
        }

        return $this->_dbTable;
    }

    public function save(Application_Model_Question $oQuestion)
    {
        $aData = array(
            'question' => $oQuestion->getQuestion()
        );

        if (null === ($iId = $oQuestion->getId())) {
            unset($aData['question_id']);
            $aData['date_input'] = date('Y-m-d H:i:s');
            $oQuestion->setId($this->getDbTable()->insert($aData));
        } else {
            $this->getDbTable()->update($aData, array('question_id = ?' => $iId));
        }
    }

    public function find($iId, Application_Model_Question $oQuestion)
    {
        $oResult = $this->getDbTable()->find($iId);
        if (0 == count($oResult)) {
            return;
        }

        $oRow = $oResult->current();
        self::mapObjectToModel($oRow, $oQuestion);
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

    public static function mapObjectToModel(Zend_Db_Table_Row_Abstract $oRow, Application_Model_Question $oQuestion = null)
    {
        if (null === $oQuestion) {
            $oQuestion = new Application_Model_Question();
        }
        $oQuestion->setId($oRow->question_id)->setQuestion($oRow->question)->setCreated($oRow->date_input);

        return $oQuestion;
    }
}