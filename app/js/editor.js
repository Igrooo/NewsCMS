//////////////////////////
///// Editor script //////
//////////////////////////
"use strict";

/// Init TinyMCE ///
tinymce.init({
    selector: '.editable',
    inline: true,
    hidden_input:false,
    language: 'fr_FR',
    browser_spellcheck: true,
    contextmenu: false,
    forced_root_block : false,
    menubar: false,
    toolbar_items_size : 'small',
    plugins : 'hr link',
    toolbar: [
        'undo redo | fontselect fontsizeselect | forecolor backcolor | bold italic underline strikethrough',
        ' alignleft aligncenter alignright alignjustify | hr | link unlink openlink | removeformat | nonbreaking | anchor'
        ],
    default_link_target: '_blank',
    link_assume_external_targets: true,
    link_context_toolbar: true,
    init_instance_callback : (editor) => {
        console.log('Editor ' + editor.id + ' is now initialized.');
    },
    setup: (editor) => {
        editor.on('click', () => {
            console.log('Editor was clicked');
            $(() => {
                let toolsbar = '';
                let target = '';
                move_element(toolsbar,target);

            });
        });
    }
});
///

$(() => {
    // Editor elements
    const editor_body  = $('#newsletter-editor #fakebody');
    const editor_table = editor_body.find('table:first-child');
    const editor_cel = $(".editable");
    //Herited builder elements
    const builder_row   = '.newsletter-builder-row';
    const builder_rows = editor_table.find(builder_row);

    // Form elements in nav button
    const btn_reset  = $('#editor-reset');
    const btn_submit = $('#editor-submit');

    // Form inputs elements
    const all_ipt_user = $('.ipt[required]:not([disabled]):not([readonly])');
    const all_ipt_hide = $('.ipt-hidden:not([disabled]):not([readonly])');
    const all_ipt      = all_ipt_user.add(all_ipt_hide);

    /////////////////////////////

    const start_edit = id => {

    };
    const stop_edit = id => {

    };

    // Init Editor

    disable_links(editor_table);

    editor_cel.each(function(id){
        $(this).attr('id', 'cpt-'+id);
        $(this).attr('contenteditable','');
        $(this).attr('title','Cliquez pour éditer')
        let name = $(this).parents(builder_row).attr('data-name');
        $(this).addClass('editable-'+name)
    });
    builder_rows.each(function(){
        $(this).removeAttr('title');
    });

    // Editors Events
    editor_cel.focusin(function() {
        let id = $(this).attr('id');
        start_edit(id);
    });
    editor_cel.focusout( function() {
        let id = $(this).attr('id');
        stop_edit(id);
    });

});