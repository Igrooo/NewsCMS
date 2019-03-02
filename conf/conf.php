<?php
/* /////////////////////////////// */
/* //////// GLOBAL CONFIG //////// */
/* /////////////////////////////// */

define('LANG', 'fr');
define('CHARSET', 'utf-8');

define('CURRENT_YEAR', date('Y'));
define('CURRENT_DATE', date('Y-m-d'));
define('CURRENT_TIME', date('Y-m-d H:i:s'));

define('DEFAULT_YEAR', null);
define('DEFAULT_DATE', null);

/* folder of php includes */
define('FOLDER_INC', FOLDER_APP.'inc/');

/* folder of web resources */
define('FOLDER_WEB', FOLDER_APP.'app/');
define('FOLDER_IMG', FOLDER_WEB.'img/');
define('FOLDER_CSS', FOLDER_WEB.'css/');
define('FOLDER_JS',  FOLDER_WEB.'js/');

/* Icon & Name of the application */
define('ICON_APP', '<i class="icon far fa-newspaper app-icon"></i>');
define('FAVICON_APP', FOLDER_IMG.'favicon.png');
define('NAME_APP', 'NewsCMS');
/* /////////////////////////////// */


/* /////////////////////////////// */
/* /////// DATABASE CONFIG /////// */
/* /////////////////////////////// */
define('DB_HOST', 'localhost:3308');
define('DB_NAME', 'news');
define('DB_USER', 'root');
define('DB_PASS', '');

define('DB_TABLE','newsletters');
define('DB_TABLE_COMPONENTS','components');
define('DB_TABLE_TEMPLATES','templates');
/* /////////////////////////////// */


/* /////////////////////////////// */
/* ///// DIRECTORIES CONFIG  ///// */
/* /////////////////////////////// */

/* Default folder of Newsletters files */
define('FOLDER_NEWS', FOLDER_APP.'news/');

/* Folder of Newsletters common pictures */
define('FOLDER_PICTURES', FOLDER_NEWS.'images/');

/* Folder of Newsletters common HTML & CSS */
define('FOLDER_COMMON', FOLDER_NEWS.'common/');

/* Folder of generated HTML files */
define('FOLDER_HTML', FOLDER_NEWS.'html/');

/* Folder of generated thumbnails */
define('FOLDER_THUMBS', FOLDER_NEWS.'thumbs/');
/* /////////////////////////////// */


/* /////////////////////////////// */
/* ///// DEFAULT USER CONFIG ///// */
/* /////////////////////////////// */

/* Logo & Name of the company */
define('LOGO_COMPANY', FOLDER_IMG.'logo.png');
define('NAME_COMPANY', 'Carrefour Voyages');

/* Prefix on Newsletters filename */
define('PREFIXDATE', true);
define('PREFIX', 'NL_');

/* User profil preferences */
define('USER_COLOR','');
/* /////////////////////////////// */
?>