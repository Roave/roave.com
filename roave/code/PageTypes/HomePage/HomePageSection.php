<?php
class HomePageSection extends DataObject {
	private static $db = array(
		"SectionId" => "Varchar(255)",
		"Content" => "HTMLText",
		"ButtonLink" => "Text",
		"ButtonText" => "Text",
	);
	
	private static $has_one = array(
		"HomePage" => "HomePage",
	);
	
	public function getCMSFields() {
		$fields = FieldList::create(TabSet::create("Root"));
		
		$fields->addFieldsToTab("Root.Main", array(
			TextField::create("SectionId", "Section ID"),
			HTMLEditorField::create("Content"),
			TextField::create("ButtonLink"),
			TextField::create("ButtonText"),
		));
		
		$this->extend('updateCMSFields', $fields);
		
		return $fields;
	}
}
