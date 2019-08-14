<?php

class Neo_Latestnews_Block_Adminhtml_Latestnews_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('latestnewsGrid');
      $this->setDefaultSort('latestnews_id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('latestnews/latestnews')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('latestnews_id', array(
          'header'    => Mage::helper('latestnews')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'latestnews_id',
      ));

      $this->addColumn('title', array(
          'header'    => Mage::helper('latestnews')->__('Title'),
          'align'     =>'left',
          'index'     => 'title',
      ));

	  
      $this->addColumn('text', array(
			'header'    => Mage::helper('latestnews')->__('Item Content'),
			'index'     => 'text',
			'renderer'	=>'latestnews/adminhtml_latestnews_renderer_content',
      ));
	  

      $this->addColumn('status', array(
          'header'    => Mage::helper('latestnews')->__('Status'),
          'align'     => 'left',
          'width'     => '80px',
          'index'     => 'status',
          'type'      => 'options',
          'options'   => array(
              1 => 'Enabled',
              2 => 'Disabled',
          ),
      ));
	  
        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('latestnews')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('latestnews')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
		
		$this->addExportType('*/*/exportCsv', Mage::helper('latestnews')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('latestnews')->__('XML'));
	  
      return parent::_prepareColumns();
  }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('latestnews_id');
        $this->getMassactionBlock()->setFormFieldName('latestnews');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('latestnews')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('latestnews')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('latestnews/status')->getOptionArray();

        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
             'label'=> Mage::helper('latestnews')->__('Change status'),
             'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
             'additional' => array(
                    'visibility' => array(
                         'name' => 'status',
                         'type' => 'select',
                         'class' => 'required-entry',
                         'label' => Mage::helper('latestnews')->__('Status'),
                         'values' => $statuses
                     )
             )
        ));
        return $this;
    }

  public function getRowUrl($row)
  {
      return $this->getUrl('*/*/edit', array('id' => $row->getId()));
  }

}