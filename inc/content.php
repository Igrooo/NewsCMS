<!DOCTYPE HTML>
<html lang="<?php echo LANG ?>">
<?php
include('head.php');
?>
<body class="mode-<?php echo $mode ?>">
    <header id="header" class="section-container reset cms-ui">
        <?php
            include('header.php');
            include('nav.php');
        ?>
    </header>
    <main role="main">
        <section id="explorer" class="section-container reset cms-ui">
            <?php include('explorer.php');?>
            <?php include('footer.php'); ?>
        </section><!--
        --><section class="app section-container scroller">
            <?php
                if($query != null){
                    include($mode.'.php');
                }
                elseif(isset($newsthumbs)){
                    include('explorer-grid.php');
                }
                else{
                    include('empty.php');
                }
            ?>
        </section>
    </main>
</body>
</html>