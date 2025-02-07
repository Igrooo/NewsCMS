<?php
/* Update newsletter content in database with Editor */
$table = DB_TABLE;
$id = $_POST['id'];
$name = $_POST['name'];
$date = $_POST['date'];
$year = date('Y', strtotime($date));
$date_edit = CURRENT_TIME;

/* Add tracking in not editable links */
$editable  = $_POST['content-editable'];
$generated = add_tracking($_POST['content-generated'],$date,$name);

$editable  = clean_html($editable);
$generated = clean_html($generated);

// Update newsletter in database //
$update = db_update($table, $id, $editable, $generated, $date_edit);

if($update == false){
    $error_info = urlencode ("$name n'a pas été enregistrée");
    $location = "?m=editor&y=$year&d=$date&q=$name&error&error_info=$error_info";
}
else{
    // Continue to viewer
    $location = "?y=$year&d=$date&q=$name&ok";
}

//Redirection
header("Location: $location");
exit;