<?php

class IndexController extends Zend_Controller_Action
{
    public function indexAction()
    {
        $oServiceQuestionGroup = new Service_Group();
        $oGroup = $oServiceQuestionGroup->getGroupByFakeId("d3svYeje");

        $oServiceQuestion = new Service_Question();
        $oQuestions = $oServiceQuestion->getQuestions2Group("d3svYeje");

        $this->view->oGroup = $oGroup;
        $this->view->oQuestions = $oQuestions;
    }

    public function showAction()
    {
        if (!$this->hasParam('id')) {
            $this->redirect('/');
        }

        // TODO Check if group_fake_id exists and it is valid.
        $sGroupFakeId = $this->getParam('id');

        $oServiceQuestionGroup = new Service_Group();
        $oGroup = $oServiceQuestionGroup->getGroupByFakeId($sGroupFakeId);

        $oServiceQuestion = new Service_Question();
        $oQuestions = $oServiceQuestion->getQuestions2Group($sGroupFakeId);

        $this->view->oGroup = $oGroup;
        $this->view->oQuestions = $oQuestions;

        //$o = new Service_Option();
        //$o->getOptions2Question(1);
    }
}