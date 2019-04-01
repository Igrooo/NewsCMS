<div class="float-box float-box-sticky float-box-left reset cms-ui">
    <h4 class="box-title nav-title add-title">
        Ajouter
    </h4>
    <!-- Components in Database -->
    <?php
    $table = DB_TABLE_COMPONENTS;
    $sections = db_all_cpt_sections($table);
    foreach ($sections as $section){
        switch ($section['SECTION']){
            case 'header':
                $section_name = 'En-tête';
                break;
            case 'content':
                $section_name = 'Contenu';
                break;
            case 'footer':
                $section_name = 'Pied';
                break;
            case 'separator':
                $section_name = 'Séparateur';
                break;
        }
        echo '
        <nav id="builder-nav-add-cpt-'.$section['SECTION'].'" role="navigation" class="nav-aside builder-nav-aside nav-components">
            <h5 class="cpt-section nav-title nav-title-list-rotate components-title"><span class="title-text">'.$section_name.'</span></h5>';
            if (($section['SECTION'] == 'header')||($section['SECTION'] == 'separator')) {
                // no group by type because one component by type in header and only one type in separator
                echo '<ul class="nav vertical tools compact with-nav-title-rotate components-list components-list-'.$section['SECTION'].' with-btn-flex">';
                $types = db_all_cpt_types($table, $section['SECTION']);
                foreach ($types as $type) {
                    $components = db_all_cpt_bytype($table, $section['SECTION'], $type['TYPE']);
                    foreach ($components as $component) {
                        echo '<li class="item"><a class="btn btn-secondary btn-flex builder-nav-aside-btn" data-section="'.$component['SECTION'].'" data-type="'.$component['TYPE'].'" data-id="'.$component['ID'].'"><span class="cpt-name">'.$component['NAME_UI'].'</span><i class="icon nav-icon fa fa-plus"></i></a></li>';
                    }
                }
                echo '</ul>';
            }
            else{
                echo '<ul class="nav vertical tools with-nav-title-rotate components-list components-list-'.$section['SECTION'].'">';
                $types = db_all_cpt_types($table, $section['SECTION']);
                foreach ($types as $type){
                    switch ($type['TYPE']){
                        case 'txt':
                            $type_name = 'Textes';
                            $type_icon = 'font';
                            break;
                        case 'img':
                            $type_name = 'Images';
                            $type_icon = 'image';
                            break;
                        case 'pdt':
                            $type_name = 'Produits';
                            $type_icon = 'euro-sign';
                            break;
                        case 'lin':
                            $type_name = 'Liens';
                            $type_icon = 'link';
                            break;
                    }
                    echo '<li class="item with-sub-nav">
                        <span class="btn cpt-type"><i class="cpt-icon cpt-icon-'.$type['TYPE'].' fas fa-'.$type_icon.'"></i><span class="cpt-type-name">'.$type_name.'</span></span>
                        <ul class="nav vertical tools compact sub-nav components-list components-list-'.$type['TYPE'].'">';
                    $components = db_all_cpt_bytype($table, $section['SECTION'], $type['TYPE']);
                    foreach ($components as $component){
                        echo'<li class="item"><a class="btn btn-secondary builder-nav-aside-btn" data-section="'.$component['SECTION'].'" data-type="'.$component['TYPE'].'" data-id="'.$component['ID'].'"><span class="cpt-name">'.$component['NAME_UI'].'</span><i class="icon nav-icon fa fa-plus"></i></a></li>';
                    }
                    echo '</ul>
                      </li>';
                }
                echo '</ul>';
            }

        echo '</nav>';
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
