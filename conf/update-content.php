<?php
/* Insert new newsletter in database */
$table = DB_TABLE;

$id = $_POST['id'];
$editable  = addslashes($_POST['content-editable']);
$generated = addslashes($_POST['content-generated']);

$name = $_POST['name'];

// Insert new newsletter in database //
$update = db_update($table, $id, $editable, $generated );

if($update == false){
    $error_info = urlencode ("$name n'a pas été enregistrée");
    $location = "?m=editor&q=new&error&error_info=$error_info";
}
else{
    $date = $_POST['date'];
    $year = date('Y', strtotime($date));
    // Continue to viewer
    $location = "?y=$year&d=$date&q=$name&ok";
}

//Redirection
header("Location: $location");
exit;