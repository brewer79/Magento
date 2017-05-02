<?php
class BREW_Offlinestores_Block_Adminhtml_Offlinestores_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('offlinestoresGrid');
        $this->setDefaultSort('block_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        //$this->setUseAjax(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('offlinestores/block')->getCollection();
        /* @var $collection Mage_Cms_Model_Mysql4_Block_Collection */
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $helper = Mage::helper('BREW_Offlinestores');

        $this->addColumn('block_id', array(
            'header'    => $helper->__('ID'),
            'align'     => 'center',
            'width'     => '10px',
            'index'     => 'block_id',
        ));

        $this->addColumn('name', array(
            'header'    => $helper->__('Name'),
            //'align'     =>'center',
            'width'     => '300px',
            'index'     => 'name',
        ));

        $this->addColumn('country', array(
            'header'    => $helper->__('Country'),
            'index'     => 'country',
            'width'     => '150px',
            'renderer' => 'adminhtml/widget_grid_column_renderer_country',
        ));

        $this->addColumn('city', array(
            'header'    => $helper->__('City'),
            'index'     => 'city',
            'width'     => '150px',
        ));

        $this->addColumn('street', array(
            'header'    => $helper->__('Street'),
            'index'     => 'street',
            'width'     => '250px',
        ));

        $this->addColumn('position', array(
            'header'    => $helper->__('Position'),
            'index'     => 'position',
            'width'     => '50px',
        ));

        $this->addColumn('block_status', array(
            'header'    => $helper->__('Status'),
            'index'     => 'block_status',
            'width'     => '150px',
            'type'      => 'options',
            'options'   => Mage::getModel('offlinestores/source_status')->toArray(),
        ));

        return parent::_prepareColumns();
    }


    /**
     * Row click url
     *
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('block_id' => $row->getId()));
    }

//    public function getGridUrl()
//    {
//        return $this->getUrl('*/*/grid', array('_current'=>true));
//    }
}
