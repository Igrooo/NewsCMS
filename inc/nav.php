<nav role="navigation" class="nav-group">
    <?php
        if($query != null){
            include('nav-'.$mode.'.php');
        }
        else{
            echo'
                <ul id="nav-home" class="nav">
                    <li class="item"><a class="btn" href="?m=builder&q=new" title="Créer une nouvelle newsletter"><i class="icon fas fa-plus"></i><span class="item-text">Créer</span></a></li><!--
                 --><li class="item"><a class="btn" href="?y='.$history['year'].'&d='.$history['date'].'&q='.$history['name'].'" title="Voir la dernière newsletter"><i class="icon fas fa-eye"></i><span class="item-text">'.$history['long_name'].'</span></a></li><!--
                 --><li class="item"><a class="btn" href="?m=editor&y='.$history['year'].'&d='.$history['date'].'&q='.$history['name'].'" title="Editer la dernière newsletter"><i class="icon fas fa-pen"></i><span class="item-text">'.$history['long_name'].'</span></a></li>
                </ul><!--';
        }
    ?>
    --><ul id="nav-global" class="nav global">
        <li id="user-menu" class="item with-sub-nav">
            <a class="btn btn-secondary" href="#user-menu" title="Utilisateur"><i class="icon fas fa-user"></i></a>
            <ul class="nav vertical sub-nav">
                <li class="sub-item"><a class="btn btn-secondary disabled" href="?conf=user" title="Profil"><i class="icon fas fa-user-cog"></i><span class="item-text">Profil</span></a></li>
                <li class="sub-item"><a class="btn btn-secondary" href="?logout" title="Profil"><i class="icon fas fa-sign-out-alt"></i><span class="item-text">Déconnexion</span></a></li>
            </ul>
        </li><!--
        --><li class="item"><a class="btn btn-secondary disabled" href="?conf=global" title="Configuration"><i class="fas fa-tools"></i></a></li>
    </ul>
</nav>
