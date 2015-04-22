<?php

class Service_Option
{
    const OPTION_TYPE_MULTIPLE_CHOICE = 1;

    protected $_oModelOption;
    protected $_oModelOptionType;

    public function __construct() {
        $this->_oModelOption = new Application_Model_Option();
        $this->_oModelOptionType = new Application_Model_Option_Type();
    }

    /**
     * Get options 2 question.
     *
     * @param $iQuestionId
     */
    public function getOptions2Question($iQuestionId) {
        $oOptionEntries = $this->_oModelOption->getOptionIds2Question($iQuestionId);

        if (0 === count($oOptionEntries)) {
            return;
        }

        foreach ($oOptionEntries as $oEntry) {
            $oType = $this->_oModelOptionType->find($oEntry->getType());

            $sModelName = "Application_Model_Option_" . $oType->getTypeName();
            $oOptionModel = new $sModelName;
            $oEntry->setTypeName($oType->getTypeName());
            $oEntry->setOptions($oOptionModel->fetchOptions($oEntry->getOptionId()));
        }

        return $oOptionEntries;
    }
}