<?php
/* Update newsletter date, name or components in database with Builder */
$table = DB_TABLE;
$id = $_POST['id'];
$name = PREFIX.$_POST['name'];
$date = $_POST['date'];
$year = date('Y', strtotime($date));
$date_edit = CURRENT_TIME;
$template_id = $_POST['template'];
//$title  = $_POST['user-name'];

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

// Update newsletter in database //
$insert = db_full_update($table, $id, $data);

if($insert == false){
    $error_info = urlencode ("$name n'a pas été enregistrée");
    $location = "?m=builder&y=$year&d=$date&q=$name&error&error_info=$error_info";
}
else{
    // Continue to viewer
    $location = "?y=$year&d=$date&q=$name&ok";
}

//Redirection
header("Location: $location");
exit;