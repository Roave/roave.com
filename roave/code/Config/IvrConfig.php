<?php
class IvrConfig extends DataExtension {
	private static $db = array(
		"IVR_IntroSoundId" => "Int",
		"IVR_Option_Emergency_SoundId" => "Int",
		"IVR_Option_Emergency_Extension" => "Int",
		"IVR_Option_Emergency_Number" => "Varchar",
		"IVR_Option_TechnicalSupport_SoundId" => "Int",
		"IVR_Option_TechnicalSupport_Extension" => "Int",
		"IVR_Option_TechnicalSupport_Number" => "Varchar",
		"IVR_Option_Sales_SoundId" => "Int",
		"IVR_Option_Sales_Extension" => "Int",
		"IVR_Option_Sales_Number" => "Varchar",
		"IVR_Option_TeamDirectory_SoundId" => "Int",
		"IVR_Option_TeamDirectory_Extension" => "Int",
		"IVR_Option_Humorous_SoundId" => "Int",
	);
	
	public function updateCMSFields(FieldList $fields) {
		$sounds = $this->getCallFireSounds();
		
		$soundIds = array();
		if($sounds) {
			foreach($sounds as $sound) {
				$soundIds[$sound->getId()] = $sound->getName();
			}
		}
		
		$fields->addFieldsToTab("Root.RoaveNumber.Config", array(
			DropdownField::create("IVR_IntroSoundId", "Intro Sound", $soundIds)->setHasEmptyDefault(true),
			DropdownField::create("IVR_Option_Emergency_SoundId", "Emergency Option Sound", $soundIds)->setHasEmptyDefault(true),
			NumericField::create("IVR_Option_Emergency_Extension", "Emergency Extension"),
			TextField::create("IVR_Option_Emergency_Number", "Emergency Number"),
			DropdownField::create("IVR_Option_TechnicalSupport_SoundId", "Technical Support Option Sound", $soundIds)->setHasEmptyDefault(true),
			NumericField::create("IVR_Option_TechnicalSupport_Extension", "Technical Support Extension"),
			TextField::create("IVR_Option_TechnicalSupport_Number", "Technical Support Number"),
			DropdownField::create("IVR_Option_Sales_SoundId", "Sales Option Sound", $soundIds)->setHasEmptyDefault(true),
			NumericField::create("IVR_Option_Sales_Extension", "Sales Extension"),
			TextField::create("IVR_Option_Sales_Number", "Sales Number"),
			DropdownField::create("IVR_Option_TeamDirectory_SoundId", "Team Directory Option Sound", $soundIds)->setHasEmptyDefault(true),
			NumericField::create("IVR_Option_TeamDirectory_Extension", "Team Directory Extension"),
			DropdownField::create("IVR_Option_Humorous_SoundId", "Humorous Option Sound", $soundIds)->setHasEmptyDefault(true),
		));
		
		$fields->addFieldToTab("Root.RoaveNumber.IVR", TextareaField::create("IVR_XML", "IVR XML", $this->getIvrXml()));
	}
	
	protected function getCallFireSounds() {
		$callClient = $this->owner->getCallFireClient('Call');
		$response = $callClient->QuerySoundMeta();
		$sounds = $callClient::response($response);
		
		return $sounds;
	}
	
	protected function getIvrXml() {
		$generator = new IvrGenerator;
		$ivr = $generator->generate();
		$ivr->formatOutput = true;
		
		$xml = $ivr->saveXML();
		
		$doctype = '<?xml version="1.0"?>';
		
		if(substr($xml, 0, strlen($doctype)) == $doctype) {
			$xml = substr($xml, strlen($doctype));
		}
		
		return $xml;
	}
}
