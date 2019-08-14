<?php
class Neo_Latestnews_Block_Adminhtml_Latestnews extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_latestnews';
    $this->_blockGroup = 'latestnews';
    $this->_headerText = Mage::helper('latestnews')->__('Item Manager');
    $this->_addButtonLabel = Mage::helper('latestnews')->__('Add Item');
    parent::__construct();
  }
}