<?php
class HomePage extends Page {
	private static $db = array(
		
	);
	
	public function getCMSFields() {
		$fields = parent::getCMSFields();
		
		$fields->removeByName("Content");
		
		return $fields;
	}
}

class HomePage_Controller extends Page_Controller {

}
