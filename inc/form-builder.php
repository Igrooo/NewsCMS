<form id="form-builder" method="post">
    <div class="ipt-group ipt-group-date">
        <label class="ipt-label" for="input-date">Date d'envoi</label>
        <input class="ipt" id="input-date" type="date" min="<?php echo CURRENT_DATE;?>" name="date" required>
    </div><!--
 --><div class="ipt-group ipt-group-name">
        <label class="ipt-label" for="input-name">Nom</label>
        <input class="ipt ipt-inline" id="input-prefix" disabled type="text" value="<?php echo PREFIX;?>" name="prefix" title="Préfixe"><input class="ipt ipt-inline" id="input-name" placeholder="Pour générer le nom du fichier html" title="Aucun caractères spéciaux, merci. :)" type="text" name="user-name" minlength="1" maxlength="50" required>
    </div><!--
    --><div class="ipt-group ipt-group-title">
        <label class="ipt-label" for="input-title">Titre principal</label>
        <input class="ipt" id="input-title" placeholder="Optionnel et modifiable plus tard..." title="Texte par défault pour les principaux titres et textes alternatifs des images" type="text" name="user-title" minlength="1" maxlength="100">
    </div>
    <input     class="ipt-hidden" id="newsletter-name"     type="text"   name="name"         title="name" hidden>
    <input     class="ipt-hidden" id="newsletter-template" type="number" name="template"     title="template" readonly hidden value="0">
    <label     class="ipt-label"  for="newsletter-content-editable">Composition de la newsletter</label>
    <textarea wrap="off" class="ipt-hidden" id="newsletter-content-editable"  name="content-editable"  title="content-editable"  hidden></textarea>
    <textarea wrap="off" class="ipt-hidden" id="newsletter-content-generated" name="content-generated" title="content-generated" hidden></textarea>
</form>
<span id="placeholder-location" data-num="<?php echo PLACEHOLDER_NUM; ?>" class="hidden"><?php echo CURRENT_DIR.FOLDER_PLACEHOLDER; ?></span>