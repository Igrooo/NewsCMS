<div id="builder" class="box <?php echo $query?>" <?php echo $template_mode ? 'data-builder-type="template"':'data-builder-type=""'; ?>>
    <?php
    if (isset($_GET['error'])){
        show_info('h4','error', 'newsletter-builder-title', 'Une erreur est survenue', $_GET['error_info']);
    }
    if ($template_mode){
        $template = get_template($query_id);
        $name = $template['NAME'];
        $components = $template['COMPONENTS'];
        if(isset($_GET['added'])){
            show_info('h4','success', 'newsletter-editor-title ', "La nouveau modèle à bien été enregistré.", null);
        }
        elseif(isset($_GET['ok'])){
            show_info('h4','success', 'newsletter-editor-title ', 'Modifications enregistrées.', null);
        }
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
        include ('list-cpts.php');
        include ('builder-cpts.php');
        ?>
    </div>
</div>
