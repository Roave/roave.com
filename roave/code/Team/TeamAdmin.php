<?php
class TeamAdmin extends ModelAdmin {
	public static $menu_title = "Team";
	public static $url_segment = "team";

	public static $managed_models = array(
		"TeamMember",
		"Certification"
	);
	
	public static $allowed_actions = array(
		"EditForm"
	);
	
	public function EditForm($request = null) {
		$form = parent::EditForm($request);
		
		$gridField = $form->Fields()->fieldByName($this->modelClass);
		if($gridField) {
			$gridFieldConfig = $gridField->getConfig();
		}
		
		switch($this->modelClass) {
			case "TeamMember":
				$gridFieldConfig->addComponent(new GridFieldSortableRows("Sort"));
				break;
		}
		
		return $form;
	}
}
