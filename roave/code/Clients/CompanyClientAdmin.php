<?php
class CompanyClientAdmin extends ModelAdmin {
	public static $menu_title = "Clients";
	public static $url_segment = "clients";

	public static $managed_models = array(
		"CompanyClient",
	);
	
	public static $allowed_actions = array(
		"EditForm"
	);
}
