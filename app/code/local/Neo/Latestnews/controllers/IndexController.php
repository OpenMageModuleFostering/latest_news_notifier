<?php
class Neo_Latestnews_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
		$this->getResponse()->setHeader('HTTP/1.1','404 Not Found');
		$this->getResponse()->setHeader('Status','404 File not found');
		$pageId = Mage::getStoreConfig('web/default/cms_no_route');
		if (!Mage::helper('cms/page')->renderPage($this, $pageId)) {
		    $this->_forward('defaultNoRoute');
		}
    }

	public function notifytimerAction() {
		//echo "<pre>";
		$collection = Mage::getModel('latestnews/latestnews')->getCollection()
					->addFieldToFilter('status','1')
					->load();
		$array_random = $final_return = array();
		$random_decider = array(1 => 1,2 => 2,3=>3);
		//$random_key_main = array_rand($random_decider);
		$random_key_main = 1;
		if($random_key_main == 1) // Big Notifier
		{
			foreach ($collection as $obj)
			{	
				$array_random[$obj->getId()] = $obj->getId();
			}
			$random_key = array_rand($array_random);
			$collection_main = Mage::getModel('latestnews/latestnews')->load($random_key);
			
			$final_return = array('title'=>$collection_main->getTitle(),'description'=>$collection_main->getText(),'code'=>$collection_main->getCode());
			
			//echo $random_key;
			//print_r($collection_main->getData());
		}
		elseif($random_key_main == 2)
		{ 
			$url_sp = Mage::getUrl().'rss/catalog/special/store_id/1/cid/0/'; //Special Products RSS
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url_sp);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$output = curl_exec($ch);
			curl_close($ch);
			$xml = simplexml_load_string($output,'SimpleXMLElement', LIBXML_NOCDATA);
			$itemArray = $xml->channel;
			$objToArray = (array)$itemArray;
			$arrKeys = array_keys($objToArray['item']);
			$randomValue = array_rand($arrKeys);
			$arrDetails = $objToArray['item'][$randomValue];
			
			$final_return['title'] = (string)$arrDetails->title;
			$final_return['description'] = (string)strip_tags($arrDetails->description,'<p><a><span>');
			$final_return['code'] = 'small';
		}
		elseif($random_key_main == 3)
		{
			$url_dsc = Mage::getUrl().'rss/catalog/salesrule/store_id/1/cid/0/'; //Discount RSS
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url_dsc);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$output = curl_exec($ch);
			curl_close($ch);
			$xml = simplexml_load_string($output,'SimpleXMLElement', LIBXML_NOCDATA);
			$itemArray = $xml->channel;
			$objToArray = (array)$itemArray;
			$arrKeys = array_keys($objToArray['item']);
			$randomValue = array_rand($arrKeys);
			$arrDetails = $objToArray['item'][$randomValue];
			
			$final_return['title'] = (string)$arrDetails->title;
			$final_return['description'] = (string)$arrDetails->description;
			$final_return['code'] = 'small';
		}
		
		//print_r($final_return);		
		$jsonarr = json_encode($final_return);
		$this->getResponse()->setBody($jsonarr);
		
	}
}