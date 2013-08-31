<?php
use CallFire\Common\Ivr;

class IvrGenerator {
	public function generate() {
		$config = SiteConfig::current_site_config();
		
		$ivr = new Ivr;
		$dialplan = $ivr->getDialplan();
		$dialplan->setName("roave_tollfree");
		
		$menu = $this->generateMenu($config, $dialplan);
		
		return $ivr;
	}
	
	public function generateMenu($config, $dialplan) {
		$menu = $dialplan->Menu()
			->setName("main_menu")
			->setMaxDigits(1)
			->setTimeout(50000);
		
		// Play
		
		if($config->IVR_IntroSoundId) {
			$menu->Play() // Intro
				->setType("callfireid")
				->setContent($config->IVR_IntroSoundId);
		}
		
		if($config->IVR_Option_Emergency_SoundId) {
			$menu->Play() // Emergency
				->setType("callfireid")
				->setContent($config->IVR_Option_Emergency_SoundId);
		}
		
		if($config->IVR_Option_TechnicalSupport_SoundId) {
			$menu->Play() // Technical Support
				->setType("callfireid")
				->setContent($config->IVR_Option_TechnicalSupport_SoundId);
		}
		
		if($config->IVR_Option_Sales_SoundId) {
			$menu->Play() // Sales
				->setType("callfireid")
				->setContent($config->IVR_Option_Sales_SoundId);
		}
		
		if($config->IVR_Option_TeamDirectory_SoundId) {
			$menu->Play() // Team Directory
				->setType("callfireid")
				->setContent($config->IVR_Option_TeamDirectory_SoundId);
		}
		
		// Key presses
		
		if($config->IVR_Option_Emergency_SoundId) {
			$menu->Keypress()
				->setPressed($config->IVR_Option_Emergency_Extension)
				->appendChild(
					$transfer = $this->generateTransferNode($config, $dialplan)
						->setContent($config->IVR_Option_Emergency_Number)
				);
			$transfer->setCallerId($config->IVR_CallerId);
			$transfer->setCallerIdAlpha($config->IVR_CallerIdAlpha);
		}
		
		if($config->IVR_Option_TechnicalSupport_SoundId) {
			$menu->Keypress()
				->setPressed($config->IVR_Option_TechnicalSupport_Extension)
				->appendChild(
					$transfer = $this->generateTransferNode($config, $dialplan)
						->setContent($config->IVR_Option_TechnicalSupport_Number)
				);
			$transfer->setCallerId($config->IVR_CallerId);
			$transfer->setCallerIdAlpha($config->IVR_CallerIdAlpha);
		}
		
		if($config->IVR_Option_Sales_SoundId) {
			$menu->Keypress()
				->setPressed($config->IVR_Option_Sales_Extension)
				->appendChild(
					$transfer = $this->generateTransferNode($config, $dialplan)
						->setContent($config->IVR_Option_Sales_Number)
				);
			$transfer->setCallerId($config->IVR_CallerId);
			$transfer->setCallerIdAlpha($config->IVR_CallerIdAlpha);
		}
		
		if($config->IVR_Option_TeamDirectory_SoundId) {
			$menu->Keypress()
				->setPressed($config->IVR_Option_TeamDirectory_Extension)
				->Goto()
					->setContent("team_directory");
			$teamDirectory = $this->generateTeamDirectory($config, $dialplan, $menu);
		}
		
		return $menu;
	}
	
	public function generateTeamDirectory($config, $dialplan, $menu) {
		$teamDirectory = $dialplan->Menu() // Team Directory
			->setName("team_directory")
			->setMaxDigits(1)
			->setTimeout(50000);
		
		$teamMembers = TeamMember::get()->exclude(array(
			"TollFreeExtension" => "",
			"Phone" => ""
		))->sort(array(
			"TollFreeExtension" => "ASC"
		));
		
		foreach($teamMembers as $teamMember) {
			$teamDirectory->Play()
				->setType("tts")
				->setContent("For {$teamMember->Name}, press {$teamMember->TollFreeExtension}");
			
		}
		
		$teamDirectory->Play()
			->setType("tts")
			->setContent("To return to the main menu, press star");
		
		if($config->IVR_Option_Humorous_SoundId) {
			$humorousExtension = $teamMembers->max("TollFreeExtension") + 1;
		
			$teamDirectory->Play()
				->setType("tts")
				->setContent("For a good time, press {$humorousExtension}");
		}
		
		foreach($teamMembers as $teamMember) {
			$teamDirectory->Keypress()
				->setPressed($teamMember->TollFreeExtension)
				->appendChild(
					$transfer = $this->generateTransferNode($config, $dialplan)
						->setContent($teamMember->Phone)
				);
			$transfer->setCallerId($config->IVR_CallerId);
			$transfer->setCallerIdAlpha($config->IVR_CallerIdAlpha);
		}
		
		$teamDirectory->Keypress()
			->setPressed("*")
			->Goto()
				->setContent("main_menu");
		
		if($config->IVR_Option_Humorous_SoundId) {
			$teamDirectory->Keypress()
				->setPressed($humorousExtension)
				->Play()
					->setType("callfireid")
					->setContent($config->IVR_Option_Humorous_SoundId);
		}
		
		return $teamDirectory;
	}
	
	public function generateTransferNode($config, $dialplan) {
		$transfer = new Ivr\Dialplan\TransferTag;
		$dialplan->ownerDocument->importNode($transfer, true);
		
		return $transfer;
	}
}
