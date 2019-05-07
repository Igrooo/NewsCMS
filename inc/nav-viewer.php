<?php
$id = get_id($name,$date, false);
?>
<ul class="nav viewer">
    <li id="delete" class="item">
        <a id="delete-btn" class="btn del" href="#delete" title="Supprimer cette newsletter"><i class="icon fas fa-trash-alt"></i></a>
        <a id="delete-confirm-btn" class="btn del" href="<?php echo "?delete&id=$id";?>" title=""><i class="icon fas fa-trash-alt"></i> Supprimer</a>
        <div id="delete-confirm-title">Supprimer <span class="file-name"><?php echo $file ?></span> ?</div>
    </li><!--
 --><li class="item"><a class="btn" href="<?php echo"?m=builder&y=$year&d=$date&q=$query";?>" title="Modifier le nom, la date et les composants de cette newsletter"><i class="icon fas fa-cog"></i></a></li>
</ul><!--
--><ul class="nav viewer"><li class="item"><a class="btn" href="<?php echo "?m=editor&y=$year&d=$date&q=$query";?>" title="Modifier le contenu de cette newsletter"><i class="icon fas fa-pen"></i><span class="item-text">Éditer</span></a></li><!--
 --><li class="item"><a class="btn disabled" href="#" title="Créer une nouvelle newsletter à partir de celle-ci"><i class="icon far fa-copy"></i><span class="item-text">Dupliquer</span></a></li><!--<?php echo "?m=editor&y=$year&d=$date&q=new&c=$query";?>--><!--
 --><li class="item"><a class="btn" href="<?php echo "?download&y=$year&d=$date&q=$query";?>" title="Télécharger le fichier html"><i class="icon fas fa-download"></i><span class="item-text">Télécharger</span></a></li><!--
 --><li class="item"><a class="btn" href="<?php echo $filepath;?>" title="Ouvrir le fichier html dans un nouvel onglet" target="_blank"><i class="icon fas fa-external-link-alt"></i></a></li>
</ul><!--