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
$name = $query;

$long_name        = get_long_name($date,$name,false);
$reverse_long_name = get_long_name($date,$name,true);

$tracking_name = $reverse_long_name;

$tracking_start   = TRACKING_HOST.$tracking_name.'&url=';
$tracking_end     = TRACKING_SUB.$tracking_name;

$yearfolder = $year.'/';
$file       = $long_name.'.html';
$dirpath    = FOLDER_HTML.$yearfolder;
$filepath   = $dirpath.$file;
$filepath_tmp = FOLDER_TEMP.$file;

$img_folder = $long_name.'_images/';
$img_url    = IMG_HOST.$yearfolder.$img_folder;

$history = get_last();
if(!empty($history)){
    $last_edited = '<a href="?y='.$history['year'].'&d='.$history['date'].'&q='.$history['name'].'" title="Dernière modification"><i class="fas fa-history"></i> '.$history['long_name'].'</a> <span class="last">le <span class="last-date">'.$history['edit_date'].'</span> à <span class="last-time">'.$history['edit_time'].'</span> par <span class="last-user">'.$history['user'].'</span></span>';
}
else{$last_edited ='';}

/* init head & header */
$viewer     = 'Aperçu de ';
$editor     = 'Édition de ';
$builder    = 'Modification de ';
$new        = 'Création <span class="new-noname">d\'une nouvelle newsletter</span><span class="new-of">de </span>';
$empty      = '<div class="header-info">'.$last_edited.'</div>';

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