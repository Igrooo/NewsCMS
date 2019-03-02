<!-- NEWSLETTER VIEWER -->
<div id="viewer" class="box">
    <?php
    if (isset($_GET['error'])){
        echo'<h4 class="newsletter-viewer-title error error-box">
        <i class="fas fa-exclamation-triangle"></i> Une erreur est survenue.<br>
        '.$_GET['error_info'].'
        </h4>';
    }
    elseif (isset($_GET['ok'])){
        echo'<h4 class="newsletter-viewer-title info info-box">
                <i class="fas fa-info-circle"></i> Enregistrement effectué.<br>
            </h4>';
    }
    ?>
    <div class="float-box-container">
        <!-- NEWSLETTER VIEWER -->
        <div id="newsletter-viewer" class="box viewer">
            <div id="<?php echo $query?>">
                <div id="fakebody" style="font-size:12px; margin: 0; padding: 0;" border="0" cellspacing="0" cellpadding="0">
                    <table border="0" style="width: 100%;" cellspacing="5" cellpadding="0" width="100%" bgcolor="" align="center">
                        <?php
                        $name = $query;
                        $content = get_content('generated',$name,$format_date);
                        if($content == 'empty'){
                            echo '<tr><td class="newsletter-viewer-title error error-box"><i class="fas fa-exclamation-triangle"></i> La newsletter '.$name.' est introuvable.</td></tr>';
                        }
                        elseif($content == 'bad-query'){
                            echo '<tr><td class="newsletter-viewer-title error error-box"><i class="fas fa-exclamation-triangle"></i> La newsletter '.$name.' n\'existe pas avec cette date ('.$date.').</td></tr>';
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

