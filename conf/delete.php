<?php
/* Remove newsletter of database */
$table = DB_TABLE;

$id = $_GET['id'];

$delete = db_delete($table, $id);

if($delete == false){
    $error_info = urlencode ("$name n'a pas pu être supprimée.");
    $location = "?y=$year&d=$date&q=$name&error&del&error_info=$error_info";
    //Redirection
    header("Location: $location");
}

