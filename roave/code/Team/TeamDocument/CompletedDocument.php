<?php
class CompletedDocument extends DataObject {
	private static $has_one = array(
		"TeamDocument" => "TeamDocument",
		"Member" => "TeamMember",
		"File" => "File",
	);
	
	public function getCMSFields() {
		$fields = FieldList::create(TabSet::create("Root"));
		
		$fileName = $this->TeamDocument()->Name;
		$fileLink = $this->TeamDocument()->TemplateDocument()->URL;
		
		$fields->addFieldsToTab("Root.Main", array(
			LiteralField::create("DocumentLink", "<a href=\"{$fileLink}\" target=\"_blank\">{$fileName}</a>"),
			DropdownField::create("MemberID", "Member", TeamMember::get()->map("ID", "Title")),
			UploadField::create("File")
		));
		
		$this->extend('updateCMSFields', $fields);
		
		return $fields;
	}
	
	public function getTitle() {
		return $this->Member()->Title;
	}
}
