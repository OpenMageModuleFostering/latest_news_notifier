<?php

class Neo_Latestnews_Model_Mysql4_Latestnews extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the latestnews_id refers to the key field in your database table.
        $this->_init('latestnews/latestnews', 'latestnews_id');
    }
}