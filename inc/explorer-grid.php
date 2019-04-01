<div id="explorer-grid" class="grid reset cms-ui">
    <?php
    if(!isset($newsthumbs)){
        $year = CURRENT_YEAR;
        include ('empty.php');
    }
    ?>
    <h4 class="year open list-title"><?php echo $year; ?></h4>
    <?php
        list_news('grid',$year, $name, $date);
    ?>
</div>