<?php
$template_id = get_id($name, $date, true);
?>
<div class="float-box float-box-left float-box-sticky reset cms-ui">
    <div class="nav-aside viewer-nav-aside">
        <a href="<?php echo "?m=builder&y=$year&d=$date&q=$query";?>" class="btn btn-secondary btn-block template-id" title="Changer de modèle">
            <?php
            if($template_id == 0){
                echo '
                      <i class="icon icon-box far fa-3x fa-file"></i>
                      Pas de modèle';
            }
            else{
                echo '
                      <i class="icon icon-box fas fa-3x fa-file-invoice"></i>
                      Modèle '.sprintf('%02d',$template_id);
            }
            ?>
        </a>
    </div>
</div>
<div class="float-box float-box-right float-box-sticky reset cms-ui">
    <div class="nav-aside viewer-nav-aside toggle-responsive-viewer">
        <a id="toggle-mobile" class="btn btn-secondary btn-block mobile" title="Passer à la vue mobile"><i class="icon icon-box fas fa-3x fa-mobile-alt"></i> Mobile</a>
        <a id="toggle-desktop" class="btn btn-secondary btn-block desktop hidden" title="Passer à la vue ordinateur"><i class="icon icon-box fas fa-3x fa-desktop"></i> Desktop</a>
    </div>
</div>