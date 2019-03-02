<div id="list-all-newsletters">
    <div class="list-header">
        <h4 class="list-title">
            Liste des Newsletters
            <span class="explorer-nav"><a target="_blank" href="<?php echo FOLDER_HTML ?>" title="Ouvrir le dossier des fichiers HTML dans un nouvel onglet"><i class="icon fas fa-external-link-alt"></i></a></span>
        </h4>
    </div>
    <div class="list-body">
        <?php
        $name = $query;
        list_years($year, $name, $format_date);
        ?>
    </div>
</div>