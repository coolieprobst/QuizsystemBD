<?php

class Application_Model_Option_Type extends Application_Model_Abstract
{
    /**
     * @var int
     */
    protected $_type;

    /**
     * @var string
     */
    protected $_typeName;

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

    public function setType($iType)
    {
        $this->_type = $iType;
        return $this;
    }

    public function getType()
    {
        return $this->_type;
    }

    public function setTypeName($sTypeName)
    {
        $this->_typeName = $sTypeName;
        return $this;
    }

    public function getTypeName()
    {
        return $this->_typeName;
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