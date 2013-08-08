<?php
require(__DIR__.'/../../cli/bootstrap.php');
$team = include(__DIR__.'/team.php');

DB::getConn()->transactionStart();

foreach($team as $member) {
	$teamMember = new TeamMember;
	
	$tmp = explode('(', $member['name']);
	$name = $tmp[0];
	$alias = isset($tmp[1])?$tmp[1]:null;
	
	$name = trim($name);
	$alias = trim($alias, " \t\n\r\0\x0B)");
	
	$teamMember->Name = $name;
	$teamMember->Alias = $alias;
	$teamMember->Email = $member['email'];
	if(isset($member['zceid'])) {
		$teamMember->ZCEID = $member['zceid'];
	}
	$teamMember->Bio = $member['bio'];
	if(isset($member['links'])) {
		if(isset($member['links']['github']))
			$teamMember->GitHub = $member['links']['github'];
		if(isset($member['links']['twitter']))
			$teamMember->Twitter = $member['links']['twitter'];
		if(isset($member['links']['rss']))
			$teamMember->Blog = $member['links']['rss'];
	}
	
	$certifications = $teamMember->Certifications();
	
	if(isset($member['certs'])) {
		foreach($member['certs'] as $certClass) {
			$cert = Certification::get()->filter('Class', $certClass)->First();
			if($cert) {
				$certifications->add($cert);
			}
		}
	}
	$teamMember->write();
}

DB::getConn()->transactionEnd();
