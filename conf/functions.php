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
                echo '
                <li class="item">
                    <a class="grid-btn" href="?y='.$newsletter['YEAR'].'&d='.$newsletter['DATE'].'&q='.$newsletter['NAME'].'">';
                $filepath = FOLDER_HTML.$newsletter['YEAR'].'/'.$newsletter_long_name.'.html';

                if (file_exists($filepath)) {
                    echo '<figure class="with-thumb">
                            <figcaption class="newsletter-title">'.$newsletter_long_name.'</figcaption>
                            <div class="thumb">
                                <iframe class="thumb-page" width="400" height="480" src="'.$filepath.'"></iframe>
                            </div>
                          </figure>';
                } else {
                    echo '
                        <figure class="without-thumb">
                            <figcaption class="newsletter-title">'.$newsletter_long_name.'</figcaption>
                            <i class="far fa-file-image fa-10x thumb thumb-icon icon icon-box"></i>
                        </figure>
                    ';
                }
                echo '
                    </a>
                    <nav class="nav-group tiny-nav">
                        <ul class="nav compact">
                            <li class="item"><a class="btn" href="?m=editor&y='.$newsletter['YEAR'].'&d='.$newsletter['DATE'].'&q='.$newsletter['NAME'].'" title="Modifier le contenu de '.$newsletter_long_name.'"><i class="icon fas fa-pen"></i></a></li><!--
                            --><li class="item"><a class="btn disabled" href="#" title="Créer une nouvelle newsletter à partir de '.$newsletter_long_name.'"><i class="icon far fa-copy"></i></a></li><!--?m=editor&y=$year&d=$date&q=new&c=$query";?>--><!--
                            --><li class="item"><a class="btn" href="?download&y='.$newsletter['YEAR'].'&d='.$newsletter['DATE'].'&q='.$newsletter['NAME'].'" title="Télécharger le fichier '.$newsletter_long_name.'.html"><i class="icon fas fa-download"></i></a></li><!--
                            --><li class="item"><a class="btn" href="'.$filepath.'" title="Ouvrir '.$newsletter_long_name.'.html dans un nouvel onglet" target="_blank"><i class="icon fas fa-external-link-alt"></i></a></li>
                        </ul>
                    </nav>
                </li>';
            }
            else {
                $query_long_name = get_long_name($date , $name,false);
                if ($query_long_name == $newsletter_long_name) {
                    echo '<li class="item"><span class="open"><i class="bull">&bull;</i><span class="newsletter-title">'.$newsletter_long_name.'</span></span></li>';
                } else {
                    echo '<li class="item"><a class="item-title" href="?y='.$newsletter['YEAR'].'&d='.$newsletter['DATE'].'&q='.$newsletter['NAME'].'"><i class="bull">&bull;</i><span class="newsletter-title">'.$newsletter_long_name.'</span></a></li>';
                }
            }
        }
        echo '</ul>';
    }
    else{
        $button = '<br><a class="btn btn-primary" href="?m=builder&q=new" title="Créer une nouvelle newsletter"><i class="icon fas fa-plus"></i> C\'est partie, on commence !</a><br><br>';
        show_info('h4','info', '', "Aucune newsletter n'a été créée pour cette année.", $button);
    }

}

/* List templates */
function list_templates($context, $query_id){
    $templates = db_all_templates(DB_TABLE_TEMPLATES);
    if(!empty($templates)) {
        if($context == 'list') {
            echo '<ul class="list list-templates">';
            foreach ($templates as $template) {
                if ($query_id == $template['ID']) {
                    echo '<li class="item"><span class="item-title open"><i class="bull">&bull;</i><span class="newsletter-title template-id">'.sprintf('%02d', $template['ID']).'</span> <i class="bull">&bull;</i><span class="newsletter-title">'.$template['NAME'].'</span></span></li>';
                } else {
                    echo '<li class="item"><a class="item-title" href="?m=builder&t&id='.$template['ID'].'"><i class="bull">&bull;</i><span class="newsletter-title template-id">'.sprintf('%02d', $template['ID']).'</span> <i class="bull">&bull;</i><span class="newsletter-title">'.$template['NAME'].'</span></a></li>';
                }
            }
            echo '</ul>';
        }
        else if($context == 'form-compact'){
            foreach ($templates as $template) {
                echo '<option value="'.$template['ID'].'" data-value="' .$template['COMPONENTS'].'">'. sprintf('%02d', $template['ID']).'</option>';
            }
        }
        else{
            foreach ($templates as $template) {
                echo '<option value="'.$template['ID'].'" data-value="' .$template['COMPONENTS'].'"'. ( $query_id == $template['ID'] ? 'selected' : '' ) .' >'. sprintf('%02d', $template['ID']).' &bull; '.$template['NAME'].'</option>';
            }
        }
    }
}
function get_template($id){
    $content = array('NAME' => '', 'COMPONENTS' => '');
    $one = db_one_template(DB_TABLE_TEMPLATES,$id);
    if(!empty($one)){
        foreach ($one as $template) {
            $content = $template;
        }
    }
    return $content;
}

/* List all years */
function list_years($year, $name, $date){
    $years = db_all_years(DB_TABLE);
    if(!empty($years)) {
        echo'<ul class="list list-years">';
        foreach ($years as $yeardir) {
            if (($year != null) && ($year == $yeardir['YEAR'])) {
                echo '<li class="item year open"><a class="item-title open" href="?y='.$yeardir['YEAR'].'">'.$yeardir['YEAR'].'</a>';
                list_news('list', $year, $name, $date);
            } elseif (($year == null) && ($yeardir['YEAR'] == CURRENT_YEAR)) { // open current year by default
                $year = CURRENT_YEAR;
                echo '<li class="item year open"><a class="item-title open" href="?y='.$yeardir['YEAR'].'">'.$yeardir['YEAR'].'</a>';
                list_news('list', $year, $name, $date);
            } else {
                echo '<li class="item year"><a class="item-title" href="?y='.$yeardir['YEAR'].'">'.$yeardir['YEAR'].'</a>';
            }
            echo '</li>';
        }
        echo '</ul>';
    }
}

function get_id($name,$date,$template){
    $one = db_one(DB_TABLE, $name);
    $id = 0;
    if(!empty($one)){
        foreach ($one as $newsletter){
            $newsletter_long_name = get_long_name($newsletter['DATE'],$newsletter['NAME'],false);
            $query_long_name = get_long_name($date,$newsletter['NAME'],false);
            if ($query_long_name == $newsletter_long_name) {
                if ($template == true){
                    $id = $newsletter['TEMPLATE'];
                }
                else{
                    $id = $newsletter['ID'];
                }
                break;
            }
            else{
                $id = 0;
            }
        }
    }
    return $id;
}

function next_id($table){
    $nextID = db_next_ID($table);
    $id = 1;
    foreach ($nextID as $ID) {
       $id = $ID['AUTO_INCREMENT'];
    }
    return $id;
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
        $content = "<tr><td>La newsletter $name est introuvable.</td></tr>";
    }
    elseif($content == 'bad-query'){
        $content = "<tr><td>La newsletter $name n'existe pas avec cette date ($date).</td></tr>";
    }
    $html = $head.$content.$foot;
    // Create file
    file_put_contents($filepath, $html);

    //Create html file for thumb
    //
}


