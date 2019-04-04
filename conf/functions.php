<?php
/* database functions */
require('functions-db.php');

/* GLOBALS FUNCTIONS */

/* info & error message */
function show_info($tag, $level, $context, $title, $content){
    /* icons --> in $$level */
    $info    = '<i class="fas fa-info-circle"></i>';
    $success = '<i class="fas fa-check-circle"></i>';
    $warning = '<i class="fas fa-exclamation-circle"></i>';
    $error   = '<i class="fas fa-exclamation-triangle"></i>';
    echo "<$tag class='$context $level $level-box'>".$$level." $title<br>$content</$tag>";
}

function get_long_name($date,$name,$reverse){
    if ($reverse === true){
        return date('dmY', strtotime($date)).'_'.$name;
    }
    else{
        return str_replace('-', '', $date).'_'.$name;
    }
}

/* List newsletters of a year */
function list_news($display, $year, $name, $date){
    $newsletters = db_all(DB_TABLE, $year);
    if(!empty($newsletters)) {
        echo '<ul class="list list-news">';
        foreach ($newsletters as $newsletter) {
            $newsletter_long_name = get_long_name($newsletter['DATE'],$newsletter['NAME'],false);
            if ($display == 'grid') {
                echo '<li class="item">
                    <a href="?y=' . $newsletter['YEAR'] . '&d=' . $newsletter['DATE'] . '&q=' . $newsletter['NAME'] . '">';
                $thumb = FOLDER_THUMBS . $newsletter_long_name . '.png';
                if (file_exists($thumb)) {
                    echo '<figure class="with-thumb">
                            <figcaption class="newsletter-title">' . $newsletter_long_name . '</figcaption>
                                <img src="' . $thumb . '" alt="' . $newsletter_long_name . '" class="thumb">
                          </figure>';
                } else {
                    echo '<figure class="without-thumb" data-path-thumb="' . $thumb . '">
                                        <figcaption class="newsletter-title">' . $newsletter_long_name . '</figcaption>
                                        <i class="far fa-file-image fa-10x thumb thumb-icon icon icon-box"></i>
                                     </figure>';
                }
                echo '</a>
                 </li>';
            } else {
                $query_long_name = get_long_name($date , $name,false);
                if ($query_long_name == $newsletter_long_name) {
                    echo '<li class="item"><span class="open"><i class="bull">&bull;</i><span class="newsletter-title">' . $newsletter_long_name . '</span></span></li>';
                } else {
                    echo '<li class="item"><a href="?y=' . $newsletter['YEAR'] . '&d=' . $newsletter['DATE'] . '&q=' . $newsletter['NAME'] . '"><i class="bull">&bull;</i><span class="newsletter-title">' . $newsletter_long_name . '</span></a></li>';
                }
            }
        }
        echo '</ul>';
    }
    else{
        $button = '<br><a class="btn btn-primary" href="?m=builder&q=new" title="Créer une nouvelle newsletter"><i class="icon fas fa-plus"></i> C\'est partie, on commence !</a><br><br>';
        show_info('h4','info', '', 'Aucune newsletter n\'a été créée pour cette année.', $button);
    }

}

/* List all years */
function list_years($year, $name, $date){
    $years = db_all_years(DB_TABLE);
    if(!empty($years)) {
        echo'<ul class="list list-years">';
        foreach ($years as $yeardir) {
            if (($year != null) && ($year == $yeardir['YEAR'])) {
                echo '<li class="year open"><a class="open" href="?y=' . $yeardir['YEAR'] . '">' . $yeardir['YEAR'] . '</a>';
                list_news('list', $year, $name, $date);
            } elseif (($year == null) && ($yeardir['YEAR'] == CURRENT_YEAR)) { // open current year by default
                $year = CURRENT_YEAR;
                echo '<li class="year open"><a class="open" href="?y=' . $yeardir['YEAR'] . '">' . $yeardir['YEAR'] . '</a>';
                list_news('list', $year, $name, $date);
            } else {
                echo '<li class="year"><a href="?y=' . $yeardir['YEAR'] . '">' . $yeardir['YEAR'] . '</a>';
            }
            echo '</li>';
        }
        echo '</ul>';
    }
}

function get_id($name,$date){
    $one = db_one(DB_TABLE, $name);
    $id = 0;
    if(!empty($one)){
        foreach ($one as $newsletter){
            $newsletter_long_name = get_long_name($newsletter['DATE'],$newsletter['NAME'],false);
            $query_long_name = get_long_name($date,$newsletter['NAME'],false);
            if ($query_long_name == $newsletter_long_name) {
                $id= $newsletter['ID'];
                break;
            }
            else{
                $id = 0;
            }
        }
    }
    return $id;
}

function next_id(){
    return '0';
}

function get_last(){
    $last = db_last(DB_TABLE);
    $history = [];
    if(!empty($last)) {
        foreach ($last as $newsletter) {
            $long_name = get_long_name($newsletter['DATE'],$newsletter['NAME'],false);
            $edit_datetime = $newsletter['DATE_EDIT'];
            $edit_date = date('d/m/y', strtotime($edit_datetime));
            $edit_time = date('H:i', strtotime($edit_datetime));
            $history = [
                'year' => $newsletter['YEAR'],
                'date' => $newsletter['DATE'],
                'name' => $newsletter['NAME'],
                'long_name' => $long_name,
                'edit_date' => $edit_date,
                'edit_time' => $edit_time,
                'user' => 'User'
            ];
        }
    }
    return $history;
}

/* Get editable or generated content of newsletter */
function get_content($type,$name,$date){
    $one = db_one(DB_TABLE, $name);
    $content = 'empty';
    if(!empty($one)){
        foreach ($one as $newsletter){
            $newsletter_long_name = get_long_name($newsletter['DATE'],$newsletter['NAME'],false);
            $query_long_name = get_long_name($date,$newsletter['NAME'],false);
            if ($query_long_name == $newsletter_long_name) {
                if ($type == 'editable'){
                    $content = stripslashes($newsletter['CONTENT_EDITABLE']);
                }
                else{
                    $content = stripslashes($newsletter['CONTENT_GENERATED']);
                }
                break;
            }
            else{
                $content = 'bad-query';
            }
        }
    }
    return $content;
}

/* Add tracking in not editable links */
function add_tracking($content, $date, $name){
    $tracking_name  = get_long_name($date,$name,true);
    $tracking_start = TRACKING_HOST.$tracking_name.'&url=';
    $tracking_end   = '?'.TRACKING_SUB.$tracking_name;
    $content = str_replace('[tracking-start]',$tracking_start,$content);
    $content = str_replace('[tracking-end]',$tracking_end,$content);
    return $content;
}

/* Convert &amp; in urls */
function convert_amp($content){
    return $content = str_replace('&amp;','&',$content);
}

/* Generate HTML file */
function generate_file($name, $dirpath, $filepath, $date){
    // Create year directory
    if(!is_dir($dirpath)){
        mkdir($dirpath);
    }
    // Get content
    $head = file_get_contents(FOLDER_COMMON.'head.html');
    $foot = file_get_contents(FOLDER_COMMON.'foot.html');
    $content = get_content('generated',$name,$date);
    if($content == 'empty'){
        $content = '<tr><td>La newsletter '.$name.' est introuvable.</td></tr>';
    }
    elseif($content == 'bad-query'){
        $content = '<tr><td>La newsletter '.$name.' n\'existe pas avec cette date ('.$date.').</td></tr>';
    }
    $html = $head.$content.$foot;
    // Create file
    file_put_contents($filepath, $html);
}

function generate_thumb(){

}
