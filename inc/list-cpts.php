<!-- Components in Database -->
<table id="newsletter-builder-components" class="components-list hidden">
    <?php
    include ('text.php');
    $table = DB_TABLE_COMPONENTS;
    $components = db_all_cpt($table);
    foreach ($components as $component){
        // generate fake text
/*        if(strpos($component['CONTENT'],'[random-text]')!= false){
            $rand_text = array_rand($text, 5);
            $placeholder = $text[$rand_text[0]].'<br>'.$text[$rand_text[1]].'<br>'.$text[$rand_text[2]].'<br>'.$text[$rand_text[3]].'<br>'.$text[$rand_text[4]];
            $component['CONTENT'] = str_replace('[random-text]',$placeholder,$component['CONTENT']);
        }*/
        echo'<tr class="newsletter-builder-row newsletter-editor-row draggable" data-id="'.$component['ID'].'" data-section="'.$component['SECTION'].'" data-type="'.$component['TYPE'].'" data-name="'.$component['NAME'].'" style="" title="Maintenez et glissez pour déplacer">
        <!-- **************************************** -->
        <!-- '.$component['NAME'].' -->
        <!-- '.$component['NAME_UI'].' -->
            <td valing="top" align="center">
                <div class="newsletter-builder-ui grip">
                    <span class="icon"><i class="fas fa-grip-lines-vertical"></i></span>
                </div>
                '.$component['CONTENT'].'
                <div class="newsletter-builder-ui remove">
                    <a class="icon btn-ui btn-remove" href="#" title="Retirer cet élément"><i class="fas fa-times"></i></a>
                </div>
            </td>
        <!-- end '.$component['NAME'].' -->
        <!-- **************************************** -->
        </tr>';
    }
    ?>
</table>