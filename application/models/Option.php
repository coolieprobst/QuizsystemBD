<?php

class Application_Model_Option extends Application_Model_Abstract
{
    /**
     * @var int
     */
    protected $_optionId;

    /**
     * @var int
     */
    protected $_questionId;

    /**
     * @var type
     */
    protected $_type;

    /**
     * @var string
     */
    protected $_typeName;

    /**
     * @var array
     */
    protected $_options;

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

    public function setOptionId($iOptionId)
    {
        $this->_optionId = $iOptionId;
        return $this;
    }

    public function getOptionId()
    {
        return $this->_optionId;
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

    public function setType($iType)
    {
        $this->_type = $iType;
        return $this;
    }

    public function getType()
    {
        return $this->_type;
    }

    /**
     * @return string
     */
    public function getTypeName()
    {
        return $this->_typeName;
    }

    /**
     * @param string $typeName
     */
    public function setTypeName($typeName)
    {
        $this->_typeName = $typeName;
    }

    public function setOptions(array $aOptions)
    {
        $this->_options = $aOptions;
        return $this;
    }

    public function getOptions()
    {
        return $this->_options;
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

    public function getOptionIds2Question($iQuestionId)
    {
        return $this->getMapper()->getOptionIds2Question($iQuestionId);
    }
}