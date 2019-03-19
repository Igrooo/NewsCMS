<?php
/* Insert new newsletter in database */
$table = DB_TABLE;

$date        = $_POST['date'];
$format_date = str_replace('-','',$date);
$name        = PREFIX.$_POST['name'];
$year      = date('Y', strtotime($date));

$new_date_name = $format_date.'_'.$name;

// check if newsletter with same name and date exist already
$one = db_one($table, $name);

if(!empty($one)){
    foreach ($one as $newsletter){
        $exist_name = ($newsletter['NAME']);
        $exist_date = ($newsletter['DATE']);
        $format_exist_date = str_replace('-','',$exist_date);
        $exist_date_name = $format_exist_date.'_'.$exist_name;
        if($new_date_name == $exist_date_name){
            $exist = true;
            break;
        }
        else{
            $exist = false;
        }
    }
}

// empty if table is empty
else{
    $exist = false;
}

if($exist == true){
    // Error
    // Go back to builder
    $error_info = urlencode ("Une newsletter avec la même date ($date) et le même nom ($name) existe déjà.");
    $location = "?m=builder&q=new&error&error_info=$error_info";
}
// else
else{
    $year      = date('Y', strtotime($date));
                // prevent bad character ' for sql query
    $editable  = addslashes($_POST['content-editable']);
    $generated = addslashes($_POST['content-generated']);
    $template  = $_POST['template'];
    $date_edit = CURRENT_TIME;

    $data  = [
        'year'      => $year,
        'date'      => $date,
        'name'      => $name,
        'editable'  => $editable,
        'generated' => $generated,
        'template'  => $template,
        'date_edit' => $date_edit
    ];

    // Insert new newsletter in database //
    $insert = db_insert($table, $data);

    if($insert == false){
        $error_info = urlencode ("$name n'a pas été enregistrée");
        $location = "?m=builder&q=new&error&error_info=$error_info";
    }
    else{
        // Continue to editor
        $location = "?m=editor&y=$year&d=$date&q=$name&added";
    }
}
//Redirection
header("Location: $location");
exit;