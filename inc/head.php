<head>
    <meta charset="<?php echo CHARSET ?>">
    <meta name="robots" content="noindex, no follow">
    <meta name="googlebot" content="noindex">
    <title><?php echo TITLE ?></title>
    <link rel="icon" type="image/png" href="<?php echo APP_FAVICON ?>">

    <!-- CSS UI -->
    <!-- icons -->
    <link type="text/css" rel="stylesheet" href="<?php echo FOLDER_CSS ?>fa/all.min.css">
    <!-- global -->
    <link type="text/css" rel="stylesheet" href="<?php echo FOLDER_CSS ?>style.css">
    <!-- <?php echo $mode ?> CSS -->
    <link type="text/css" rel="stylesheet" href="<?php echo FOLDER_CSS.$mode ?>.css">
    <!-- CSS Newsletter -->
    <?php if(isset($query)){include (FOLDER_COMMON.'style.php');} ?>
    <!-- End CSS Newsletter -->

    <!-- jQuery Libraries -->
    <script src="<?php echo FOLDER_JS ?>lib/jquery-3.3.1.min.js"></script>
    <script src="<?php echo FOLDER_JS ?>lib/jquery-ui-1.12.1.min.js"></script>
    <?php
    if($mode == 'editor'){echo'
        <!-- TinyMCE Editor -->
        <script src="'.FOLDER_JS.'lib/tinymce/tinymce.min.js"></script>
        <script src="'.FOLDER_JS.'lib/tinymce/jquery.tinymce.min.js"></script>
    ';}?>
    <!-- End libraries -->
    <!-- Global functions -->
    <script src="<?php echo FOLDER_JS ?>functions.js"></script>
    <!-- Common script -->
    <script src="<?php echo FOLDER_JS ?>script.js"></script>
    <!-- <?php echo $mode ?> script -->
    <script src="<?php echo FOLDER_JS.$mode ?>.js"></script>
</head>
