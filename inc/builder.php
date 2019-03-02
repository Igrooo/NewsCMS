<div id="builder" class="box builder <?php echo $query?>">
    <?php
    if (isset($_GET['error'])){
        echo'<h4 class="newsletter-builder-title error error-box">
                <i class="fas fa-exclamation-triangle"></i> Une erreur est survenue.<br>
                '.$_GET['error_info'].'
            </h4>';
    }
    if ($query == 'new'){
        include('form-builder.php');
    }
    ?>
    <h4 class="newsletter-builder-title hidden">Composition de la newsletter</h4>
    <div class="float-box-container">
        <?php
        include ('nav-aside-builder.php');
        include ('list-cpts.php')
        ?>
        <!-- NEWSLETTER BUILDER -->
        <div id="newsletter-builder" class="box builder">
            <div id="<?php echo $query ?>">
                <div id="fakebody" style="font-size:12px; margin: 0; padding: 0;" border="0" cellspacing="0" cellpadding="0">
                    <table border="0" style="width: 100%;" cellspacing="5" cellpadding="0" width="100%" bgcolor="" align="center">
                        <tbody class="ui-sortable">
                        <?php
                        if ($query != 'new') {
                            $name = $query;
                            $content = get_content('editable', $name, $format_date);
                            if ($content == 'empty') {
                                echo '<tr><td class="newsletter-builder-title error error-box"><i class="fas fa-exclamation-triangle"></i> La newsletter ' . $name . ' est introuvable.</td></tr>';
                            } elseif ($content == 'bad-query') {
                                echo '<tr><td class="newsletter-builder-title error error-box"><i class="fas fa-exclamation-triangle"></i> La newsletter ' . $name . ' n\'existe pas avec cette date (' . $date . ').</td></tr>';
                            } else {
                                echo $content;
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END NESLETTER BUILDER -->
    </div>
</div>
