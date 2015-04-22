<?php

class Application_Model_Question_2GroupMapper
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
            $this->setDbTable('Application_Model_DbTable_Question_2Group');
        }

        return $this->_dbTable;
    }

    public function save(Application_Model_Question_2Group $oQuestion2Group)
    {
        $aData = array(
            'question_id' => $oQuestion2Group->getQuestionId(),
            'question_group_id' => $oQuestion2Group->getQuestionGroupId()
        );

        if (null === ($iId = $oQuestion2Group->getQuestion2GroupId())) {
            $oQuestion2Group->setQuestion2GroupId($this->getDbTable()->insert($aData));
        } else {
            $this->getDbTable()->update($aData, array('question_group_id = ?' => $iId));
        }
    }

    public function find($iId, Application_Model_Question_2Group $oGroup)
    {
        $oResult = $this->getDbTable()->find($iId);
        if (0 == count($oResult)) {
            return;
        }

        $oRow = $oResult->current();
        self::mapObjectToModel($oRow, $oGroup);
    }

    public function fetchAll($mWhere = null)
    {
        $oResultSet = $this->getDbTable()->fetchAll($mWhere);
        return self::mapEntriesToModels($oResultSet);
    }

    public function fetchAll2Group($iGroupId)
    {
        $oWhere = $this->getDbTable()->select()->where('question_group_id = ?', $iGroupId);
        $oResultSet = $this->getDbTable()->fetchAll($oWhere);
        return self::mapEntriesToModels($oResultSet);
    }

    public function isInGroup($iGroupId, $iQuestionId)
    {
        $mWhere = $this->getDbTable()->select()->where('question_id = ?', $iQuestionId)->where('question_group_id = ?', $iGroupId);

        $aWhere = array(
            'question_group_id' => $iGroupId,
            'question_id' => $iQuestionId
        );

        if (count($this->getDbTable()->fetchAll($mWhere)) > 0) {
            return true;
        }

        return false;
    }

    public function delete($iGroupId, $iQuestionId)
    {
        $aWhere = array();
        $aWhere[] = $this->getDbTable()->getAdapter()->quoteInto('question_id = ?', $iQuestionId);
        $aWhere[] = $this->getDbTable()->getAdapter()->quoteInto('question_group_id = ?', $iGroupId);

        $this->getDbTable()->delete($aWhere);
    }

    public static function mapEntriesToModels(Zend_Db_Table_Rowset_Abstract $oRows)
    {
        $aEntries = array();
        foreach ($oRows as $oRow) {
            $aEntries[] = self::mapObjectToModel($oRow);
        }
        return $aEntries;
    }

    public static function mapObjectToModel(Zend_Db_Table_Row_Abstract $oRow, Application_Model_Question_Group $oGroup = null)
    {
        if (null === $oGroup) {
            $oGroup = new Application_Model_Question_2Group();
        }
        $oGroup->setQuestionId($oRow->question_id)->setQuestionGroupId($oRow->question_group_id)->setCreated($oRow->date_input);

        return $oGroup;
    }
}