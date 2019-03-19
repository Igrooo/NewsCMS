<?php
/* database functions */
require('functions-db.php');

/* GLOBALS FUNCTIONS */

/* info & error message */
function show_info($tag, $level, $context, $title, $content){
    /* icons */
    $info    = '<i class="fas fa-info-circle"></i>';
    $success = '<i class="fas fa-check-circle"></i>';
    $warning = '<i class="fas fa-question-circle"></i>';
    $error   = '<i class="fas fa-exclamation-triangle"></i>';
    echo "<$tag class='$context $level $level-box'>".$$level." $title<br>$content</$tag>";
}

/* List newsletters of a year */
function list_news($display, $year, $name, $format_date){
    $table = DB_TABLE;
    $newsletters = db_all($table, $year);
    if(!empty($newsletters)) {
        echo '<ul class="list list-news">';
        foreach ($newsletters as $newsletter) {
            $newsletter_date = str_replace('-', '', $newsletter['DATE']);
            $newsletter_long_name = $newsletter_date . '_' . $newsletter['NAME'];
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
                    $yearfolder = $year . '/';
                    $htmlfile = $newsletter_long_name . '.html';
                    $path = FOLDER_HTML . $yearfolder . $htmlfile;
                    echo '<figure class="without-thumb" data-path-thumb="' . $thumb . '">
                                        <figcaption class="newsletter-title">' . $newsletter_long_name . '</figcaption>
                                        <i class="far fa-file-image fa-10x thumb thumb-icon icon icon-box"></i>
                                        <!--<iframe width="700" height="840" src="' . $path . '" class="temp-html"></iframe>-->
                                     </figure>';
                }
                echo '</a>
                 </li>';
            } else {
                $query_long_name = $format_date . '_' . $name;
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
function list_years($year, $name, $format_date){
    $table = DB_TABLE;
    $years = db_all_years($table);
    if(!empty($years)) {
        echo'<ul class="list list-years">';
        foreach ($years as $yeardir) {
            if (($year != null) && ($year == $yeardir['YEAR'])) {
                echo '<li class="year open"><a class="open" href="?y=' . $yeardir['YEAR'] . '">' . $yeardir['YEAR'] . '</a>';
                list_news('list', $year, $name, $format_date);
            } elseif (($year == null) && ($yeardir['YEAR'] == CURRENT_YEAR)) { // open current year by default
                $year = CURRENT_YEAR;
                echo '<li class="year open"><a class="open" href="?y=' . $yeardir['YEAR'] . '">' . $yeardir['YEAR'] . '</a>';
                list_news('list', $year, $name, $format_date);
            } else {
                echo '<li class="year"><a href="?y=' . $yeardir['YEAR'] . '">' . $yeardir['YEAR'] . '</a>';
            }
            echo '</li>';
        }
        echo '</ul>';
    }
}

function get_id($name,$format_date){
    $table = DB_TABLE;
    $one = db_one($table, $name);
    if(!empty($one)){
        foreach ($one as $newsletter){
            $newsletter_date = str_replace('-','',$newsletter['DATE']);
            $newsletter_long_name = $newsletter_date.'_'.$newsletter['NAME'];
            $query_long_name = $format_date.'_'.$name;
            if ($query_long_name == $newsletter_long_name) {
                $id= $newsletter['ID'];
                break;
            }
            else{
                $id = 0;
            }
        }
    }
    else{
        $id = 0;
    }
    return $id;
}

/* Get editable or generated content of newsletter */
function get_content($type,$name,$format_date){
    $table = DB_TABLE;
    $one = db_one($table, $name);
    if(!empty($one)){
        foreach ($one as $newsletter){
            $newsletter_date = str_replace('-','',$newsletter['DATE']);
            $newsletter_long_name = $newsletter_date.'_'.$newsletter['NAME'];
            $query_long_name = $format_date.'_'.$name;
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
    else{
        $content = 'empty';
    }
    return $content;
}

/* Generate HTML file */
function generate_file($name, $dirpath, $filepath, $format_date){
    // Create year directory
    if(!is_dir($dirpath)){
        mkdir($dirpath);
    }
    // Get content
    $head = file_get_contents(FOLDER_COMMON.'head.html');
    $foot = file_get_contents(FOLDER_COMMON.'foot.html');
    $content = get_content('generated',$name,$format_date);
    if($content == 'empty'){
        $content = '<tr><td>La newsletter '.$name.' est introuvable.</td></tr>';
    }
    elseif($content == 'bad-query'){
        $content = '<tr><td>La newsletter '.$name.' n\'existe pas avec cette date ('.$format_date.').</td></tr>';
    }
    $html = $head.$content.$foot;
    // Create file
    file_put_contents($filepath, $html);
}
?>