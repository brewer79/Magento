<?php
class BREW_Offlinestores_Block_List extends Mage_Core_Block_Template
{
    /**
     * prepare  block`s layout
     *
     * @return BREW_Offlinestores_Block_List
     */
    public function __construct()
    {
        parent::__construct();
        $collection = Mage::getModel('offlinestores/block')->getCollection()
            ->addFieldToFilter('block_status',array('eq'=>BREW_Offlinestores_Model_Source_Status::ENABLED));
        $this->setCollection($collection);
    }
}