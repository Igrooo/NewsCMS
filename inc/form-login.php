<?php
if (isset($_GET['error'])){
    if(isset($_GET['error_info']) &&  $_GET['error_info']== 'badid'){
        $error_info = 'Identifiant ou mot de passe invalide';
    }
    else{
        $error_info ='';
    }
    show_info('h4','error', 'login-title', 'Échec de la connexion', $error_info);
}
elseif (isset($_GET['ok'])){
    show_info('h4','info', 'login-title', 'Déconnexion effectuée.', null);
}
?>
<form action="?login" method="post" id="form-login">
    <div class="ipt-group">
        <label class="ipt-label hidden" for="user">Identifiant</label>
        <input class="ipt" type="text" id="user" name="user" value="" placeholder="Identifiant" required>
    </div>
    <div class="ipt-group">
        <label class="ipt-label hidden" for="pass">Mot de passe</label>
        <input class="ipt" type="password" id="pass" name="pass" value="" placeholder="Mot de passe" required>
    </div>
    <button id="form-login-submit" class="btn btn-block btn-primary" type="submit">Connexion</button>
</form>