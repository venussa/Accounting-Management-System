<?php

// start session
session_start();


/*
 *---------------------------------------------------------------
 * ERROR REPORTING
 *---------------------------------------------------------------
 *
 * Different environments will require different levels of error reporting.
 * By default development will show errors but testing and live will hide them.
 */

error_reporting(-1);

$_SESSION['debug'] = 1;

if(isset($_SESSION['debug'])){

	if($_SESSION['debug'] == 1) $debug = "on";
	if($_SESSION['debug'] == 0) $debug = "off";

}else $debug = "off";


ini_set('display_errors', $debug);

// time limit
set_time_limit(30);

// timezone
date_default_timezone_set('Asia/Jakarta');


/*
 *---------------------------------------------------------------
 * BASE PATH CONSTANTS
 *---------------------------------------------------------------
 *
 * Definied base project path
 * Identification base project path dir name
 */

// home directoy
DEFINE("SERVER",str_replace("\\","/",__DIR__));

// get active dir name
$dir_name = explode("/",SERVER);
$dir_name = $dir_name[count($dir_name)-1];
DEFINE("BASE_DIR_NAME",$dir_name);
DEFINE("ICONV_ENABLED",true);
DEFINE("MB_ENABLED",true);


/*
 *---------------------------------------------------------------
 * LOAD AUTO LOAD
 *---------------------------------------------------------------
 *
 * This a entire file includer
 */


// autoload system

$autoload = SERVER."/application/config/autoload.php";

if(is_file($autoload)){

	require_once($autoload);

}else{
	
	// if autoload not found
	die("error");
}

