//////////////////////////
///// Editor script //////
//////////////////////////
"use strict";

$(() => {
    const body = $('body');

    const editor_info  = $('.newsletter-editor-title');
    // Editor elements
    const editor_box   = $('#newsletter-editor');
    const editor_body  = editor_box.find('#fakebody');
    const editor_table = editor_body.find('table > tbody');
    const editor_row   = '.newsletter-editor-row';
    const editor_rows  = editor_table.find(editor_row);

    // editable content
    const edit_text      = '.editable';
    const edit_img       = '.editable-img';
    const edit_btn       = '.editable-btn'; // for orphan button
    const linked_btn     = '.linked-btn.btn-';  // for button linked to an image (with id)
    const editor_cel     = $(edit_text);
    const editor_cel_img = $(edit_img);
    const editor_cel_btn = $(edit_btn);

    const img_without_link = '.without-link';

    // Form elements in nav button
    const btn_reset  = $('#editor-reset');
    const btn_submit = $('#editor-submit');

    // Form hidden inputs elements
    const editor_ipt    = $('#newsletter-content-editable');
    const editor_gen    = $('#newsletter-content-generated');
    const editor_backup = $('#newsletter-content-editable-backup');

    // const all_ipt_user = $('.ipt[required]:not([disabled]):not([readonly])');
    // const all_ipt_hide = $('.ipt-hidden:not([disabled]):not([readonly])');
    // const all_ipt      = all_ipt_user.add(all_ipt_hide);

    // Useful data
    const tracking_start = $('#newsletter-tracking-start').text();
    const tracking_end   = $('#newsletter-tracking-end').text();
    const image_url      = $('#newsletter-img-url').text();

    const placeholder    = $('#newsletter-img-url-placeholder');
    const image_url_ph   = placeholder.text();
    const image_ph_max   = placeholder.attr('data-num');

    const img_without_ph  = 'img:not([src^="'+image_url_ph+'"])';
    //const img_with_title  = 'img:not([alt="[title]"]):not([alt="[pdt-title]"])';
    const link_with_href  = 'a:not([href^="#[url]"])';
    const link_with_title = 'a:not([title="[title]"]):not([title="[pdt-title]"]):not([title="[btn-title]"])';

    // Toolbar editor for img & button
    const edit_toolbar = $('#editor-nav-tools');
    const edit_toolbar_img = edit_toolbar.children('#editable-img-toolbar');
    const edit_toolbar_ipt_img_src  = $('#editable-img-src');
    const edit_toolbar_ipt_img_link = $('#editable-img-link');
    const edit_toolbar_img_link     = $('#link-img-with-tracking');
    const edit_toolbar_ipt_img_alt  = $('#editable-img-alt');

    const edit_toolbar_btn = edit_toolbar.children('#editable-btn-toolbar');
    const edit_toolbar_ipt_btn_link  = $('#editable-btn-link');
    const edit_toolbar_ipt_btn_title = $('#editable-btn-title');
    const edit_toolbar_btn_link      = $('#link-btn-with-tracking');
    /////////////////////////////

    ///// Editor functions /////

    //init elements
    const init_editor = () => {
        editor_cel.each(function(id){
            let name = $(this).parents(editor_row).attr('data-name');
            $(this).attr('id', 'cpt-editable-'+id)
                   .attr('contenteditable','')
                   .attr('title','Cliquez pour éditer')
                   .addClass('editable-'+name);
        });
        editor_cel_img.each(function(id){
            let name = $(this).parents(editor_row).attr('data-name');
            $(this).attr('id', 'cpt-editable-img-'+id)
                   .attr('data-img-id', id)
                   .attr('title',"Cliquez pour modifier l'image et son lien")
                   .addClass('editable-img-'+name);
            update_img(id);
        });
        editor_cel_btn.each(function(id){
            let name = $(this).parents(editor_row).attr('data-name');
            $(this).attr('id', 'cpt-editable-btn-'+id)
                   .attr('data-btn-id', id)
                   .attr('title',"Cliquez pour modifier le texte et le lien du bouton")
                   .addClass('editable-btn-'+name);
        });
        editor_rows.each(function(){
            $(this).removeAttr('title');
        });
    };
    //reset elements
    const reset_editor = () => {
        editor_cel.each(function(){
            let name = $(this).parents(editor_row).attr('data-name');
            $(this).removeAttr('id contenteditable title style data-img-id')
                   .removeClass('editable-'+name+' mce-content-body mce-edit-focus')
                   .children().removeAttr('data-mce-style');
        });
        editor_cel_img.each(function(){
            let name = $(this).parents(editor_row).attr('data-name');
            $(this).removeAttr('id title')
                   .removeClass('editable-img-'+name);
        });
        editor_cel_btn.each(function(){
            let name = $(this).parents(editor_row).attr('data-name');
            $(this).removeAttr('id title')
                   .removeClass('editable-btn-'+name);
        });
        editor_rows.each(function(){
            // Reset for builder
            $(this).attr('title','Maintenez et glissez pour déplacer')
                   .removeClass('active');
        });
    };

    // Update Submit & Reset buttons
    const update_btns = () => {
        /*
        let newsletter_prev_content = editor_backup.val().toString().trim();
        let newsletter_content = editor_ipt.val().toString().trim();
        // When the backup and current content are the same, disabled btn reset and submit
        if (newsletter_prev_content === newsletter_content){
            //console.log('backup and current content are the same, disabled btns reset and submit');
            disabled_btn(btn_reset);
            disabled_btn(btn_submit);
        }
        else{
            //console.log('backup and current content are not the same, enabled btns reset and submit');
            enabled_btn(btn_reset);
            enabled_btn(btn_submit);
        }
        */
        enabled_btn(btn_reset);
        enabled_btn(btn_submit);
        init_editor();
    };
    // Update form hidden input
    const update_ipt = () => {
        reset_editor();
        let content = editor_table.html();
        let newsletter = editor_table.clone();
        let generated = newsletter_generate(newsletter);
        editor_ipt.val(content);
        editor_gen.val(generated);
        // Trigger change event
        editor_ipt.change();
    };

    // Editor toggle
    const edit_on = focused => {
        body.addClass('edit-active');
        $(focused).parents(editor_row).addClass('active');
        editor_info.remove();
    };
    const edit_off = unfocused => {
        body.removeClass('edit-active');
        $(unfocused).parents(editor_row).removeClass('active');
        update_ipt();
    };

    // Image  toolbar editor toggle
    const show_bar_img = id => {
        edit_toolbar_img.attr('data-img-id', id)
                        .removeClass('hidden');
        edit_toolbar.removeClass('hidden');
        edit_toolbar_ipt_img_link.focus();
    };
    const show_bar_img_wl = id => {
        edit_toolbar_img.attr('data-img-id', id)
            .removeClass('hidden')
            .addClass('without-link');
        edit_toolbar.removeClass('hidden');
        edit_toolbar_ipt_img_alt.focus();
    };
    const hide_bar_img = () => {
        edit_toolbar_img.removeAttr('data-img-id')
                        .addClass('hidden')
                        .removeClass('without-link');
        edit_toolbar.addClass('hidden');
    };
    // Button toolbar editor toggle
    const show_bar_btn = id => {
        edit_toolbar_btn.attr('data-btn-id', id)
            .removeClass('hidden');
        edit_toolbar.removeClass('hidden');
        edit_toolbar_ipt_btn_link.focus();
    };
    const hide_bar_btn = () => {
        //console.log('hide bar btn');
        edit_toolbar_btn.removeAttr('data-btn-id')
            .addClass('hidden');
        edit_toolbar.addClass('hidden');
    };
    // Image editor toggle
    const edit_img_on = cpt => {
        let cpt_id = $(cpt).attr('id');
        let id = $(cpt).attr('data-img-id');
        body.addClass('edit-img-active');
        $(cpt).addClass('focused');
        edit_on('#'+cpt_id);
        update_edit_toolbar_ipt_img_src(cpt);
        update_edit_toolbar_ipt_img_title(cpt);
        if($(cpt).hasClass('without-link')){
            show_bar_img_wl(id);
        }
        else{
            show_bar_img(id);
            update_edit_toolbar_ipt_img_link(cpt);
        }
    };
    const edit_img_off = () => {
        body.removeClass('edit-img-active');
        editor_cel_img.removeClass('focused');
        edit_off(edit_img);
        hide_bar_img();
        edit_toolbar_ipt_img_src.val('');
        edit_toolbar_ipt_img_link.val('');
        edit_toolbar_ipt_img_alt.val('');
    };
    // Button editor toggle
    const edit_btn_on = cpt => {
        let cpt_id = $(cpt).attr('id');
        let id = $(cpt).attr('data-btn-id');
        body.addClass('edit-btn-active');
        edit_on('#'+cpt_id);
        show_bar_btn(id);
        update_edit_toolbar_ipt_btn_link(cpt);
        update_edit_toolbar_ipt_btn_title(cpt);
    };
    const edit_btn_off = () => {
        body.removeClass('edit-btn-active');
        edit_off(edit_btn);
        hide_bar_btn();
        edit_toolbar_ipt_btn_link.val('');
        edit_toolbar_ipt_btn_title.val('');
    };
    const update_edit_toolbar_ipt_btn_link = cpt => {
        let url = get_url(cpt);
        edit_toolbar_btn_link.attr('href',url).text(url);
        let val = url_without_tracking(url);
        edit_toolbar_ipt_btn_link.val(val);
    };
    // Image functions
    const load_img = (id,src) => {
        let img = $('#cpt-editable-img-'+id).find('img');
        img.attr('src',src);
        console.log('img'+id+' : loaded');
    };
    const restore_placeholder = id =>{
        let img = $('#cpt-editable-img-'+id).find(img_without_ph)[0];
        if (img !== undefined) {
            rand_img_placeholder($(img), image_url_ph, image_ph_max);
        }
    };
    const get_img = (id,url) => {
        return $.ajax({
            type: 'GET',
            url: url,
            success: () => { load_img(id,url) },
            error: (xhr) => {
                // console.log('img'+id+' : '+xhr.status);
                restore_placeholder(id);
            }
        });
    };
    const update_img = id => {
        let url = image_url+id+'.jpg';
        get_img(id,url);
    };
    const update_img_with_ipt = (id,img) => {
        let url = image_url+img;
        get_img(id,url);
    };
    const get_img_filename = cpt => {
        let img = $(cpt).find(img_without_ph)[0];
        if (img !== undefined){
            let src = $(img).attr('src');
            let index = src.lastIndexOf('/');
            return src.substring(index+1);
        }else{ return ''; }
    };
    const update_edit_toolbar_ipt_img_src = cpt => {
        let img_file = get_img_filename(cpt);
        edit_toolbar_ipt_img_src.val(img_file);
    };
    //URL functions
    const url_with_tracking = (url,sub_tracking) => {
        let separator = '?';
        let anchor = '';
        if (url.indexOf('?') !== -1){
            separator = '&';
        }
        let index = url.indexOf('#');
        if (index !== -1){
            anchor = url.substring(index);
            url = url.substring(0, index);
        }
        return tracking_start+url+separator+tracking_end+sub_tracking+anchor;
    };
    const url_without_tracking = url_full =>{
        let url = url_full.replace(tracking_start,'');
        let end = url.indexOf(tracking_end);
        let anchor = '';
        let index = url.indexOf('#');
        if (index !== -1) {
            anchor = url.substring(index);
        }
        return url.substring(0,end-1)+anchor;
    };
    const get_url = cpt => {
        let link = $(cpt).find(link_with_href)[0];
        if(link !== undefined){
            return $(link).attr('href');
        }else{ return ''; }
    };
    const update_edit_toolbar_ipt_img_link = cpt => {
        let url = get_url(cpt);
        edit_toolbar_img_link.attr('href',url).text(url);
        let val = url_without_tracking(url);
        edit_toolbar_ipt_img_link.val(val);
    };
    const update_url = (id,url) => {
        let link = $('#cpt-editable-img-'+id).find('a');
        let title = link.attr('title');
        let current_url  = link.attr('href');
        let sub_tracking = '_cpt'+id;
        let index = current_url.indexOf('_');
        if (index !== -1){
            sub_tracking = current_url.substring(index);
        }
        else if((title !== '')||(title !== '[pdt-title]')){
            sub_tracking = '_'+format_url(title);
        }
        let url_full = url_with_tracking(url, sub_tracking);
        link.attr('href',url_full);
        edit_toolbar_img_link.attr('href',url_full).text(url_full);
        update_linked_btn_url(id,url_full,'img-');
    };
    const update_url_btn = (id,url) => {
        let link = $('#cpt-editable-btn-'+id).find('a');
        let title = link.attr('title');
        let current_url  = link.attr('href');
        let sub_tracking = '_btn'+id;
        let index = current_url.indexOf('_');
        if (index !== -1){
            sub_tracking = current_url.substring(index);
        }
        else if((title !== '')||(title !== '[btn-title]')){
            sub_tracking = '_'+format_url(title);
        }
        let url_full = url_with_tracking(url, sub_tracking);
        link.attr('href',url_full);
        edit_toolbar_btn_link.attr('href',url_full).text(url_full);
        update_linked_btn_url(id,url_full,'btn-');
    };
    const remove_url = (id) => {
        let link = $('#cpt-editable-img-'+id).find('a');
        edit_toolbar_img_link.attr('href','').text('');
        link.attr('href','');
        update_linked_btn_url(id,'','img-');
    };
    const remove_url_btn = (id) => {
        let link = $('#cpt-editable-btn-'+id).find('a');
        edit_toolbar_btn_link.attr('href','').text('');
        link.attr('href','');
        update_linked_btn_url(id,'','btn-');
    };
    // Title functions
    const get_title = cpt => {
        let link = $(cpt).find(link_with_title)[0];
        if(link !== undefined){
            return $(link).attr('title');
        }else{ return ''; }
    };
    const update_edit_toolbar_ipt_img_title = cpt => {
        let title = get_title(cpt);
        edit_toolbar_ipt_img_alt.val(title);
    };
    const update_edit_toolbar_ipt_btn_title = cpt => {
        let title = get_title(cpt);
        edit_toolbar_ipt_btn_title.val(title);
    };
    // get the button linked to image or an other button
    const get_linked_btn = (id, type) => {
        let cpt = $('#cpt-editable-'+type+id);
        let btn_id = cpt.attr('data-linked-btn-id');
        return cpt.parents(editor_row).find(linked_btn+btn_id+' a');
    };
    // title of button linked to an image or an other button
    const update_linked_btn_title = (id, title, type) => {
        let btn = get_linked_btn(id,type);
        btn.attr('title',title);
    };
    // url of button linked to an image or an other button
    const update_linked_btn_url = (id, url, type) => {
        let btn = get_linked_btn(id,type);
        btn.attr('href',url);
    };
    //update title image
    const update_title = (id, title) => {
        let cpt_img = $('#cpt-editable-img-'+id);
        let img   = cpt_img.find('img');
        let link  = cpt_img.find('a');
        img.attr('alt',title);
        link.attr('title',title);
        update_linked_btn_title(id,title,'img-');
    };
    //update title btn
    const update_title_btn = (id, title) => {
        let cpt_btn = $('#cpt-editable-btn-'+id);
        console.log(id);
        let link  = cpt_btn.find('a');
        cpt_btn.find('.btn-title').text(title);
        link.attr('title',title);
        update_linked_btn_title(id,title,'btn-');
    };

    /// Init TinyMCE for text content///
    const init_edit = selector => {
        console.log('init TinyMCE on '+selector);
        tinymce.init({
            selector: selector,
            inline: true,
            //fixed_edit_toolbar_container: edit_toolbar, //not working
            language: 'fr_FR',
            hidden_input: false,
            contextmenu: false,
            browser_spellcheck: true,
            forced_root_block : false,
            menubar: false,
            plugins: 'hr link nonbreaking charmap emoticons visualchars code',
            toolbar: 'undo redo | fontselect fontsizeselect | forecolor backcolor | bold italic underline strikethrough | subscript superscript | nonbreaking charmap emoticons | hr | link | visualchars | removeformat | code',
            fontsize_formats: '8px 10px 11px 12px 14px 16px 18px 20px 22px 24px 26px 28px 30px 35px 48px',
            default_link_target: '_blank',
            link_assume_external_targets: true,
            link_context_edit_toolbar: true,
            init_instance_callback : () => {
                editor_box.removeClass('loading');
            },
            setup: (editor) => {
                ///// Content Editor Events /////
                editor.on('blur',  () => edit_off('.mce-edit-focus') );
                editor.on('click', () => edit_on('.mce-edit-focus') );
                editor.on('change',() => update_ipt() );
                editor.on('input', () => update_ipt() );
                //editor.on('mouseup', () => left_position(editor_box, edit_toolbar));
            }
        });
    };

    ///// Editor Events /////
    // Update form buttons when editor change
    editor_ipt.change(() => update_btns());
    //Click on editable image
    editor_cel_img.on('click', function() { edit_img_on(this); });
    //Click on editable button
    editor_cel_btn.on('click', function() { edit_btn_on(this); });

    //img src input
    edit_toolbar_ipt_img_src.on('input',function() {
        let id = edit_toolbar_img.attr('data-img-id');
        let img = $(this).val();
        update_img_with_ipt(id,img);
    });
    //img link input
    edit_toolbar_ipt_img_link.on('input',function() {
        let id = edit_toolbar_img.attr('data-img-id');
        let url = $(this).val();
        if(url !== ''){
            update_url(id,url);
        }
        else{
            remove_url(id);
        }
    });
    // img title input
    edit_toolbar_ipt_img_alt.on('input', function () {
        let id = edit_toolbar_img.attr('data-img-id');
        let title = $(this).val();
        update_title(id, title);
    });
    // btn link input
    edit_toolbar_ipt_btn_link.on('input',function() {
        let id = edit_toolbar_btn.attr('data-btn-id');
        let url = $(this).val();
        if(url !== ''){
            update_url_btn(id,url);
        }
        else{
            remove_url_btn(id);
        }
    });
    // btn title input
    edit_toolbar_ipt_btn_title.on('input', function () {
        let id = edit_toolbar_btn.attr('data-btn-id');
        let title = $(this).val();
        update_title_btn(id, title);
    });

    //Click outside btn & image edit_toolbar
    $(document.body).on('mouseup',(e) => {
        if((body.hasClass('edit-img-active') === true )|| (body.hasClass('edit-btn-active') === true )){
            // if the target of the click isn't the container or a descendant of the container
            if (!edit_toolbar.is(e.target) && edit_toolbar.has(e.target).length === 0){ edit_img_off(); edit_btn_off(); }
        }
    });
    // Disable buttons and empty header & builder on click on reset button
    btn_reset.click(() => {
        disabled_btn(btn_reset);
        disabled_btn(btn_submit);
        // Reset content and editor and init
        let newsletter_prev_content = editor_backup.val().toString();
        editor_table.html(newsletter_prev_content);
        disable_links(editor_table);
        // Trigger change event
        editor_ipt.change();
        init_edit(edit_text);
    });

    // Init Editor
    update_btns();
    disable_links(editor_table);
    init_edit(edit_text);
});