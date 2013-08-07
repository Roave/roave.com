<?php
class TeamPage extends Page {
	private static $many_many = array(
		"TeamMembers" => "TeamMember"
	);
	
	public function getCMSFields() {
		$fields = parent::getCMSFields();
		
		$fields->addFieldsToTab("Root.Main", array(
			GridField::create("TeamMembers", "Team Members", $this->TeamMembers(), $teamMembersConfig = GridFieldConfig_RelationEditor::create())
		), "Content");
		
		$teamMembersConfig->removeComponentsByType("GridFieldAddNewButton");
		
		$fields->removeByName("Content");
		
		return $fields;
	}
}

class TeamPage_Controller extends Page_Controller {

}
