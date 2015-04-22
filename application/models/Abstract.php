<?php

abstract class Application_Model_Abstract
{
    protected $_mapper;

    /**
     * Class Constructor.
     *
     * @param array $options
     * @return void
     */
    public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }

        return $this;
    }

    /**
     * Set data mapper.
     *
     * @param  mixed $mapper
     * @return Application_Model_*
     */
    public function setMapper($mapper)
    {
        $this->_mapper = $mapper;
        return $this;
    }

    /**
     * Get data mapper.
     *
     * @return Application_Model_*
     */
    public function getMapper()
    {
        if (null === $this->_mapper) {
            throw new Exception('Mapper not set.');
        }
        return $this->_mapper;
    }

    /**
     * Save the current entry.
     *
     * @return void
     */
    public function save()
    {
        $this->getMapper()->save($this);
    }

    /**
     * Find a entr.
     *
     * Resets entry state if matching id found.
     *
     * @param  int $id
     * @return Application_Model_*
     */
    public function find($id)
    {
        $this->getMapper()->find($id, $this);
        return $this;
    }

    /**
     * Fetch all questions.
     *
     * @return array
     */
    public function fetchAll()
    {
        return $this->getMapper()->fetchAll();
    }
}