<?php
class CompanyClient extends DataObject {
	private static $summary_fields = array(
		"Title"
	);

	private static $db = array(
		"Title" => "Varchar(255)",
		"Description" => "HTMLText",
		"Link" => "Text",
	);
	
	private static $has_one = array(
		"Logo" => "Image"
	);
	
	public function getCMSFields() {
		$fields = FieldList::create(TabSet::create("Root"));
		
		$fields->addFieldsToTab("Root.Main", array(
			TextField::create("Title"),
			TextField::create("Link"),
			UploadField::create("Logo"),
			HTMLEditorField::create("Description"),
		));
		
		$this->extend('updateCMSFields', $fields);
		
		return $fields;
	}
}
