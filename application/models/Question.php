<?php

class Application_Model_Question extends Application_Model_Abstract
{
    /**
     * @var int
     */
    protected $_id;

    /**
     * @var string
     */
    protected $_question;

    /**
     * @var Application_Model_Option
     */
    protected $_questionOptions;

    /**
     * @var bool
     */
    protected $_isInGroup;

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

    public function setId($id)
    {
        $this->_id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function setQuestion($sQuestion)
    {
        $this->_question = (string) $sQuestion;
        return $this;
    }

    public function getQuestion()
    {
        return $this->_question;
    }

    /**
     * @return Application_Model_Option
     */
    public function getQuestionOptions()
    {
        return $this->_questionOptions;
    }

    /**
     * @param Application_Model_Option $questionOptions
     */
    public function setQuestionOptions($questionOptions)
    {
        $this->_questionOptions = $questionOptions;
    }

    /**
     * @return boolean
     */
    public function getIsInGroup()
    {
        return $this->_isInGroup;
    }

    /**
     * @param boolean $isInGroup
     */
    public function setIsInGroup($isInGroup)
    {
        $this->_isInGroup = $isInGroup;
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
}