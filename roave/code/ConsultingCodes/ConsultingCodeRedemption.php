<?php
class ConsultingCodeRedemption extends DataObject {
	private static $db = array(
		'Name' => 'Text',
		'Email' => 'Text',
	);
	
	private static $has_one = array(
		'Code' => 'ConsultingCode',
	);
	
	public function getCMSFields() {
		$fields = new FieldList(new TabSet("Root"));
		
		$fields->addFieldsToTab("Root.Main", array(
			new TextField('Name'),
			new EmailField('Email'),
			new DropdownField('CodeID', 'Code', ConsultingCode::get()->map('ID', 'Code')),
		));
		
		$this->extend('updateCMSFields', $fields);
		
		return $fields;
	}
}
