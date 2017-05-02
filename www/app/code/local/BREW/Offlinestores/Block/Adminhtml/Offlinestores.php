<?php
//grid container
class BREW_Offlinestores_Block_Adminhtml_Offlinestores extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct()
    {
        $this->_controller = 'adminhtml_offlinestores';
        $this->_blockGroup = 'offlinestores';
        $this->_headerText = Mage::helper('BREW_Offlinestores')->__('Offline Stores');
        $this->_addButtonLabel = Mage::helper('BREW_Offlinestores')->__('Add Offline Store');
        parent::__construct();
    }

}
