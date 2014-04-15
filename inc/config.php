<?php
	    //define database variables.
	    define('DB_USER',"fmh");
	    define('DB_PASS',"fmh");
	    define('DB_HOST', "localhost");
	    define('DB_PORT', 3306);
	    define('DB_DB',"fmh");
	    
	    function __autoload($class)
	    {
			require_once('classes/' . $class . "_class.php");
	    }
	    
	    $db = new database;
?>