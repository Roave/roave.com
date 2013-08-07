<?php
class Certification extends DataObject {
	private static $db = array(
		"Title" => "Varchar",
		"Class" => "Varchar"
	);
	
	public function getCMSFields() {
		$fields = new FieldList(new TabSet("Root"));
		
		$fields->addFieldsToTab("Root.Main", array(
			TextField::create("Title"),
			TextField::create("Class")
		));
		
		$this->extend('updateCMSFields', $fields);
		
		return $fields;
	}
}
