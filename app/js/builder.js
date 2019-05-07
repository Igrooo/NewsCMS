//////////////////////////
///// Builder script /////
//////////////////////////
$(() => {
    "use strict";

    //const container     = $('.app.scroller')[0];

    const builder_type  = $('#builder').attr('data-builder-type');

    // Builder elements
    const builder_btn   = $('.components-list .builder-nav-aside-btn');
    const builder_body  = $('#newsletter-builder #fakebody');
    const builder_table = builder_body.find('table .ui-sortable');
    const builder_row   = '.newsletter-builder-row';
    const builder_cpts  = $('#newsletter-builder-components');
    // Random placeholders for empty imgs
    const empty_img     = 'img[src="[src]"]';
    const placeholder   = $('#placeholder-location');
    const placeholder_location = placeholder.text();
    const max = placeholder.attr('data-num');

    const builder_placeholder = '<tr class="ui-highlight"><td><i class="icon icon-box colored fas fa-3x fa-plus-circle"></i></td></tr>';

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

    const ipt_name     = $('#input-name');


    let ipt_name_formated, ipt_id, ipt_date, ipt_prefix, ipts, builder_ipt, builder_gen, ipt_template;

    if (builder_type === 'template') {
        ipt_id = $('#template-id');
        ipts = ipt_name;
        ipt_name_formated = $('#template-name');
        builder_ipt = $('#template-components');
    }
    else{
        ipt_template = $('#input-template');
        ipt_date   = $('#input-date');
        ipt_prefix = $('#input-prefix');
        ipts = ipt_date.add(ipt_name);
        ipt_name_formated = $('#newsletter-name');
        builder_ipt   = $('#newsletter-content-editable');
        builder_gen   = $('#newsletter-content-generated');
    }

    const set_img_placeholder = (cpt) => {
        cpt.find(empty_img).each(function(){
            rand_img_placeholder($(this), placeholder_location, max);
        });
    };

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
        if (builder_type === 'template'){
            let id = ipt_id.attr('data-id');
            if (title === ''){
                header_title.removeClass('with-file-name');
                header_file.text('');
            }
            else {
                header_title.addClass('with-file-name');
                header_file.text(id +' - '+ title);
            }
        }
        else{
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

    const get_list = () => {
        let builder_rows = builder_table.find(builder_row);
        let list = '0';
        let i = 0;
        if(builder_rows.length !== 0){
            builder_rows.each(function() {
                let id = $(this).attr('data-id');
                if(i>0){list = list + ',' + id;}
                else{list = id;}
                i++;
            });

        }
        return list;
    };

    // Update form hidden input
    const update_ipt = () => {
        if (builder_type === 'template') {
            let list_cpts = get_list();
            builder_ipt.val(list_cpts);
        }
        else{
            if (builder_table.is(':empty')) {
                builder_ipt.val('');
                builder_gen.val('');
            } else {
                let content = builder_table.html();
                let newsletter = builder_table.clone();
                let generated = newsletter_generate(newsletter);
                builder_ipt.val(content);
                builder_gen.val(generated);
            }
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

    ///// Components Functions /////
    const add_cpt = id =>{
        let cpt = builder_cpts.find(builder_row+'[data-id='+id+']').clone();
        builder_table.append(cpt);
        set_img_placeholder(cpt);
        disable_links(cpt);
        update_ipt();
    };
    const get_cpts = (list_cpts) => {
        let components = list_cpts.split(',');
        components.forEach((item) => {
            add_cpt(item);
        });
    };

    const update_cpts = () => {
        let list_cpts = ipt_template.find('option:selected').attr('data-value');
        console.log(list_cpts);
        // Empty builder
        builder_table.html('');
        get_cpts(list_cpts);
    };

    /////////////////////////////

    ///// Form Builder Events /////

    // Update header and form buttons when date & title input
    ipts.on('input',() => {
        update_header();
        update_btns();
    });

    // Update form buttons when builder change
    builder_ipt.change(() => update_btns());

    if (builder_type !== 'template') {
        ipt_template.change(() => {
            update_cpts();
        });
    }

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

    builder_btn.hover( () => {
        builder_table.append(builder_placeholder);
           //scroll_bottom($(container));
        }, () => {
        $(builder_table.find('.ui-highlight:last')).remove();
        });

    // Add newsletter components
    builder_btn.click(function () {
        $(builder_table.find('.ui-highlight')).remove();
        let id 	= $(this).attr('data-id');
        add_cpt(id);
        update_btns_builder();
        builder_table.append(builder_placeholder);
        //scroll_bottom($(container));
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

    if (builder_type === 'template') {
        let list_cpts = builder_ipt.val();
        get_cpts(list_cpts);
    }
    else if (builder_type === 'tiny') {
        // update components on load for tiny builder in speed bar of home page
        // not in builder page for not remove previously edited content
        update_cpts();
    }
    else{
        // Init Builder
        // Get previous newsletter components from form input value and set in builder
        let newsletter_prev_content = builder_ipt.val().toString();
        builder_table.html(newsletter_prev_content);
    }
    update_btns_builder();
    disable_links(builder_table);
});