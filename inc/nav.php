<nav role="navigation" class="nav-group">
    <?php
        if($query != null){
            include('nav-'.$mode.'.php');
        }
        else{
            echo'
                <ul id="nav-home" class="nav">
                    <li class="item"><a class="btn" href="?m=builder&q=new" title="Créer une nouvelle newsletter"><i class="icon fas fa-plus"></i><span class="item-text">Créer</span></a></li><!--
                 --><li class="item"><a class="btn disabled" href="?q=last" title="Voir la dernière newsletter"><i class="icon fas fa-eye"></i><span class="item-text">Voir (last)</span></a></li><!--
                 --><li class="item"><a class="btn disabled" href="?m=editor&q=last" title="Editer la dernière newsletter"><i class="icon fas fa-pen"></i><span class="item-text">Éditer (last)</span></a></li>
                </ul><!--';
        }
    ?>
    --><ul id="nav-global" class="nav global">
        <li class="item"><a class="btn btn-secondary disabled" href="?conf=user" title="Profil"><i class="icon fas fa-user"></i></a></li><!--
        --><li class="item"><a class="btn btn-secondary disabled" href="?conf=global" title="Configuration"><i class="icon fas fa-cog"></i></a></li>
    </ul>
</nav>
