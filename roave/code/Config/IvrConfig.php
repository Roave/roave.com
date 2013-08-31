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
		
		$xml = $this->getIvrXml();
		$cache = SS_Cache::factory('IVR_XML');
		if(!($gist = $cache->load(md5($xml)))) {
			$gist = $this->createGist(array(
				"IVR_XML.xml" => array(
					"content" => $xml
				)
			));
			if($gist) {
				$cache->save($gist);
			}
		}
		if($gist) {
			$gist = json_decode($gist);
			$gistEmbed = "<script src=\"{$gist->html_url}.js\"></script>";
			$fields->addFieldToTab("Root.RoaveNumber.IVR", LiteralField::create("IVR_XML", $gistEmbed));
		}
	}
	
	protected function createGist(array $files) {
		$data = json_encode(array(
			"public" => false,
			"files" => $files
		));
		
		$curl = curl_init('https://api.github.com/gists');
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $data
		));
		
		$gist = curl_exec($curl);
		
		return $gist;
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
		
		$doctype = "<?xml version=\"1.0\"?>\n";
		
		if(substr($xml, 0, strlen($doctype)) == $doctype) {
			$xml = substr($xml, strlen($doctype));
		}
		
		return $xml;
	}
}
