<form id="form-builder" class="compact" method="post">
    <h4 class="newsletter-builder-title">Création rapide</h4>
    <div class="ipt-group ipt-group-template">
        <select class="ipt ipt-select" id="input-template" name="template" title="Modèle">
            <?php
            $template_id = get_id($name, $date, true);
            list_templates('form-compact', $template_id);
            ?>
        </select>
    </div><!--
    --><div class="ipt-group ipt-group-date">
        <input placeholder="Date d'envoi" class="ipt" id="input-date" type="date" <?php  echo'min="'.CURRENT_DATE.'"'; ?>  name="date" required>
    </div><!--
    --><div class="ipt-group ipt-group-name">
        <input class="ipt ipt-inline" id="input-prefix" readonly disabled type="text" value="<?php echo PREFIX;?>" name="prefix" title="Préfixe"><input class="ipt ipt-inline" id="input-name" placeholder="Nom" title="Aucun caractères spéciaux, merci. :)" type="text" name="user-name" minlength="1" maxlength="50" required>
    </div><!--
    --><button type="submit" id="builder-submit" class="btn btn-primary" title="Enregistrer cette nouvelle newsletter et ajouter le contenu" formaction="?new" ><i class="icon fas fas fa-plus"></i><span class="item-text">Créer cette nouvelle newsletter<span class="item-text"></button>
    <input class="ipt-hidden" id="newsletter-name" type="text"   name="name" title="name" hidden>
    <textarea wrap="off" class="ipt-hidden" id="newsletter-content-editable" name="content-editable" title="content-editable" hidden>
    </textarea>
    <textarea wrap="off" class="ipt-hidden" id="newsletter-content-generated" name="content-generated" title="content-generated" hidden>
    </textarea>
</form>
<span id="placeholder-location" data-num="<?php echo PLACEHOLDER_NUM; ?>" class="hidden"><?php echo CURRENT_DIR.FOLDER_PLACEHOLDER; ?></span>