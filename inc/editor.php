<div id="editor" class="box">
    <?php
    if (isset($_GET['error'])){
        show_info('h4','error', 'newsletter-editor-title ', 'Une erreur est survenue.', $_GET['error_info']);
    }
    elseif(isset($_GET['added'])){
        // Generate static HTML
        generate_file($name, $dirpath, $filepath, $format_date);
        show_info('h4','success', 'newsletter-editor-title ', 'La nouvelle newsletter '.$name.' a bien été enregistrée.', null);
    }
    elseif(isset($_GET['ok'])){
        // Update static HTML
        generate_file($name, $dirpath, $filepath, $format_date);
        show_info('h4','success', 'newsletter-editor-title ', 'Enregistrement effectué.', null);
    }
    $content = get_content('editable',$name,$format_date);
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
                <div id="fakebody" style="font-size:12px; margin: 0; padding: 0;" border="0" cellspacing="0" cellpadding="0">
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
