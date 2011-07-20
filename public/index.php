<?php

defined('ROOT_PATH') || 
    define(
        'ROOT_PATH', 
        realpath(dirname(dirname(__FILE__)))
    );
    
// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(ROOT_PATH . '/application'));
    
        
defined('CONFIG_PATH') || 
    define(
        'CONFIG_PATH', 
        ROOT_PATH. '/etc'
    );
	
// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'development'));

//library path

        
defined('LIBRARY_PATH') || 
    define(
        'LIBRARY_PATH', 
       ROOT_PATH . '/library'
    ); 

/**
 * Defines absolute & relative URIs
 */ 
defined('URL_MAIN_REL') ||
    define('URL_MAIN_REL', rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . '/');
defined('URL_MAIN_ABS') ||
    define('URL_MAIN_ABS', 'http://' . $_SERVER['HTTP_HOST'] . URL_MAIN_REL);
   
    
/**
 * Defines some usefull constants
 */ 
define('DS', DIRECTORY_SEPARATOR);
define('PS', PATH_SEPARATOR);
define('TAB', "\t");
	
	
/**
 * Ensures library/ is on include_path
 */ 
set_include_path(
    implode(
        PATH_SEPARATOR, 
        array(realpath(ROOT_PATH . DS . 'library'), get_include_path())
    )
);

/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
      CONFIG_PATH . DS . 'application.ini'
);
$application->bootstrap()
            ->run();
			
			
	
			