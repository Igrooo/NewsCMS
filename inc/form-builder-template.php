
<form id="form-builder" method="post">
    <?php
    if ($query != 'new') {
        $ID = get_id($name, $date);
    }
    else{
        $ID = next_id();
    }
    ?>
    <div class="ipt-group ipt-group-name">
        <label class="ipt-label" for="input-name">Nom du modèle</label>
        <input class="ipt ipt-inline" id="input-id" readonly disabled type="text" value="n°<?php echo $ID;?>" name="user-id" title="Numéro"><input class="ipt ipt-inline template" id="input-name" <?php if ($query != 'new'){echo 'value="'.$name.'"';} ?> placeholder="Par exemple: 2x3 produits avec grands titres" title="Aucun caractères spéciaux, merci. :)" type="text" name="user-name" minlength="1" maxlength="50" required>
    </div>
    <input class="ipt-hidden" id="template-id" type="text" name="id" value="<?php echo $ID;?>" title="id" hidden readonly>
    <input class="ipt-hidden" <?php if ($query != 'new'){echo 'value="'.$name.'"';} ?> id="template-name" type="text" name="name" title="name" hidden>
    <label class="ipt-label"  for="newsletter-content-editable">Composition du modèle</label>
    <textarea wrap="off" class="ipt-hidden" id="newsletter-content-editable" name="content-editable" title="content-editable" hidden>
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