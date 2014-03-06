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
	
	private static $many_many = array(
		"Clients" => "CompanyClient",
	);
	
	public function getCMSFields() {
		$fields = FieldList::create(TabSet::create("Root"));
		
		$fields->addFieldsToTab("Root.Main", array(
			TextField::create("SectionId", "Section ID"),
			HTMLEditorField::create("Content"),
			TextField::create("ButtonLink"),
			TextField::create("ButtonText"),
		));
		
		$fields->addFieldsToTab("Root.Clients", array(
			GridField::create("Clients", "Clients", $this->Clients(), GridFieldConfig_RelationEditor::create())
		));
		
		$this->extend('updateCMSFields', $fields);
		
		return $fields;
	}
}
