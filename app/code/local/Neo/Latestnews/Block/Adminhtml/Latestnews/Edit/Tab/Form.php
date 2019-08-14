<?php

class Neo_Latestnews_Block_Adminhtml_Latestnews_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('latestnews_form', array('legend'=>Mage::helper('latestnews')->__('Item information')));
     
      $fieldset->addField('title', 'text', array(
          'label'     => Mage::helper('latestnews')->__('Title'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'title',
      ));
		
      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('latestnews')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('latestnews')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('latestnews')->__('Disabled'),
              ),
          ),
      ));
     
	 	$fieldset->addField('code', 'select', array(
          'label'     => Mage::helper('latestnews')->__('Notifier Type'),
          'name'      => 'code',
          'values'    => array(
			  array(
                  'value'     => 'big',
                  'label'     => Mage::helper('latestnews')->__('Big'),
              ),
              array(
                  'value'     => 'small',
                  'label'     => Mage::helper('latestnews')->__('Small'),
              ),              
          ),
      ));
	 
      $fieldset->addField('text', 'editor', array(
          'name'      => 'text',
          'label'     => Mage::helper('latestnews')->__('Content'),
          'title'     => Mage::helper('latestnews')->__('Content'),
          'style'     => 'width:700px; height:500px;',
          'wysiwyg'   => true,
          'required'  => true,
      ));
     
      if ( Mage::getSingleton('adminhtml/session')->getLatestnewsData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getLatestnewsData());
          Mage::getSingleton('adminhtml/session')->setLatestnewsData(null);
      } elseif ( Mage::registry('latestnews_data') ) {
          $form->setValues(Mage::registry('latestnews_data')->getData());
      }
      return parent::_prepareForm();
  }
}