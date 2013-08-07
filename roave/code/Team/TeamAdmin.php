<?php
class TeamAdmin extends ModelAdmin {
	public static $menu_title = "Team";
	public static $url_segment = "team";

	public static $managed_models = array(
		"TeamMember",
		"Certification"
	);
}
