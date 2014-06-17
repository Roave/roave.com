<?php
class FooterConfig extends DataExtension {
	private static $db = array(
		"About" => "HTMLText",
		"Inquiries" => "HTMLText",
		"Contact" => "HTMLText",
	);
	
	public function updateCMSFields(FieldList $fields) {
		$fields->addFieldsToTab('Root.Footer', array(
		   HTMLEditorField::create("About"),
		   HTMLEditorField::create("Inquiries"),
		   HTMLEditorField::create("Contact"),
		));
	}
}
