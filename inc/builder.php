<div id="builder" class="box <?php echo $query?>">
    <?php
    if (isset($_GET['error'])){
        show_info('h4','error', 'newsletter-builder-title', 'Une erreur est survenue', $_GET['error_info']);
    }
    if ($query == 'new'){
        include('form-builder.php');
    }
    ?>
    <h4 class="newsletter-builder-title hidden">Composition de la newsletter</h4>
    <div class="float-box-container with-box-sticky">
        <?php
        include ('nav-aside-builder.php');
        include ('list-cpts.php')
        ?>
        <!-- NEWSLETTER BUILDER -->
        <div id="newsletter-builder">
            <div id="<?php echo $query ?>">
                <div id="fakebody" style="font-size:12px; margin: 0; padding: 0;" border="0" cellspacing="0" cellpadding="0">
                    <table border="0" style="width: 100%;" cellspacing="5" cellpadding="0" width="100%" bgcolor="" align="center">
                        <tbody class="ui-sortable">
                        <?php
                        if ($query != 'new') {
                            $content = get_content('editable', $name, $format_date);
                            if ($content == 'empty') {
                                echo'<tr>';
                                show_info('td','warning', 'newsletter-builder-title', 'La newsletter '.$name.' est introuvable.',null);
                                echo'</tr>';
                            } elseif ($content == 'bad-query') {
                                echo'<tr>';
                                show_info('td','warning', 'newsletter-builder-title', 'La newsletter '.$name.' n\'existe pas avec cette date ('.$date.').',null);
                                echo'</tr>';
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
