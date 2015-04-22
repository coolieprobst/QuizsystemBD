<?php

class Application_Model_Question_GroupMapper
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
            $this->setDbTable('Application_Model_DbTable_Question_Group');
        }

        return $this->_dbTable;
    }

    public function save(Application_Model_Question_Group $oGroup)
    {
        $aData = array(
            'name' => $oGroup->getName(),
        );

        if (null === ($iId = $oGroup->getId())) {
            unset($aData['question_id']);

            $sUniqueKey = $this->generateUniqueFakeId();

            // Check if key exists.
            while ($this->findByFakeId($sUniqueKey, $oGroup)) {
                $sUniqueKey = $this->generateUniqueFakeId();
            }

            $aData['question_group_fake_id'] = $sUniqueKey;
            $aData['date_input'] = date('Y-m-d H:i:s');
            $oGroup->setId($this->getDbTable()->insert($aData));
        } else {
            $this->getDbTable()->update($aData, array('question_group_id = ?' => $iId));
        }
    }

    public function find($iId, Application_Model_Question_Group $oGroup)
    {
        $oResult = $this->getDbTable()->find($iId);
        if (0 == count($oResult)) {
            return;
        }

        $oRow = $oResult->current();
        self::mapObjectToModel($oRow, $oGroup);
    }

    public function findByFakeId($sFakeId, Application_Model_Question_Group $oGroup)
    {
        $oResult = $this->getDbTable()->fetchRow($this->getDbTable()->select()->where('question_group_fake_id = ?', $sFakeId));

        if (0 == count($oResult)) {
            return;
        }

        $oRow = $oResult;
        self::mapObjectToModel($oRow, $oGroup);
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

    public static function mapObjectToModel(Zend_Db_Table_Row_Abstract $oRow, Application_Model_Question_Group $oGroup = null)
    {
        if (null === $oGroup) {
            $oGroup = new Application_Model_Question_Group();
        }
        $oGroup->setId($oRow->question_group_id)->setFakeId($oRow->question_group_fake_id)->setName($oRow->name)->setCreated($oRow->date_input);

        return $oGroup;
    }

    private function generateUniqueFakeId()
    {
        $iLength = 8;
        $sCharacters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $iCharactersLength = strlen($sCharacters);
        $sRandomString = '';

        for ($i = 0; $i < $iLength; $i++) {
            $sRandomString .= $sCharacters[rand(0, $iCharactersLength - 1)];
        }

        return $sRandomString;
    }
}