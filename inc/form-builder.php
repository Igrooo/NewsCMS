
<form id="form-builder" method="post">
    <?php
    if ($query != 'new') {
        $ID = get_id($name, $date);
        echo '<input class="ipt-hidden" id="newsletter-id"   type="text" name="id"   value="'.$ID.'" title="id" hidden readonly>';
        $name_without_prefix = str_replace(PREFIX,'',$name);
    }
    ?>
    <div class="ipt-group ipt-group-date">
        <label class="ipt-label" for="input-date">Date d'envoi</label>
        <input class="ipt" id="input-date" type="date" <?php if ($query == 'new'){ echo'min="'.CURRENT_DATE.'"'; } else{echo'value="'.$date.'"';} ?>  name="date" required>
    </div><!--
    --><div class="ipt-group ipt-group-name">
        <label class="ipt-label" for="input-name">Nom</label>
        <input class="ipt ipt-inline" id="input-prefix" readonly disabled type="text" value="<?php echo PREFIX;?>" name="prefix" title="Préfixe"><input class="ipt ipt-inline" id="input-name" <?php if ($query != 'new'){echo 'value="'.$name_without_prefix.'"';} ?> placeholder="Pour générer le nom du fichier html" title="Aucun caractères spéciaux, merci. :)" type="text" name="user-name" minlength="1" maxlength="50" required>
    </div><!--
    --><div class="ipt-group ipt-group-title hidden">
        <label class="disabled ipt-label" for="input-title">Titre principal</label>
        <input class="ipt" id="input-title" placeholder="Optionnel et modifiable plus tard..." title="Texte par défault pour les principaux titres et textes alternatifs des images" type="text" name="user-title" minlength="1" maxlength="100" disabled>
    </div>
    <input     class="ipt-hidden" <?php if ($query != 'new'){echo 'value="'.$name.'"';} ?> id="newsletter-name" type="text"   name="name" title="name" hidden>
    <input     class="ipt-hidden" id="newsletter-template" type="number" name="template" title="template" readonly hidden value="0">
    <label     class="ipt-label"  for="newsletter-content-editable">Composition de la newsletter</label>
    <textarea wrap="off" class="ipt-hidden" id="newsletter-content-editable"  name="content-editable"  title="content-editable"  hidden>
        <?php
        if ($query != 'new') {
            $content = get_content('editable', $name, $date);
            if ($content == 'empty') {
                echo'<tr>';
                show_info('td','warning', 'newsletter-builder-title', 'La newsletter '.$name.' est introuvable.',null);
                echo'</tr>';
            } elseif ($content == 'bad-query') {
                echo'<tr>';
                show_info('td','warning', 'newsletter-builder-title', 'La newsletter '.$name.' n\'existe pas avec cette date ('.$date.').',null);
                echo'</tr>';
            } else {
                echo $content;
            }
        }
        ?>
    </textarea>
    <textarea wrap="off" class="ipt-hidden" id="newsletter-content-generated" name="content-generated" title="content-generated" hidden>
        <?php
        if ($query != 'new') {
            $content = get_content('generated', $name, $date);
            if ($content == 'empty') {
                echo'<tr>';
                show_info('td','warning', 'newsletter-builder-title', 'La newsletter '.$name.' est introuvable.',null);
                echo'</tr>';
            } elseif ($content == 'bad-query') {
                echo'<tr>';
                show_info('td','warning', 'newsletter-builder-title', 'La newsletter '.$name.' n\'existe pas avec cette date ('.$date.').',null);
                echo'</tr>';
            } else {
                echo $content;
            }
        }
        ?>
    </textarea>
</form>
<span id="placeholder-location" data-num="<?php echo PLACEHOLDER_NUM; ?>" class="hidden"><?php echo CURRENT_DIR.FOLDER_PLACEHOLDER; ?></span>