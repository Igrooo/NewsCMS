//////////////////////////
///// Builder script /////
//////////////////////////
$(() => {
    "use strict";

    // Builder elements
    const builder_btn   = $('.components-list .builder-nav-aside-btn');
    const builder_body  = $('#newsletter-builder #fakebody');
    const builder_table = builder_body.find('table .ui-sortable');
    const builder_row   = '.newsletter-builder-row';
    const builder_cpts  = $('#newsletter-builder-components');
    const builder_ipt   = $('#newsletter-content-editable');
    const builder_gen   = $('#newsletter-content-generated');

    // Header elements
    const header_title = $('#apptitle .page-title');
    const header_file  = $('#apptitle .file-name');

    // Form elements in nav button
    const btn_reset  = $('#builder-reset');
    const btn_submit = $('#builder-submit');

    // Form inputs elements
    const all_ipt_user = $('.ipt[required]:not([disabled]):not([readonly])');
    const all_ipt_hide = $('.ipt-hidden:not([disabled]):not([readonly])');
    const all_ipt      = all_ipt_user.add(all_ipt_hide);
    const ipt_date     = $('#input-date');
    const ipt_prefix   = $('#input-prefix');
    const ipt_name     = $('#input-name');
    const ipt_name_formated = $('#newsletter-name');


    ///// Header & Form Builder functions /////
    const update_title = () => {
        let title = ipt_name.val();
        if(title === ''){
           ipt_name_formated.val('');
        }
        else{
           ipt_name_formated.val(format_title(title));
        }
        return ipt_name_formated.val();
    };
    const update_header = () => {
        let title  = update_title();
        let date   = ipt_date.val();
        let prefix = ipt_prefix.val();
        if ((date === '') || (title === '')){
            header_title.removeClass('with-file-name');
            header_file.text('');
        }
        else{
            header_title.addClass('with-file-name');
            header_file.text(format_date(date)+'_'+prefix+title+'.html');
        }
    };
    const update_btns = () => {
        let all_ipt_empty = [];
        all_ipt.each(function(){
            if( $(this).val() === ''){
                all_ipt_empty.push('empty');
            }
        });
        if (all_ipt_empty.length === 0){
            // Array is empty when all inputs have value
            enabled_btn(btn_reset);
            enabled_btn(btn_submit);
        }
        else{
            enabled_btn(btn_reset);
            disabled_btn(btn_submit);
            if(all_ipt.length === all_ipt_empty.length){
                // If all inputs are empty
               disabled_btn(btn_reset);
            }
        }
        all_ipt_empty = [];
    };
    /////////////////////////////

    ///// Builder functions /////

    // Update form hidden input
    const update_ipt = () => {
        if(builder_table.is(':empty')){
            builder_ipt.val('');
            builder_gen.val('');
        }
        else{
            let content = builder_table.html();
            let newsletter = builder_table.clone();
            let generated = newsletter_generate(newsletter);
            builder_ipt.val(content);
            builder_gen.val(generated);
        }
        // Trigger change event
        builder_ipt.change();
    };

    // Update builder buttons
    const update_btns_builder = () => {
        builder_btn.each(function(){
            let btn = $(this);
            let id 	= btn.attr('data-id');
            let builder_rows = builder_table.find(builder_row);
            if(builder_rows.length !== 0){
                builder_rows.each(function() {
                    let id_row = $(this).attr('data-id');
                    if(id === id_row){
                        btn.addClass('added');
                        return false;
                    }
                    else{
                        btn.removeClass('added');
                    }
                });
            }
            else{
                btn.removeClass('added');
            }
        });
    };
    /////////////////////////////

    ///// Form Builder Events /////

    // Update header and form buttons when date & title input
    ipt_date.add(ipt_name).on('input',() => {
        update_header();
        update_btns();
    });

    // Update form buttons when builder change
    builder_ipt.change(() => update_btns());

    // Disable buttons and empty header & builder on click on reset button
    btn_reset.click(() => {
        disabled_btn(btn_reset);
        disabled_btn(btn_submit);
        header_title.removeClass('with-file-name');
        header_file.text('');
        // Empty builder
        builder_table.html('');
        // Update builder buttons
        builder_btn.removeClass('added');
    });


    ///// Builder Events /////

    // Add newsletter components
    builder_btn.click(function () {
        let id 	= $(this).attr('data-id');
        let cpt = builder_cpts.find(builder_row+'[data-id='+id+']').clone();
        builder_table.append(cpt);
        disable_links(cpt);
        update_ipt();
        update_btns_builder();
    });

    // Remove row
    builder_table.on('click','.btn-remove',function(){
        let row = $(this).parents(builder_row);
        row.remove();
        update_ipt();
        update_btns_builder();
    });

    // Drag & Drop
    builder_table.sortable({
        axis: 'y',
        placeholder: 'ui-highlight',
        forcePlaceholderSize: true,
        start: (event, ui) =>
            ui.item.toggleClass('dragged'),
        stop: (event, ui) => {
            ui.item.toggleClass('dragged');
            update_ipt();
        }
    });

    // Init Form Builder
    update_header();
    update_btns();

    // Init Builder
    // Get previous newsletter components from form input value and set in builder
    let newsletter_prev_content = builder_ipt.val().toString();
    builder_table.html(newsletter_prev_content);
    update_btns_builder();
    disable_links(builder_table);
});