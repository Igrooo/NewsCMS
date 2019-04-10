<form id="form-builder" method="post">
    <?php
    if ($query != 'new') {
        $ID = $query_id;
    }
    else{
        $ID = next_id(DB_TABLE_TEMPLATES);
    }
    ?>
    <div class="ipt-group ipt-group-name">
        <label class="ipt-label" for="input-name">Nom du modèle</label>
        <input class="ipt ipt-inline" id="input-id" readonly disabled type="text" value="Modèle <?php echo sprintf('%02d',$ID);?>" name="user-id" title="Numéro de modèle"><input class="ipt ipt-inline template" id="input-name" <?php if ($query != 'new'){echo 'value="'.$name.'"';} ?> placeholder="Par exemple: 2x3 produits avec grands titres" title="Aucun caractères spéciaux, merci. :)" type="text" name="user-name" minlength="1" maxlength="50" required>
    </div>
    <input class="ipt-hidden" id="template-id" type="text" name="id" data-id="<?php echo sprintf('%02d',$ID);?>" value="<?php echo $ID;?>" title="id" hidden readonly>
    <input class="ipt-hidden" <?php if ($query != 'new'){echo 'value="'.$name.'"';} ?> id="template-name" type="text" name="name" title="name" hidden>
    <input class="ipt-hidden" <?php if ($query != 'new'){echo 'value="'.$components.'"';} ?> id="template-components" type="text" name="components" title="components" hidden>
</form>
<span id="placeholder-location" data-num="<?php echo PLACEHOLDER_NUM; ?>" class="hidden"><?php echo CURRENT_DIR.FOLDER_PLACEHOLDER; ?></span>