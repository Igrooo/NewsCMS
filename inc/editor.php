<div id="editor" class="box">
    <h4 id="not-editable-alert" class="cms-ui newsletter-editor-title warning warning-box hidden">
        <i class="fas fa-exclamation-circle"></i> Cette newsletter n'a aucun élément éditable !<br><br>
        <a class="btn btn-primary" href="<?php echo"?m=builder&y=$year&d=$date&q=$query";?>" title="Ajouter des composants"><i class="icon fas fa-plus"></i> Ajouter des composants</a><br><br>
    </h4>
    <?php
    if (isset($_GET['error'])){
        show_info('h4','error', 'newsletter-editor-title ', 'Une erreur est survenue.', $_GET['error_info']);
    }
    elseif(isset($_GET['added'])){
        // Generate static HTML
        generate_file($name, $dirpath, $filepath, $date);
        show_info('h4','success', 'newsletter-editor-title ', "La nouvelle newsletter $name a bien été enregistrée.", null);
    }
    elseif(isset($_GET['ok'])){
        // Update static HTML
        generate_file($name, $dirpath, $filepath, $date);
        show_info('h4','success', 'newsletter-editor-title ', 'Enregistrement effectué.', null);
    }
    else{
        show_info('h4','info', 'newsletter-editor-title ', "Sélectionnez un élément pour commencer l'édition", null);
    }
    $content = get_content('editable',$name,$date);
    include('form-editor.php');
    ?>
    <div class="float-box-container">
        <?php
        include ('nav-aside-editor.php');
        ?>
        <!-- NEWSLETTER CONTENT EDITOR -->
        <div id="newsletter-editor" class="loading">
            <div class="loader"><?php echo APP_ICON_BIG ?></div>
            <div id="<?php echo $query?>">
                <div id="fakebody" style="font-size:12px; margin: 0; padding: 0;">
                    <table border="0" style="width: 100%;" cellspacing="5" cellpadding="0" width="100%" bgcolor="" align="center">
                        <tbody>
                        <?php
                        if($content == 'empty'){
                            echo'<tr>';
                            show_info('td','warning', 'newsletter-editor-title', 'La newsletter '.$name.' est introuvable.',null);
                            echo'</tr>';
                        }
                        elseif($content == 'bad-query'){
                            echo'<tr>';
                            show_info('td','warning', 'newsletter-editor-title', 'La newsletter '.$name.' n\'existe pas avec cette date ('.$date.').',null);
                            echo'</tr>';
                        }
                        else{
                            echo $content;
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END NEWSLETTER CONTENT EDITOR -->
    </div>
</div>
