<?php
class Neo_Latestnews_Block_Adminhtml_Latestnews_Renderer_Content extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
	public function render(Varien_Object $row)
	{ 
		return strip_tags($row->getText());
	}
}