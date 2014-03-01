<?php
class TeamMember extends DataObject {
	private static $db = array(
		"Name" => "Varchar",
		"Alias" => "Varchar",
		"Email" => "Varchar",
		"Phone" => "Varchar",
		"TollFreeExtension" => "Int",
		"ZCEID" => "Varchar",
		"Bio" => "HTMLText",
		"GitHub" => "Text",
		"Twitter" => "Text",
		"Blog" => "Text",
		"Sort" => "Int"
	);
	
	private static $many_many = array(
		"Certifications" => "Certification"
	);
	
	private static $has_many = array(
		"CompletedDocuments" => "CompletedDocument",
	);
	
	private static $summary_fields = array(
		"Title",
		"Email"
	);
	
	private static $default_sort = "Sort ASC";
	
	public function getCMSFields() {
		$fields = new FieldList(new TabSet("Root"));
		
		$fields->addFieldsToTab("Root.Main", array(
			TextField::create("Name"),
			TextField::create("Alias"),
			TextField::create("Email"),
			TextField::create("Phone"),
			NumericField::create("TollFreeExtension"),
			TextField::create("ZCEID"),
			HTMLEditorField::create("Bio"),
			TextField::create("GitHub"),
			TextField::create("Twitter"),
			TextField::create("Blog"),
		));
		
		$fields->addFieldsToTab("Root.Certifications", array(
			GridField::create("Certifications", "Certifications", $this->Certifications(), $certificationsConfig = GridFieldConfig_RelationEditor::create())
		));
		
		$certificationsConfig->removeComponentsByType("GridFieldAddNewButton");
		
		$fields->addFieldsToTab("Root.Documents", array(
			GridField::create("CompletedDocuments", "Documents", $this->CompletedDocuments(), $completedDocumentsConfig = GridFieldConfig_RelationEditor::create())
		));
		
		$completedDocumentsConfig
			->removeComponentsByType("GridFieldAddNewButton")
			->getComponentByType("GridFieldDataColumns")
				->setDisplayFields(array(
					"Created" => "Added",
					"TeamDocument.Name" => "Document Name",
				))
				->setFieldFormatting(array(
					"TeamDocument.Name" => function($value, $listItem) {
						return $listItem->TeamDocument()->Name;
					}
				));
		
		$this->extend("updateCMSFields", $fields);
		
		return $fields;
	}
	
	public function getTitle() {
	    $title = $this->Name;
	    if($alias = $this->Alias) {
	        $title .= " ({$alias})";
	    }
	    
	    return $title;
	}
	
	public function getGravatarUrl() {
		return "http://www.gravatar.com/avatar/".md5(strtolower(trim($this->Email)));
	}
}
