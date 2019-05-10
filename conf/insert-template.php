<?php
/* Insert new template in database */
$table = DB_TABLE_TEMPLATES;
$id    = $_POST['id'];
$name  = $_POST['name'];
$cpts  = $_POST['components'];

// Insert new template in database //
$insert = db_insert_template($table, $name, $cpts);

if($insert == false){
    $error_info = urlencode ("Le modèle $name n'a pas été enregistré");
    $location = "?m=builder&t&q=new&error&error_info=$error_info";
}
else{
    // Continue to builder
    $location = "?m=builder&t&id=$id&added";
}

//Redirection
header("Location: $location");
exit;