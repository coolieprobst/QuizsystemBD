<?php

class Application_Form_Group extends Zend_Form
{
    public function init()
    {
        // Set the method for the display form to POST
        $this->setMethod('post');

        // add CSRF protection
        $this->addElement('hash', 'csrf', array(
            'ignore'     => true,
            'salt'       => 'post_salt'
        ));

        // Add a question element
        $this->addElement('text', 'name', array(
            'required'   => true,
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(0, 250))
            ),
            'placeholder'=> 'Gruppenbezeichnung'
        ));

        // Add the submit button
        $this->addElement('button', 'submit', array(
            'ignore'     => true,
            'type'       => 'submit',
            'label'      => 'Post',
            'class'      => 'btn'
        ));
    }
}