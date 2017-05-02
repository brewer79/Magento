<?php
class BREW_Offlinestores_Model_Resource_Block extends Mage_Core_Model_Mysql4_Abstract {

    public function _construct()
    {
        $this->_init('offlinestores/block', 'block_id');
    }
}