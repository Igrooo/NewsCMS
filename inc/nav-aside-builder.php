<div class="float-box float-box-sticky float-box-left reset cms-ui">
    <h4 class="box-title nav-title add-title">
        Ajouter
    </h4>
    <!-- Components in Database -->
    <?php
    $table = DB_TABLE_COMPONENTS;
    $types = db_all_cpt_types($table);
    foreach ($types as $type){
        echo '
        <nav id="builder-nav-add-cpt-'.$type['TYPE'].'" role="navigation" class="nav-aside builder-nav-aside nav-components">
        <h5 class="cpt-type nav-title nav-title-list-rotate components-title"><span class="title-text">'.$type['TYPE'].'</span></h5>';
        echo '<ul class="nav vertical tools compact with-nav-title-rotate components-list components-list-'.$type['TYPE'].' with-btn-flex ">';
        $components = db_all_cpt_bytype($table, $type['TYPE']);
        foreach ($components as $component){
            echo'<li class="item"><a class="btn btn-secondary btn-flex builder-nav-aside-btn" data-type="'.$component['TYPE'].'" data-id="'.$component['ID'].'"><img class="cpt-img" src="'.FOLDER_IMG.'cpt-'.$component['NAME'].'.png"><span class="cpt-name">'.$component['NAME_UI'].'</span><i class="icon nav-icon fa fa-plus"></i></a></li>';
        }
        echo '</ul>
        </nav>';
    }
    ?>

    <!--
    <nav id="builder-nav-change-template" role="navigation" class="nav-aside nav-templates">
        <h5 class="nav-title template-title">Modèle</h5>
        <ul class="nav vertical tools">
            <li class="item"><a class="btn btn-secondary disabled">Modèle 01</a></li>
        </ul>
    </nav>
    -->
</div>
