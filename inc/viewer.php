<!-- NEWSLETTER VIEWER -->
<div id="viewer" class="box">
    <?php
    if (isset($_GET['error'])){
        show_info('h4','error', 'newsletter-viewer-title ', 'Une erreur est survenue.', $_GET['error_info']);
    }
    elseif (isset($_GET['ok'])){
        // Generate static HTML
        generate_file($name, $dirpath, $filepath, $date);
        show_info('h4','success', 'newsletter-viewer-title ', 'Enregistrement effectué.', null);
    }
    ?>
    <div class="float-box-container with-box-sticky">
        <?php
        include ('nav-aside-viewer.php');
        ?>
        <!-- NEWSLETTER VIEWER -->
        <div id="newsletter-viewer">
            <div id="<?php echo $query?>">
                <div id="fakebody" style="font-size:12px; margin: 0; padding: 0;">
                    <table border="0" style="width: 100%;" cellspacing="5" cellpadding="0" width="100%" bgcolor="" align="center">
                        <?php
                        $content = get_content('generated',$name,$date);
                        if($content == 'empty'){
                            echo'<tr>';
                            show_info('td','warning', 'newsletter-viewer-title', 'La newsletter '.$name.' est introuvable.',null);
                            echo'</tr>';
                        }
                        elseif($content == 'bad-query'){
                            echo'<tr>';
                            show_info('td','warning', 'newsletter-viewer-title', 'La newsletter '.$name.' n\'existe pas avec cette date ('.$date.').',null);
                            echo'</tr>';
                        }
                        else{
                            echo $content;
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <!-- END NEWSLETTER VIEWER -->
    </div>
</div>

