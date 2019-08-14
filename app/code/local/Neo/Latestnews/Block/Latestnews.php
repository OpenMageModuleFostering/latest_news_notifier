<?php
class Neo_Latestnews_Block_Latestnews extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getLatestnews()     
     { 
        if (!$this->hasData('latestnews')) {
            $this->setData('latestnews', Mage::registry('latestnews'));
        }
        return $this->getData('latestnews');
        
    }
}