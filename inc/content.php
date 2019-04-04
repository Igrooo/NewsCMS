<!DOCTYPE HTML>
<html lang="<?php echo LANG ?>">
<?php
include('head.php');
?>
<body class="mode-<?php echo $mode; echo $template ? ' template':'';?>">
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
                if($query != null){
                    include("$mode.php");
                }
                elseif(isset($conf)){
                    include ("conf-$conf.php");
                }
                else{
                    include('explorer-grid.php');
                }
            ?>
            </div>
        </section>
    </main>
</body>
</html>