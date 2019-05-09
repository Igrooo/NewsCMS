<!DOCTYPE HTML>
<html lang="<?php echo LANG ?>">
<?php
include('head.php');
?>
<body class="mode-<?php echo $mode; echo $template_mode ? ' template':'';?>">
        <?php
            if (!$query || !$template_mode || !$conf) {
                echo'<div id="page-loader" class="loader">'.APP_ICON_BIG.'</div>';
                $loading = true;
            }
            else{
                $loading = false;
            }
        ?>

    <div id="page" class="<?php echo $loading ? 'page-loading':'';?>">
        <header id="header" class="section-container reset cms-ui">
            <?php
                include('header.php');
                include('nav.php');
            ?>
        </header>
        <main role="main">
            <section id="explorer" class="section-container reset cms-ui">
                <?php include('explorer.php');?>
            </section><!--
            --><section class="app section-container scroller">
                <div class="app-container-with-scroller">
                <?php
                    if( $query || $template_mode ){
                        include("$mode.php");
                    }
                    elseif($conf){
                        include ("conf-$conf.php");
                    }
                    elseif (!$newsthumbs) {
                        $year = CURRENT_YEAR;
                        include('empty.php');
                        include('explorer-grid.php');
                    }
                    else{
                        include('explorer-grid.php');
                    }
                ?>
                </div>
            </section>
        </main>
    </div>
</body>
</html>