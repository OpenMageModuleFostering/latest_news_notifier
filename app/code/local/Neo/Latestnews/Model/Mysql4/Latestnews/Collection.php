<?php

class Neo_Latestnews_Model_Mysql4_Latestnews_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('latestnews/latestnews');
    }
}