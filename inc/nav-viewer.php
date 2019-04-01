<ul class="nav viewer">
    <li class="item"><a class="btn" href="<?php echo'?m=builder&y='.$year.'&d='.$date.'&q='.$query;?>" title="Modifier la date et les composants de cette newsletter"><i class="icon fas fa-cog"></i></a></li><!--
 --><li class="item"><a class="btn" href="<?php echo'?m=editor&y='.$year.'&d='.$date.'&q='.$query;?>" title="Éditer"><i class="icon fas fa-pen"></i><span class="item-text">Éditer</span></a></li><!--
 --><li class="item"><a class="btn disabled" href="#" title="Créer une nouvelle newsletter à partir de celle-ci"><i class="icon far fa-copy"></i><span class="item-text">Dupliquer</span></a></li><!--<?php echo'?m=editor&y='.$year.'&d='.$date.'&q=new&c='.$query;?>--><!--
 --><li class="item"><a class="btn" href="<?php echo'?download&y='.$year.'&d='.$date.'&q='.$query;?>" title="Télécharger le fichier html"><i class="icon fas fa-download"></i><span class="item-text">Télécharger</span></a></li><!--
 --><li class="item"><a class="btn" href="<?php echo $filepath;?>" title="Ouvrir le fichier html dans un nouvel onglet" target="_blank"><i class="icon fas fa-external-link-alt"></i></a></li>
</ul><!--