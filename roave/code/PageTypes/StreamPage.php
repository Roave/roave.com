<?php
class StreamPage extends Page {
	private static $db = array(
		"Channel" => "Varchar"
	);
	
	public function getCMSFields() {
		$fields = parent::getCMSFields();
		
		$fields->addFieldsToTab("Root.Main", array(
			TextField::create("Channel", "Twitch Channel")
		), "Content");
		
		$fields->removeByName("Content");
		
		return $fields;
	}
}

class StreamPage_Controller extends Page_Controller {

}
