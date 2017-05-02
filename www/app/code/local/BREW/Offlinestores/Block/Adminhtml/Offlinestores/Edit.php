<?php
class BREW_Offlinestores_Block_Adminhtml_Offlinestores_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_objectId = 'block_id';
        $this->_blockGroup = 'offlinestores';
        $this->_controller = 'adminhtml_offlinestores';

        parent::__construct();

        $this->_updateButton('save', 'label', Mage::helper('BREW_Offlinestores')->__('Save'));
        $this->_updateButton('delete', 'label', Mage::helper('BREW_Offlinestores')->__('Delete'));

        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('BREW_Offlinestores')->__('Save and Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    /**
     * Get edit form container header text
     *
     * @return string
     */
    public function getHeaderText()
    {
        if (Mage::registry('offlinestores_block')->getId()) {
            return Mage::helper('BREW_Offlinestores')->__("Edit Offline Store '%s'", $this->escapeHtml(Mage::registry('offlinestores_block')->getTitle()));
        }
        else {
            return Mage::helper('BREW_Offlinestores')->__('Add Offline Store');
        }
    }

}
