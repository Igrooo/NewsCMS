<div id="builder" class="box <?php echo $query?>" <?php echo $template ? 'data-builder-type="template"':'data-builder-type=""'; ?>>
    <?php
    if (isset($_GET['error'])){
        show_info('h4','error', 'newsletter-builder-title', 'Une erreur est survenue', $_GET['error_info']);
    }
    if ($template){
        include('form-builder-template.php');
        echo '<h4 class="newsletter-builder-title">Composition du modèle</h4>';
    }
    else{
        include('form-builder.php');
        echo '<h4 class="newsletter-builder-title hidden">Composition de la newsletter</h4>';
    }
    ?>

    <div class="float-box-container with-box-sticky">
        <?php
        include ('nav-aside-builder.php');
        include ('list-cpts.php')
        ?>
        <!-- NEWSLETTER BUILDER -->
        <div id="newsletter-builder">
            <div id="<?php echo $query ?>">
                <div id="fakebody" style="font-size:12px; margin: 0; padding: 0;">
                    <table border="0" style="width: 100%;" cellspacing="5" cellpadding="0" width="100%" bgcolor="" align="center">
                        <tbody class="ui-sortable">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END NESLETTER BUILDER -->
    </div>
</div>
