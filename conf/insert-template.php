<?php
/* Insert new template in database */
$table = DB_TABLE_TEMPLATES;

$id    = $_POST['id'];
$name  = $_POST['name'];
$cpts  = $_POST['components'];

// Insert new newsletter in database //
$insert = db_insert_template($table, $name, $cpts);

if($insert == false){
    $error_info = urlencode ("Le modèle $name n'a pas été enregistré");
    $location = "?m=builder&t&q=new&error&error_info=$error_info";
}
else{
    // Continue to editor
    $location = "?m=viewer&t&id=$id&ok";
}

//Redirection
header("Location: $location");
exit;