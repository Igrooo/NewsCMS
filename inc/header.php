<div class="header" role="banner">
    <a id="logo" href=".">
        <h1 id="title"><?php echo ICON_APP.NAME_APP ?></h1>
        <h2 id="subtitle">
            <img  class="logo-company" src="<?php echo FOLDER_IMG?>logo.png" alt="<?php NAME_COMPANY ?>">
            <span class="name-company"><?php echo NAME_COMPANY ?></span>
        </h2>
    </a><!--
    --><h3 id="apptitle">
        <?php if(isset($query)){echo'
        <div id="subapptitle" class="header-info"><a href="?y=2019&d=2019-02-24&q=NL_DEMO2" title="Dernière modification"><i class="fas fa-history"></i> XXXXXXXX_NL_xxxxxxx</a> <span class="last">à <span class="last-time">XX:XX</span> par <span class="last-user">User</span></span></div>
        ';}
        echo CONTEXT_TITLE ?>
    </h3>
</div>
