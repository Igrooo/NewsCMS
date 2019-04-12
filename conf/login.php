<?php
if (isset($_POST['user']) && ($_POST['user'] == USER_LOGIN) && isset($_POST['pass']) &&  ($_POST['pass'] == USER_PASSWORD) ){
    $_SESSION['logged'] = true;
    setcookie('logged','true',time()+3600);
    header("Location: ./");
}
else{
    session_destroy();
    setcookie('logged','',time()-3600);
    header("Location: ?error&error_info=badid");
    exit;
}