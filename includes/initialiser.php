<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
$project_path = dirname(__FILE__);
$project_path = str_replace('includes', '', $project_path);
defined('SITE_ROOT') ? null : 
	define('SITE_ROOT',$project_path);
	
defined('SITE_PATH') ? null : 
	define('SITE_PATH',dirname($_SERVER['PHP_SELF']));
    
defined('LIB_PATH') ? null : define('LIB_PATH', SITE_ROOT.'includes');

// charger fichier config  avant tout
require_once(LIB_PATH.DS.'config.php');

// charger fonctions
require_once(LIB_PATH.DS.'fonctions.php');

// charger core objects
require_once(LIB_PATH.DS.'session.php');
require_once(LIB_PATH.DS.'bd.php');


// charger  classes
require_once(LIB_PATH.DS.'continent.php');
require_once(LIB_PATH.DS.'pays.php');
require_once(LIB_PATH.DS.'region.php');
require_once(LIB_PATH.DS.'domaine.php');
require_once(LIB_PATH.DS.'detaildomaine.php');
require_once(LIB_PATH.DS.'server.php');
require_once(LIB_PATH.DS.'djiant_index.php');
require_once(LIB_PATH.DS.'accounts.php');


//require_once(LIB_PATH.DS.'fichier.php');




//require_once(LIB_PATH.DS.'contact_us.php');

?>