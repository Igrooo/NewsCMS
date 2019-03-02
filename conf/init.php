<?php
/* init vars  */
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
/* * * * */
$format_date = str_replace('-','',$date);
$yearfolder = $year.'/';
$file       = $format_date.'_'.$query.'.html';
$dirpath    = FOLDER_HTML.$yearfolder;
$filepath   = $dirpath.$file;

/* init head & header */
$viewer     = 'Aperçu de ';
$editor     = 'Édition de ';
$new        = 'Création d\'une nouvelle newsletter ';
$empty      = '<div class="header-info"><a href="?y=2019&d=2019-02-24&q=NL_DEMO2" title="Dernière modification"><i class="fas fa-history"></i> XXXXXXXX_NL_xxxxxxx</a> <span class="last">à <span class="last-time">XX:XX</span> par <span class="last-user">User</span></span></div>';

if($query == 'new'){
    define('CONTEXT', $new);
    define('CONTEXT_TITLE', '<div class="page-title">'.CONTEXT.' <span class="file-name"></span></div>');
    define('TITLE', CONTEXT.' - '.NAME_APP.' - '.NAME_COMPANY);
}
elseif(isset($query)){
    define('CONTEXT', $$mode.$file);
    define('CONTEXT_TITLE', '<div class="page-title">'.$$mode.' <span class="file-name">'.$file.'</span></div>');
    define('TITLE', CONTEXT.' - '.NAME_APP.' - '.NAME_COMPANY);
}
else{
    define('CONTEXT', $empty);
    define('CONTEXT_TITLE', '<div class="page-title">'.CONTEXT.'</div>');
    define('TITLE', NAME_APP.' - '.NAME_COMPANY);
}
/* * * * */

if( (isset($year))&&(!isset($query)) ){
    $newsthumbs = true;
}
?>