<?php
class IvrConfig extends DataExtension {
	private static $db = array(
		"IVR_Number" => "Varchar",
		"IVR_CallerId" => "Varchar",
		"IVR_CallerIdAlpha" => "Varchar",
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
		$numberList = $this->getCallFireNumbers();
		$numbers = array();
		if($numberList) {
			foreach($numberList as $number) {
				$numbers[$number->getNumber()] = "{$number->getNumber()} ({$number->getStatus()})";
			}
		}
	
		$sounds = $this->getCallFireSounds();
		$soundIds = array();
		if($sounds) {
			foreach($sounds as $sound) {
				$soundIds[$sound->getId()] = $sound->getName();
			}
		}
		
		$fields->addFieldsToTab("Root.RoaveNumber.Config", array(
			DropdownField::create("IVR_Number", "Phone Number", $numbers)->setHasEmptyDefault(true),
		
			TextField::create("IVR_CallerId", "Caller ID"),
			TextField::create("IVR_CallerIdAlpha", "Caller ID Alpha"),
			DropdownField::create("IVR_IntroSoundId", "Intro Sound", $soundIds)->setHasEmptyDefault(true),
			
			HeaderField::create("IVR_Option_Emergency", "Emergency Support"),
			DropdownField::create("IVR_Option_Emergency_SoundId", "Sound", $soundIds)->setHasEmptyDefault(true),
			NumericField::create("IVR_Option_Emergency_Extension", "Extension"),
			TextField::create("IVR_Option_Emergency_Number", "Number"),
			
			HeaderField::create("IVR_Option_TechnicalSupport", "Technical Support"),
			DropdownField::create("IVR_Option_TechnicalSupport_SoundId", "Sound", $soundIds)->setHasEmptyDefault(true),
			NumericField::create("IVR_Option_TechnicalSupport_Extension", "Extension"),
			TextField::create("IVR_Option_TechnicalSupport_Number", "Number"),
			
			HeaderField::create("IVR_Option_Sales", "Sales"),
			DropdownField::create("IVR_Option_Sales_SoundId", "Sound", $soundIds)->setHasEmptyDefault(true),
			NumericField::create("IVR_Option_Sales_Extension", "Extension"),
			TextField::create("IVR_Option_Sales_Number", "Number"),
			
			HeaderField::create("IVR_Option_TeamDirectory", "Team Directory"),
			DropdownField::create("IVR_Option_TeamDirectory_SoundId", "Sound", $soundIds)->setHasEmptyDefault(true),
			NumericField::create("IVR_Option_TeamDirectory_Extension", "Extension"),
			
			HeaderField::create("IVR_Option_Humorous", "Humorous"),
			DropdownField::create("IVR_Option_Humorous_SoundId", "Sound", $soundIds)->setHasEmptyDefault(true),
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
			$fields->addFieldsToTab("Root.RoaveNumber.IVR", array(
				LiteralField::create("IVR_XML", $gistEmbed)
			));
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
	
	protected function getCallFireNumbers() {
		$numberClient = $this->owner->getCallFireClient('Number');
		$response = $numberClient->QueryNumbers();
		$numbers = $numberClient::response($response);
		
		return $numbers;
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
