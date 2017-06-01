<?php
class BREW_Offlinestores_Block_Adminhtml_Offlinestores_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    /**
     * Init form
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('offlinestoresForm');
        $this->setTitle(Mage::helper('BREW_Offlinestores')->__('Offline Stores Settings'));
    }

    protected function _prepareForm()
    {
        $model = Mage::registry('offlinestores_block');

        $form = new Varien_Data_Form(
            array(
                'id' => 'edit_form',
                'action' => $this->getUrl('*/*/save',array('block_id'=>$this->getRequest()->getParam('block_id'))),
                'method' => 'post',
                'enctype' => 'multipart/form-data'
            )
        );

        $form->setHtmlIdPrefix('block_');

        /**
         * fieldset General
         */
        $fieldsetGeneral = $form->addFieldset('general_fieldset', array('legend'=>Mage::helper('BREW_Offlinestores')->__('General Information'), 'class' => 'fieldset-wide'));

        /*   if ($model->getBlockId()) {
               $fieldsetGeneral->addField('block_id', 'text', array(
                   'name' => 'block_id',
               ));
           }
    */
        $fieldsetGeneral->addField('name', 'text', array(
            'name'      => 'name',
            'label'     => Mage::helper('BREW_Offlinestores')->__('Name'),
            'title'     => Mage::helper('BREW_Offlinestores')->__('Name'),
            'required'  => true,
        ));

        $fieldsetGeneral->addField('image', 'file', array(
            'name'      => 'image',
            'label'     => Mage::helper('BREW_Offlinestores')->__('Image'),
            'title'     => Mage::helper('BREW_Offlinestores')->__('Image'),
            'required'  => false,
        ));

        $fieldsetGeneral->addField('short description', 'textarea', array(
            'name'      => 'short description',
            'label'     => Mage::helper('BREW_Offlinestores')->__('Short Description'),
            'title'     => Mage::helper('BREW_Offlinestores')->__('Short Description'),
            'style'     => 'width: 98%; height: 80px;',
            'required'  => true,
        ));

        $fieldsetGeneral->addField('description', 'editor', array(
            'name'      => 'description',
            'label'     => Mage::helper('BREW_Offlinestores')->__('Description'),
            'title'     => Mage::helper('BREW_Offlinestores')->__('Description'),
            'style'     => 'width: 98%; height: 80px;',
            'required'  => true,
            'config'    => Mage::getSingleton('cms/wysiwyg_config')->getConfig(),

        ));

        $fieldsetGeneral->addField('position', 'text', array(
            'name'      => 'position',
            'label'     => Mage::helper('BREW_Offlinestores')->__('Position'),
            'title'     => Mage::helper('BREW_Offlinestores')->__('Position'),
            'required'  => true,
            'class'     => 'validate-number',
        ));

        $fieldsetGeneral->addField('block_status', 'select', array(
            'name'      => 'block_status',
            'label'     => Mage::helper('BREW_Offlinestores')->__('Status'),
            'title'     => Mage::helper('BREW_Offlinestores')->__('Status'),
            'required'  => true,
            'options'   => Mage::getModel('offlinestores/source_status')->toArray(),
        ));

        /**
         * fieldset Address
         */
        $fieldsetAddress = $form->addFieldset('address_fieldset', array('legend'=>Mage::helper('BREW_Offlinestores')->__('Address Information'), 'class' => 'fieldset-wide'));


        $country = $fieldsetAddress->addField('country', 'select', array(
            'name'      => 'country',
            'label'     => Mage::helper('BREW_Offlinestores')->__('Country'),
            'title'     => Mage::helper('BREW_Offlinestores')->__('Country'),
            'values'	=> Mage::getModel('adminhtml/system_config_source_country')->toOptionArray(),
            'required'  => true,
            'onchange' => 'getstate(this)',
        ));

        /*    if (Mage::registry('offlinestores_block')->getData('state')) {
                $fieldsetAddress->addField('state/province', 'text', array(
                    'name'      => 'state/province',
                    'label'     => Mage::helper('BREW_Offlinestores')->__('State/Province'),
                    'title'     => Mage::helper('BREW_Offlinestores')->__('State/Province'),
                    'class' => 'required-entry',
                    'required' => false,
                ));
            } else {
                $statevalues = '';
                if (Mage::registry('offlinestores_block')->getData('store_image')) {
                    $regionModel = Mage::getModel('directory/region')->load(Mage::registry('offlinestores_block')->getData('store_image'));
                    $region = $regionModel->getName();
                    $statevalues = array(Mage::registry('offlinestores_block')->getData('store_image') => $region);
                }*/

        $fieldsetAddress->addField('state/province', 'text', array(
            'name' => 'state/province',
            'label' => Mage::helper('BREW_Offlinestores')->__('State/Province'),
            'title' => Mage::helper('BREW_Offlinestores')->__('State/Province'),
            //'value' => Mage::registry('offlinestores_block')->getData('region_id'),
            //'values' => $statevalues,
            'required' => false,
        ));
        //}

        /*   $country->setAfterElementHtml("<script type=\"text/javascript\">
           function getstate(selectElement){
               var reloadurl = '" . $this
                   ->getUrl('offlinestores/adminhtml_offlinestores/state') . "country/' + selectElement.value;
               new Ajax.Request(reloadurl, {
                   method: 'get',
                   onLoading: function (stateform) {
                       $('state').update('Searching...');
                   },
                   onComplete: function(stateform) {
                       $('state').replace(stateform.responseText);
                   }
               });
           }
           </script>");*/

        $fieldsetAddress->addField('city', 'text', array(
            'name'      => 'city',
            'label'     => Mage::helper('BREW_Offlinestores')->__('City'),
            'title'     => Mage::helper('BREW_Offlinestores')->__('City'),
            'required'  => true,
        ));

        $fieldsetAddress->addField('street', 'text', array(
            'name'      => 'street',
            'label'     => Mage::helper('BREW_Offlinestores')->__('Street'),
            'title'     => Mage::helper('BREW_Offlinestores')->__('Street'),
            'required'  => true,
        ));

        $fieldsetAddress->addField('zip code', 'text', array(
            'name'      => 'zip code',
            'label'     => Mage::helper('BREW_Offlinestores')->__('Zip Code'),
            'title'     => Mage::helper('BREW_Offlinestores')->__('Zip Code'),
            'required'  => true,
        ));

        $fieldsetAddress->addField('telephone', 'text', array(
            'name'      => 'telephone',
            'label'     => Mage::helper('BREW_Offlinestores')->__('Telephone'),
            'title'     => Mage::helper('BREW_Offlinestores')->__('Telephone'),
            'class'     => 'validate-phoneStrict',
        ));

        $fieldsetAddress->addField('longitude', 'text', array(
            'label'     => Mage::helper('BREW_Offlinestores')->__('Store Longitude'),
            'title'     => Mage::helper('BREW_Offlinestores')->__('Store Longitude'),
            'name'      => 'longitude',
            'required'  => true,
            'style'     => 'width: 45%',
            'class'     => 'required-entry',
        ));

        $fieldsetAddress->addField('latitude', 'text', array(
            'label'     => Mage::helper('BREW_Offlinestores')->__('Store Latitude'),
            'title'     => Mage::helper('BREW_Offlinestores')->__('Store Latitude'),
            'name'      => 'latitude',
            'required'  => true,
            'style'     => 'width: 45%',
            'class'     => 'required-entry',
        ));

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
        /*  add WYSIWYG editor */
        protected function _prepareLayout()
        {
            parent::_prepareLayout();
            if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
                $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
            }
        }


}
