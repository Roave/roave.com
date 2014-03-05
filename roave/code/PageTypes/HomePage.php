<?php
class HomePage extends Page {
	private static $has_many = array(
		"Sections" => "HomePageSection",
	);
	
	public function getCMSFields() {
		$fields = parent::getCMSFields();
		
		$fields->addFieldsToTab('Root.Main', array(
			GridField::create("Sections", "Sections", $this->Sections(), GridFieldConfig_RelationEditor::create()),
		), 'Content');
				
		$fields->removeByName("Content");		
		
		return $fields;
	}
}

class HomePage_Controller extends Page_Controller {

}
