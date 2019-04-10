<div id="list-all-newsletters">
    <div class="list-header">
        <h4 class="list-title">
            <a href="#">Liste des Newsletters</a>
            <span class="explorer-nav"><a target="_blank" href="<?php echo FOLDER_HTML ?>" title="Ouvrir le dossier des fichiers HTML dans un nouvel onglet"><i class="icon fas fa-external-link-alt"></i></a></span>
        </h4>
    </div>
    <div class="list-body">
        <?php
        list_years($year, $name, $date);
        ?>
    </div>
</div>
<div id="list-all-templates">
    <div class="list-header">
        <h4 class="list-title">
            <a href="#explorer">Liste des Modèles</a>
            <span class="explorer-nav"><a href="?m=builder&t&q=new" title="Créer un nouveau modèle"><i class="icon fas fa-plus"></i></a></span>
        </h4>
    </div>
    <div class="list-body">
        <?php
            list_templates('list',$query_id);
        ?>
    </div>
</div>
<footer id="history" class="footer">
    <?php echo $last_edited; ?>
</footer>