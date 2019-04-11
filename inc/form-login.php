<!DOCTYPE HTML>
<html lang="<?php echo LANG ?>">
<head>
    <meta charset="<?php echo CHARSET ?>">
    <title><?php echo APP_NAME.' - '.COMPANY_NAME ?></title>
    <link rel="icon" type="image/png" href="<?php echo APP_FAVICON ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo FOLDER_CSS ?>fa/all.min.css">
    <link type="text/css" rel="stylesheet" href="<?php echo FOLDER_CSS ?>style.css">
</head>
<body class="login">
    <header id="header" class="reset cms-ui big">
        <a id="logo" href="<?php echo CURRENT_DIR;?>">
            <div class="icon-box"><?php echo APP_ICON_BIG ?></div>
            <h1 id="title"><span class="name-app"><?php echo APP_NAME ?></span></h1>
            <h2 id="subtitle">
                <img  class="company-logo" src="<?php echo COMPANY_LOGO ?>" alt="<?php echo COMPANY_NAME ?>">
                <span class="company-name"><?php echo COMPANY_NAME ?></span>
            </h2>
        </a>
    </header>
    <main role="main">
        <section class="reset cms-ui" id="login">
            <h3>Connexion</h3>
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
        </section>
    </main>
    <footer class="footer reset cms-ui">
        <p>&copy; <?php echo COMPANY_NAME ?></p>
    </footer>
</body>
</html>