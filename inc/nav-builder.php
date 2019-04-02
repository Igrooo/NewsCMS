<ul class="nav builder">
    <?php
    if ($query == 'new'){
        echo'<li class="item"><button form="form-builder" type="reset"  id="builder-reset"  class="btn" title="Annuler toutes les modifications" disabled><i class="icon fas fa-undo-alt"></i><span class="item-text">Tout annuler<span class="item-text"></button></li><!--
          --><li class="item"><button form="form-builder" type="submit" id="builder-submit" class="btn" title="Enregistrer cette nouvelle newsletter et ajouter le contenu" formaction="?new" disabled><i class="icon fas fa-pen"></i><span class="item-text">Ajouter le contenu<span class="item-text"></button></li>';
    }
    else{
        echo'<li class="item"><button form="form-builder" type="reset"  id="builder-reset"  class="btn" title="Retirer tout les composants de la newsletter" disabled><i class="icon fas fa-undo-alt"></i><span class="item-text">Effacer tout<span class="item-text"></button></li><!--
          --><li class="item"><button form="form-builder" type="submit" id="builder-submit" class="btn" title="Enregistrer les modifications" formaction="?update" disabled><i class="icon fas fa-check"></i><span class="item-text">Enregistrer<span class="item-text"></button></li>';
    }
    ?>
</ul><!--