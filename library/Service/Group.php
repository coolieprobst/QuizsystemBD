<?php

class Service_Group
{
    protected $_oModelQuestionGroup;
    protected $_oModelQuestion2Group;

    public function __construct() {
        $this->_oModelQuestionGroup = new Application_Model_Question_Group();
        $this->_oModelQuestion2Group = new Application_Model_Question_2Group();
    }

    public function addRemoveFromGroup($iGroupId, $iQuestionId) {
        $oServiceQuestion = new Service_Question();

        if ($oServiceQuestion->isQuestionInGroup($iGroupId, $iQuestionId)) {
            $this->_oModelQuestion2Group->delete($iGroupId, $iQuestionId);
        } else {
            $oQuestion2Group = new Application_Model_Question_2Group();
            $oQuestion2Group->setQuestionId($iQuestionId);
            $oQuestion2Group->setQuestionGroupId($iGroupId);
            $oQuestion2Group->save();
        }
    }

    /**
     * Get group by fake_id.
     *
     * @param $sFakeId
     * @return Application_Model_Question
     */
    public function getGroupByFakeId($sFakeId) {
        return $this->_oModelQuestionGroup->findByFakeId($sFakeId);
    }

    /**
     * Get question_ids to group_id.
     *
     * @param $iGroupId
     * @return array
     */
    public function getQuestionIds2Group($iGroupId) {
        $oResult = $this->_oModelQuestion2Group->fetchAll2Group($iGroupId);

        $aIds = array();
        foreach ($oResult as $oEntry) {
            $aIds[] = $oEntry->getQuestionId();
        }

        return $aIds;
    }
}