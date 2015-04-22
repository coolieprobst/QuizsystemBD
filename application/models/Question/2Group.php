<?php

class Application_Model_Question_2Group extends Application_Model_Abstract
{
    /**
     * @var int
     */
    protected $_question2GroupId;

    /**
     * @var int
     */
    protected $_questionId;

    /**
     * @var int
     */
    protected $_questionGroupId;

    /**
     * @var string
     */
    protected $_created;

    /**
     * Class Constructor.
     *
     * @param array $options
     * @return void
     */
    public function __construct(array $options = null)
    {
        parent::__construct($options);
        $sMapperName = get_class($this) . 'Mapper';
        $this->setMapper(new $sMapperName);
    }

    /**
     * @return int
     */
    public function getQuestion2GroupId()
    {
        return $this->_question2GroupId;
    }

    /**
     * @param int $question2GroupId
     */
    public function setQuestion2GroupId($question2GroupId)
    {
        $this->_question2GroupId = $question2GroupId;
    }

    public function setQuestionId($iQuestionId)
    {
        $this->_questionId = $iQuestionId;
        return $this;
    }

    public function getQuestionId()
    {
        return $this->_questionId;
    }

    public function setQuestionGroupId($iQuestionGroupId)
    {
        $this->_questionGroupId = $iQuestionGroupId;
        return $this;
    }

    public function getQuestionGroupId()
    {
        return $this->_questionGroupId;
    }

    public function setCreated($iTimestamp)
    {
        $this->_created = $iTimestamp;
        return $this;
    }

    public function getCreated()
    {
        return $this->_created;
    }

    public function isInGroup($iGroupId, $iQuestionId)
    {
        return $this->getMapper()->isInGroup($iGroupId, $iQuestionId);
    }

    public function delete($iGroupId, $iQuestionId)
    {
        $this->getMapper()->delete($iGroupId, $iQuestionId);
    }

    public function fetchAll2Group($iGroupId)
    {
        return $this->getMapper()->fetchAll2Group($iGroupId);
    }
}