<?php
/* INIT GLOBALS VARIABLES */

$mode = 'viewer';
$template_mode = false;
$query = false;
$query_id = false;
$year  = DEFAULT_YEAR;
$date  = DEFAULT_DATE;
$conf  = false;

if (isset($_GET['m'])){
    $mode = $_GET['m'];
}
if (isset($_GET['t'])){
    $template_mode = true;
}
if (isset($_GET['y'])){
    $year = $_GET['y'];
}
if (isset($_GET['d'])){
    $date = $_GET['d'];
}
if (isset($_GET['q'])){
    $query = $_GET['q'];
}
elseif($template_mode){
    $query = 'template';
}
if(isset($_GET['id'])){
    $query_id = $_GET['id'];
}
if (isset($_GET['conf'])){
    $conf = $_GET['conf'];
}
/* * * * */
$name = $query;

$long_name         = get_long_name($date,$name,false);
$reverse_long_name = get_long_name($date,$name,true);

$tracking_name = $reverse_long_name;

$tracking_start = TRACKING_HOST.$tracking_name.'&url=';
$tracking_end   = TRACKING_SUB.$tracking_name;

$yearfolder   = $year.'/';
$file         = $long_name.'.html';
$dirpath      = FOLDER_HTML.$yearfolder;
$filepath     = $dirpath.$file;
$filepath_tmp = FOLDER_TEMP.$file;

$img_folder = $long_name.'_images/';
$img_url    = IMG_HOST.$yearfolder.$img_folder;

$history = get_last();
if(!empty($history)){
    $last_edited = '<a href="?y='.$history['year'].'&d='.$history['date'].'&q='.$history['name'].'" title="Dernière modification"><i class="fas fa-history"></i> '.$history['long_name'].'</a> <span class="last">le <span class="last-date">'.$history['edit_date'].'</span> à <span class="last-time">'.$history['edit_time'].'</span> par <span class="last-user">'.$history['user'].'</span></span>';
}
else{$last_edited = '';}

/* init head & header */
$viewer   = 'Aperçu de ';
$editor   = 'Édition de ';
if($template_mode){
    $builder = 'Modification du modèle ';
    $new = "Création d'un nouveau modèle";
    $new_html = 'Création <span class="new-noname">d\'un nouveau modèle</span><span class="new-of">du modèle </span>';
}
else{
    $builder  = 'Modification de ';
    $new      = "Création d'une nouvelle newsletter";
    $new_html = 'Création <span class="new-noname">d\'une nouvelle newsletter</span><span class="new-of">de </span>';
}

if($query == 'new'){
    define('CONTEXT', $new);
    define('HEADER_TITLE', '<div class="page-title header-info">'.$new_html.' <span class="file-name"></span></div>');
    define('TITLE', CONTEXT.' - '.APP_NAME.' - '.COMPANY_NAME);
}
elseif($query){
    define('CONTEXT', $$mode.$file);
    define('HEADER_TITLE', '<div class="page-title header-info">'.$$mode.' <span class="file-name">'.$file.'</span></div>');
    define('TITLE', CONTEXT.' - '.APP_NAME.' - '.COMPANY_NAME);
}
else{
    define('HEADER_TITLE', '<div class="page-title header-info">'.$last_edited.'</div>');
    define('TITLE', APP_NAME.' - '.COMPANY_NAME);
}

/* * * * */
$newsthumbs = false;
if( $year && !$query ){
    $newsthumbs = true;
}
?>