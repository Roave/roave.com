<?php
class TeamMember extends DataObject {
	private static $db = array(
		"Name" => "Varchar",
		"Alias" => "Varchar",
		"Email" => "Varchar",
		"ZCEID" => "Varchar",
		"Bio" => "HTMLText",
		"GitHub" => "Text",
		"Twitter" => "Text",
		"Blog" => "Text"
	);
	
	private static $many_many = array(
		"Certifications" => "Certification"
	);
	
	public function getCMSFields() {
		$fields = new FieldList(new TabSet("Root"));
		
		$fields->addFieldsToTab("Root.Main", array(
			TextField::create("Name"),
			TextField::create("Alias"),
			TextField::create("Email"),
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
