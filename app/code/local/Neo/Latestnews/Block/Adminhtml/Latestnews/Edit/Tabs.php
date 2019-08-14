<?php

class Neo_Latestnews_Block_Adminhtml_Latestnews_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('latestnews_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('latestnews')->__('Item Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('latestnews')->__('Item Information'),
          'title'     => Mage::helper('latestnews')->__('Item Information'),
          'content'   => $this->getLayout()->createBlock('latestnews/adminhtml_latestnews_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}