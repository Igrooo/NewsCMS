<?php
    $ID = get_id($name,$format_date);
    $generated = get_content('generated',$name,$format_date);
?>
<form id="form-editor" method="post">
    <input class="ipt-hidden" id="newsletter-id"   type="text" name="id"   value="<?php echo $ID?>" title="id" hidden readonly>
    <input class="ipt-hidden" id="newsletter-date" type="date" name="date" value="<?php echo $date?>" hidden readonly>
    <input class="ipt-hidden" id="newsletter-name" type="text" name="name" value="<?php echo $name?>" hidden readonly>
    <textarea wrap="off" class="ipt-hidden" id="newsletter-content-editable-backup" name="content-editable-backup" title="content-editable-backup" hidden readonly>
        <?php echo $content; ?>
    </textarea>
    <textarea wrap="off" class="ipt-hidden" id="newsletter-content-editable"  name="content-editable"  title="content-editable"  hidden>
        <?php echo $content; ?>
    </textarea>
    <textarea wrap="off" class="ipt-hidden" id="newsletter-content-generated" name="content-generated" title="content-generated" hidden>
        <?php echo $generated; ?>
    </textarea>
</form>
<span id="newsletter-tracking-start" class="hidden"><?php echo $tracking_start; ?></span>
<span id="newsletter-tracking-end" class="hidden"><?php echo $tracking_end; ?></span>
<span id="newsletter-img-url" class="hidden"><?php echo $img_url; ?></span>
<span id="newsletter-img-url-placeholder" data-num="<?php echo PLACEHOLDER_NUM; ?>" class="hidden"><?php echo CURRENT_DIR.FOLDER_PLACEHOLDER; ?></span>
