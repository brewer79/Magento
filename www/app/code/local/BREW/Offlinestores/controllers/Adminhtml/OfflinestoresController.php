<?php

class BREW_Offlinestores_Adminhtml_OfflinestoresController extends Mage_Adminhtml_Controller_Action {

    public function indexAction()
    {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('offlinestores/adminhtml_offlinestores'));
        $this->renderLayout();
    }

    /*public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('offlinestores/adminhtml_offlinestores_grid')->toHtml()
        );
    }*/

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $id = (int)$this->getRequest()->getParam('block_id');
        Mage::register('offlinestores_block',Mage::getModel('offlinestores/block')->load($id));
        $blockObject = (array)Mage::getSingleton('adminhtml/session')->getBlockObject(true);
        if(count($blockObject)) {
            Mage::registry('offlinestores_block')->setData($blockObject);
        }
        $this->loadLayout();
        //$this->_addLeft($this->getLayout()->createBlock('offlinestores/adminhtml_offlinestores_edit_tabs'));
        $this->_addContent($this->getLayout()->createBlock('offlinestores/adminhtml_offlinestores_edit'));
        $this->renderLayout();
    }

    public function saveAction()
    {
        try {
            $id = $this->getRequest()->getParam('block_id');
            $block = Mage::getModel('offlinestores/block')->load($id);
            /*$block
                ->setTitle($this->getRequest()->getParam('title'))
                ->setContent($this->getRequest()->getParam('content'))
                ->setBlockStatus($this->getRequest()->getParam('block_status'))
                ->save();*/
            $block
                ->setData($this->getRequest()->getParams())
                //->setCreatedAt(Mage::app()->getLocale()->date())
                ->save();

            if(!$block->getId()) {
                Mage::getSingleton('adminhtml/session')->addError('Cannot save the block');
            }
        } catch(Exception $e) {
            Mage::logException($e);
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            Mage::getSingleton('adminhtml/session')->setBlockObject($block->getData());
            return  $this->_redirect('*/*/edit',array('block_id'=>$this->getRequest()->getParam('block_id')));
        }

        Mage::getSingleton('adminhtml/session')->addSuccess('Block was saved successfully!');

        $this->_redirect('*/*/'.$this->getRequest()->getParam('back','index'),array('block_id'=>$block->getId()));
    }


    public function deleteAction()
    {
        $block = Mage::getModel('offlinestores/block')
            ->setId($this->getRequest()->getParam('block_id'))
            ->delete();
        if($block->getId()) {
            Mage::getSingleton('adminhtml/session')->addSuccess('Block was deleted successfully!');
        }
        $this->_redirect('*/*/');

    }

    public function settingsAction()
    {
        Mage::app()->getResponse()->setRedirect(Mage::helper('adminhtml')->getUrl('*/system_config/index/'));
    }

    public function stateAction() {
        $countrycode = $this->getRequest()->getParam('country');
        $state = "<option value=''>Please Select</option>";
        if ($countrycode != '') {
            $statearray = Mage::getModel('directory/region')->getResourceCollection() ->addCountryFilter($countrycode)->load();
            foreach ($statearray as $_state) {
                $state .= "<option value='" . $_state->getCode() . "'>" .  $_state->getDefaultName() . "</option>";
            }
        }
        echo $state;
    }
}