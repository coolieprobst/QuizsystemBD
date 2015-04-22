<?php

class AdminController extends Zend_Controller_Action
{
    public function indexAction()
    {
        // Show all groups.
        $oGroups = new Service_Group();
        $this->view->oGroups = $oGroups->getAllGroups();

        // Show all questions.
        $oServiceQuestion = new Service_Question();
        $this->view->oQuestions = $oServiceQuestion->getAllQuestions();
    }

    public function addAction()
    {
        if (!$this->hasParam('id')) {
            $this->redirect('/admin');
        }

        $oServiceQuestion = new Service_Question();
        $oServiceGroup = new Service_Group();
        $oGroup = $oServiceGroup->getGroupByFakeId($this->getParam('id'));

        if ($this->hasParam('id') && $this->hasParam('question')) {
            $oServiceGroup->addRemoveFromGroup($oGroup->getId(), $this->getParam('question'));

            $this->redirect('/admin/add/id/' . $oGroup->getFakeId());
        }

        $oQuestions = $oServiceQuestion->getAllQuestions($oGroup->getId());

        $this->view->oGroup = $oGroup;
        $this->view->oQuestions = $oQuestions;
    }

    public function groupAction()
    {
        $oForm = new Application_Form_Group();
        $oServiceGroup = new Service_Group();
        $oGroup = null;

        if ($this->hasParam('id')) {
            $oGroup = $oServiceGroup->getGroupByFakeId($this->getParam('id'));

            if ($oGroup) {
                $oForm->populate(array('name' => $oGroup->getName()));
            }
        }

        if ($this->getRequest()->isPost()) {
            if ($oForm->isValid($this->getRequest()->getPost())) {
                if (is_null($oGroup)) {
                    $oGroup = new Application_Model_Question_Group();
                }

                $oGroup->setName($oForm->getValue('name'));
                $oGroup->save();

                $this->_helper->getHelper('FlashMessenger')->addMessage('Ihre Gruppe wurde erfolgreich angelegt/aktualisiert.');
                $this->redirect('/admin');
            }
        }

        $this->view->oForm = $oForm;
    }

    public function questionAction()
    {
        $oForm = new Application_Form_Question();
        $oServiceQuestion = new Service_Question();
        $oQuestion = null;

        if ($this->hasParam('id')) {
            $oQuestion = $oServiceQuestion->getQuestion($this->getParam('id'));

            if ($oQuestion) {
                $oForm->populate(array('question' => $oQuestion->getQuestion()));
            }
        }

        if ($this->getRequest()->isPost()) {
            if ($oForm->isValid($this->getRequest()->getPost())) {
                if (is_null($oQuestion)) {
                    $oQuestion = new Application_Model_Question();
                }

                $oQuestion->setQuestion($oForm->getValue('question'));
                $oQuestion->save();

                $this->_helper->getHelper('FlashMessenger')->addMessage('Ihre Frage wurde erfolgreich angelegt/aktualisiert.');
                $this->redirect('/admin');
            }
        }

        $this->view->oForm = $oForm;
    }
}