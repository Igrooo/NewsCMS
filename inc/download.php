<?php
// Download HTML file
header('Content-Type: text/html');
header('Content-Disposition: attachment; filename="'.$file.'"');
readfile($filepath);
// Go back to editor
header("Location: ?m=editor&y=$year&d=$date&q=$name");
exit;
?>