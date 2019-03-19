<?php
/* init vars for web content */
if (isset($_GET['m'])){
    $mode = $_GET['m'];
}
else{
    $mode = 'viewer';
}
if (isset($_GET['y'])){
    $year = $_GET['y'];
}
else{
    $year = DEFAULT_YEAR;
}
if (isset($_GET['d'])){
    $date = $_GET['d'];
}
else{
    $date = DEFAULT_DATE;
}
if (isset($_GET['q'])){
    $query = $_GET['q'];
}
else{
    $query = null;
}
if (isset($_GET['conf'])){
    $conf = $_GET['conf'];
}
/* * * * */
$format_date = str_replace('-','',$date);
$revert_date = date('dmY', strtotime($date));

$name = $query;

$long_name        = $format_date.'_'.$name;
$revert_long_name = $revert_date.'_'.$name;

$tracking_name = $revert_long_name;

$tracking_start   = TRACKING_HOST.$tracking_name.'&url=';
$tracking_end     = TRACKING_SUB.$tracking_name;

$yearfolder = $year.'/';
$file       = $long_name.'.html';
$dirpath    = FOLDER_HTML.$yearfolder;
$filepath   = $dirpath.$file;
$filepath_tmp = FOLDER_TEMP.$file;

$img_folder = $long_name.'_images/';
$img_url    = IMG_HOST.$yearfolder.$img_folder;

/* init head & header */
$viewer     = 'Aperçu de ';
$editor     = 'Édition de ';
$new        = 'Création <span class="new-noname">d\'une nouvelle newsletter</span><span class="new-of">de </span>';
$empty      = '<div class="header-info"><a href="?y=2019&d=2019-02-24&q=NL_DEMO2" title="Dernière modification"><i class="fas fa-history"></i> XXXXXXXX_NL_xxxxxxx</a> <span class="last">à <span class="last-time">XX:XX</span> par <span class="last-user">User</span></span></div>';

if($query == 'new'){
    define('CONTEXT', $new);
    define('CONTEXT_TITLE', '<div class="page-title">'.CONTEXT.' <span class="file-name"></span></div>');
    define('TITLE', CONTEXT.' - '.APP_NAME.' - '.COMPANY_NAME);
}
elseif(isset($query)){
    define('CONTEXT', $$mode.$file);
    define('CONTEXT_TITLE', '<div class="page-title">'.$$mode.' <span class="file-name">'.$file.'</span></div>');
    define('TITLE', CONTEXT.' - '.APP_NAME.' - '.COMPANY_NAME);
}
else{
    define('CONTEXT', $empty);
    define('CONTEXT_TITLE', '<div class="page-title">'.CONTEXT.'</div>');
    define('TITLE', APP_NAME.' - '.COMPANY_NAME);
}
/* * * * */

if( (isset($year))&&(!isset($query)) ){
    $newsthumbs = true;
}
?>