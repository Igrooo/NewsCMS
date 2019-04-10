<?php

//// SERVER PATHS
define('SERVER_HOST', $_SERVER['HTTP_HOST']);
/* CURRENT_DIR for absolute path */
define('CURRENT_DIR', 'http://'.SERVER_HOST.dirname($_SERVER['PHP_SELF']).'/');
define('CURRENT_URL', 'http://'.SERVER_HOST.$_SERVER['REQUEST_URI']);

//// PATHS
/* Directory of the NewsCMS app */
define('FOLDER_APP','');

/* configurations folder */
define('FOLDER_CONF',FOLDER_APP.'conf/');
define('FOLDER_TEMP',FOLDER_APP.'tmp/');

//// ERROR REPORTING
error_reporting(E_ALL); // Error engine - always ON
ini_set('ignore_repeated_errors', true); // always ON
ini_set('display_errors', true); // Error display - OFF in production
ini_set('log_errors', true);  // Error logging
ini_set('error_log', FOLDER_TEMP.'errors.log'); // Logging file
ini_set('log_errors_max_len', 1024); // Logging file size
ini_set('html_errors', false); // HTML errors

////
/* conf */
require(FOLDER_CONF.'conf.php');
/* functions */
require(FOLDER_CONF.'functions.php');
/* insert */
if(isset($_GET['new-template'])){
include(FOLDER_CONF . 'insert-template.php');}
if(isset($_GET['new'])){
include(FOLDER_CONF . 'insert.php');}
/* update */
if(isset($_GET['update-template'])){
    include(FOLDER_CONF . 'update-template.php');}
if(isset($_GET['update-content'])){
include(FOLDER_CONF . 'update-content.php');}
if(isset($_GET['update'])){
include(FOLDER_CONF . 'update.php');}
/* delete */
if(isset($_GET['delete'])){
include(FOLDER_CONF.'delete.php');}
/* get url and set context vars */
require(FOLDER_CONF.'init.php');
/* download static html file */
if(isset($_GET['download'])) {
include(FOLDER_INC . 'download.php');
}
/* load content */
include(FOLDER_INC.'content.php');

?>