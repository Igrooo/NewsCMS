<?php
session_destroy();
setcookie('logged','',time()-3600);
header("Location: ?ok");
exit;
