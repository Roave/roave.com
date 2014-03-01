<?php
class TeamDocument extends DataObject {
	private static $db = array(
		"Name" => "VarChar(255)",
	);
	
	private static $has_one = array(
		"TemplateDocument" => "File",
	);
	
	private static $has_many = array(
		"CompletedDocuments" => "CompletedDocument",
	);
	
	public function getCMSFields() {
		$fields = FieldList::create(TabSet::create("Root"));
		
		$fields->addFieldsToTab("Root.Main", array(
			TextField::create("Name"),
			UploadField::create("TemplateDocument", "Template Document"),
		));
		
		if($this->ID) {
			$fields->addFieldsToTab("Root.Completed", array(
				GridField::create("CompletedDocuments", "Completed", $this->CompletedDocuments(), $completedConfig = GridFieldConfig_RelationEditor::create())
			));
			
			$completedConfig->getComponentByType("GridFieldDataColumns")
				->setDisplayFields(array(
					"Created" => "Added",
					"Member.Title" => "Team Member",
				))
				->setFieldFormatting(array(
					"Member.Title" => function($value, $listItem) {
						return $listItem->Member()->Title;
					}
				));
		}
		
		$this->extend('updateCMSFields', $fields);
		
		return $fields;
	}
}
