<?php

class Service_Question
{
    protected $_oModelQuestion;

    public function __construct() {
        $this->_oModelQuestion = new Application_Model_Question();
    }

    /**
     * Get all questions.
     *
     * @return Application_Model_Question|array
     */
    public function getAllQuestions($iIsInGroupGroupId = null) {
        $oQuestions = $this->_oModelQuestion->fetchAll();

        foreach ($oQuestions as $oQuestion) {
            $oQuestion->setQuestionOptions($this->getQuestionOptions($oQuestion->getId()));

            if (!is_null($iIsInGroupGroupId)) {
                $oQuestion->setIsInGroup($this->isQuestionInGroup($iIsInGroupGroupId, $oQuestion->getId()));
            }
        }

        return $oQuestions;
    }

    /**
     * Get Question with options.
     *
     * @param $iQuestionId
     * @return Application_Model_
     */
    public function getQuestion($iQuestionId) {
        $oQuestion = new Application_Model_Question();
        $oQuestion->setMapper(new Application_Model_QuestionMapper());

        // Load question.
        $oResultQuestion = $oQuestion->find($iQuestionId);

        // Load and set options to question.
        $oResultQuestion->setQuestionOptions($this->getQuestionOptions($iQuestionId));

        return $oResultQuestion;
    }

    /**
     * Get options to question.
     *
     * @param $iQuestionId
     */
    public function getQuestionOptions($iQuestionId) {
        $oServiceOption = new Service_Option();
        return $oServiceOption->getOptions2Question($iQuestionId);
    }

    /**
     * Get questions to group-fake-id.
     *
     * @param $sGroupFakeId
     * @return array
     */
    public function getQuestions2Group($sGroupFakeId) {
        $aQuestions = array();

        $oServiceGroup = new Service_Group();
        $oQuestionGroup = $oServiceGroup->getGroupByFakeId($sGroupFakeId);

        $aIds = $oServiceGroup->getQuestionIds2Group($oQuestionGroup->getId());

        foreach ($aIds as $iId) {
            $aQuestions[] = $this->getQuestion($iId);
        }

        return $aQuestions;
    }

    public function isQuestionInGroup($iGroupId, $iQuestionId) {
        $oModelQuestion2Group = new Application_Model_Question_2Group();
        return $oModelQuestion2Group->isInGroup($iGroupId, $iQuestionId);
    }
}