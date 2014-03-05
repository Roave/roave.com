<?php
global $project;
$project = 'roave';

global $database;
$database = 'roave';

MySQLDatabase::set_connection_charset('utf8');

// Set the current theme. More themes can be downloaded from
// http://www.silverstripe.org/themes/
SSViewer::set_theme('ruby-on-roave');

// Set the site locale
i18n::set_locale('en_US');

// Enable nested URLs for this site (e.g. page/sub-page/)
if (class_exists('SiteTree')) SiteTree::enable_nested_urls();

foreach(glob(__DIR__."/_config_*.php") as $config)
    include_once($config);
    
require_once("conf/ConfigureFromEnv.php");
