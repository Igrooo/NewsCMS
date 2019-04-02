<?php
/* Insert new newsletter in database */
$table = DB_TABLE;

$date  = $_POST['date'];
$name  = $_POST['name'];
$year  = date('Y', strtotime($date));

$new_date_name = get_long_name($date,$name,false);

// check if newsletter with same name and date exist already
$one = db_one($table, $name);
if(!empty($one)){
    foreach ($one as $newsletter){
        $exist_date_name = get_long_name($newsletter['DATE'],$newsletter['NAME'],false);
        if($new_date_name == $exist_date_name){
            $exist = true;
            break;
        }
        else{
            $exist = false;
        }
    }
}

// false if table is empty
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
    $date_edit = CURRENT_TIME;

    $template  = $_POST['template'];
    //$title     = $_POST['user-name'];

    /* Add tracking in not editable links */
    $generated = add_tracking($_POST['content-generated'],$date,$name);

    /* Convert &amp; in urls */
    $editable  = convert_amp($_POST['content-editable']);
    $generated = convert_amp($generated);

    // prevent bad character ' for sql query
    $editable  = addslashes($editable);
    $generated = addslashes($generated);

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