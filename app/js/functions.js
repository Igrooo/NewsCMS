/////////////////////////////////
//// Common global functions ////
/////////////////////////////////

"use strict";

///// Form functions /////
// Inputs & btn functions
    const disabled_btn = btn => btn.attr('disabled', 'disabled');
    const enabled_btn = btn => btn.removeAttr('disabled');
//////////////////////////

//// Format functions ////
// Format url, date & title
    const format_url = str =>
        // trim spaces, replace spaces by -, replace specials chars (é -> e), remove others specials chars,
         str.trim()
            .replace(/ +/g, '-')
            .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
            .replace(/[^a-zA-Z0-9-_]/g, '');

    const format_date = date => date.replace(/-/g, '');

    const format_title = title =>
        // same format of url + Upper Case Each Word
        format_url(title).replace(/\b[a-z]/g, (title_up) => title_up.toUpperCase());

// Format Newsletter Content
    /* Convert editable html to final published html */
    const newsletter_generate = content => {
        content.find('tr')
            .removeClass('newsletter-editor-row newsletter-builder-row draggable removable')
            .removeAttr('title data-id data-section data-type data-name style');
        content.find('.editable').contents().unwrap();
        content.find('.editable-img').contents().unwrap();
        content.find('.editable-btn').contents().unwrap();
        content.find('.linked-btn').contents().unwrap();
        content.find('.btn-title').contents().unwrap();
        content.find('a.disabled').removeClass('disabled');
        content.find('a').removeAttr('data-mce-href');
        content.find('span').removeAttr('data-mce-style');
        content.find('tr[class=""], a[class=""]').removeAttr('class');
        content.find('.newsletter-builder-ui, .newsletter-editor-ui').remove();
        return content.html();
    };
//////////////////////////

//////////////////////////
// Disable links in builder and editor
    const disable_links = cpt => {
        let links = cpt.find('a:not(.btn-ui)');
        links.addClass('disabled');
        links.click((e) => e.preventDefault());
    };
//////////////////////////

//////////////////////////
// Random image placeholder in builder and editor
const rand_img_placeholder = (img, ph_folder, max) => {
    let rand_number = Math.floor(Math.random() * max) + 1 ;
    let width = img.attr('width');
    img.attr('src', ph_folder+width+'/'+rand_number+'.png');
    //add ? to force browser to load
    //img.attr('src',ph_folder+width+'/'+rand_number+'.png?'+rand_number);
};
//////////////////////////

//Scroll to bottom
const scroll_bottom = (container) => {
    container.animate({ scrollTop: container.height() }, 1000);
};

// Move element in DOM
/*
    const move_element = (from, to) => {
      let elem = from.clone();
      elem.appendTo(to);
      from.remove();
    };
    */