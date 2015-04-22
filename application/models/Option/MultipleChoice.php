<?php

class Application_Model_Option_MultipleChoice extends Application_Model_Abstract
{
    /**
     * @var int
     */
    protected $_optionMcId;

    /**
     * @var int
     */
    protected $_optionId;

    /**
     * @var string
     */
    protected $_text;

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
    public function getOptionMcId()
    {
        return $this->_optionMcId;
    }

    /**
     * @param int $optionMcId
     */
    public function setOptionMcId($optionMcId)
    {
        $this->_optionMcId = $optionMcId;
    }

    /**
     * @return int
     */
    public function getOptionId()
    {
        return $this->_optionId;
    }

    /**
     * @param int $optionId
     */
    public function setOptionId($optionId)
    {
        $this->_optionId = $optionId;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->_text;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->_text = $text;
    }

    /**
     * Fetch all questions.
     *
     * @return array
     */
    public function fetchOptions($iOptionId)
    {
        return $this->getMapper()->fetchOptions($iOptionId);
    }
}