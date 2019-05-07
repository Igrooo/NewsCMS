<?php
// Download HTML file
header('Content-Type: text/html');
header('Content-Disposition: attachment; filename="'.$file.'"');
readfile($filepath);
exit;