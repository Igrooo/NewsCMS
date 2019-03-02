<div id="editor" class="box">
    <?php
    $name = $query;
    if (isset($_GET['error'])){
        echo'<h4 class="newsletter-editor-title error error-box">
            <i class="fas fa-exclamation-triangle"></i> Une erreur est survenue.<br>
            '.$_GET['error_info'].'
            </h4>';
    }
    elseif(isset($_GET['added'])){
        // Generate static HTML
        generate_file($name, $dirpath, $filepath, $format_date);
        echo'<h4 class="newsletter-editor-title info info-box">
                <i class="fas fa-info-circle"></i> La nouvelle newsletter '.$name.' a bien été enregistrée.<br>
            </h4>';
    }
    elseif(isset($_GET['ok'])){
        // Update static HTML
        generate_file($name, $dirpath, $filepath, $format_date);
        echo'<h4 class="newsletter-editor-title info info-box">
                <i class="fas fa-info-circle"></i> Enregistrement effectué.<br>
            </h4>';
    }
    include('form-editor.php');
    ?>
    <div class="float-box-container">
        <?php
        /*include ('nav-aside-editor.php');*/
        ?>
        <!-- NEWSLETTER CONTENT EDITOR -->
        <div id="newsletter-editor" class="box editor">
            <div id="<?php echo $query?>">
                <div id="fakebody" style="font-size:12px; margin: 0; padding: 0;" border="0" cellspacing="0" cellpadding="0">
                    <table border="0" style="width: 100%;" cellspacing="5" cellpadding="0" width="100%" bgcolor="" align="center">
                        <?php
                        $content = get_content('editable',$name,$format_date);
                        if($content == 'empty'){
                            echo '<tr><td class="newsletter-editor-title error error-box"><i class="fas fa-exclamation-triangle"></i> La newsletter '.$name.' est introuvable.</td></tr>';
                        }
                        elseif($content == 'bad-query'){
                            echo '<tr><td class="newsletter-editor-title error error-box"><i class="fas fa-exclamation-triangle"></i> La newsletter '.$name.' n\'existe pas avec cette date ('.$date.').</td></tr>';
                        }
                        else{
                            echo $content;
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <!-- END NEWSLETTER CONTENT EDITOR -->
    </div>
</div>
