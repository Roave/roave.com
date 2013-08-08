<?php
class TeamPage extends Page {
	public function getCMSFields() {
		$fields = parent::getCMSFields();
		
		$fields->removeByName("Content");
		
		return $fields;
	}
	
	public function TeamMembers() {
		return TeamMember::get();
	}
}

class TeamPage_Controller extends Page_Controller {

}
