<div class="header" role="banner" xmlns="http://www.w3.org/1999/html">
    <a id="logo" href=".">
        <h1 id="title"><?php echo APP_ICON.'<span class="name-app">'.APP_NAME ?></span></h1>
        <h2 id="subtitle">
            <img  class="company-logo" src="<?php echo COMPANY_LOGO ?>" alt="<?php COMPANY_NAME ?>">
            <span class="company-name"><?php echo COMPANY_NAME ?></span>
        </h2>
    </a><!--
    --><h3 id="apptitle">
        <?php if(isset($query)){echo'
        <div id="subapptitle" class="header-info">'.$last_edited.'</div>
        ';}
        echo CONTEXT_TITLE ?>
    </h3>
</div>