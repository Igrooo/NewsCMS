<?php
/* Insert new newsletter in database */
$table = DB_TABLE;
$name  = PREFIX.$_POST['name'];
$date  = $_POST['date'];
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
    $year = date('Y', strtotime($date));
    $date_edit = CURRENT_TIME;

    $template_id = $_POST['template'];
    //$title     = $_POST['user-name'];

    /* Add tracking in not editable links */
    $editable  = $_POST['content-editable'];
    $generated = add_tracking($_POST['content-generated'],$date,$name);

    $editable  = clean_html($editable);
    $generated = clean_html($generated);

    $data  = [
        'year'      => $year,
        'date'      => $date,
        'name'      => $name,
        'editable'  => $editable,
        'generated' => $generated,
        'template'  => $template_id,
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