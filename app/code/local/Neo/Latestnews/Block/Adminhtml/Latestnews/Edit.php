<?php

class Neo_Latestnews_Block_Adminhtml_Latestnews_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'latestnews';
        $this->_controller = 'adminhtml_latestnews';
        
        $this->_updateButton('save', 'label', Mage::helper('latestnews')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('latestnews')->__('Delete Item'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('latestnews_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'latestnews_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'latestnews_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }
	
	protected function _prepareLayout() {
        parent::_prepareLayout();
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
    }
	
    public function getHeaderText()
    {
        if( Mage::registry('latestnews_data') && Mage::registry('latestnews_data')->getId() ) {
            return Mage::helper('latestnews')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('latestnews_data')->getTitle()));
        } else {
            return Mage::helper('latestnews')->__('Add Item');
        }
    }
}