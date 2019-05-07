<div id="explorer-grid" class="grid reset cms-ui">
    <h4 class="year open list-title"><?php echo $year; ?></h4>
    <?php
        list_news('grid',$year, $name, $date);
    ?>
</div>