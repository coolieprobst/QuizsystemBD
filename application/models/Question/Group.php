<?php

class Application_Model_Question_Group extends Application_Model_Abstract
{
    /**
     * @var int
     */
    protected $_id;

    /**
     * @var string
     */
    protected $_fakeId;

    /**
     * @var string
     */
    protected $_name;

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

    public function setFakeId($id)
    {
        $this->_fakeId = $id;
        return $this;
    }

    public function getFakeId()
    {
        return $this->_fakeId;
    }

    public function setName($sName)
    {
        $this->_name = (string) $sName;
        return $this;
    }

    public function getName()
    {
        return $this->_name;
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

    /**
     * Find a question by fake id.
     *
     * Resets entry state if matching id found.
     *
     * @param  int $id
     * @return Application_Model_Question
     */
    public function findByFakeId($sFakeId)
    {
        $this->getMapper()->findByFakeId($sFakeId, $this);
        return $this;
    }
}