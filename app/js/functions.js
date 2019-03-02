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
// Format date & title
    const format_date = date => date.replace(/-/g, '');

    const format_title = title =>
        // trim spaces, replace spaces by -, replace specials chars (é -> e), remove others specials chars, Upper Case Each Word
        title.trim()
            .replace(/ +/g, '-')
            .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
            .replace(/[^a-zA-Z0-9-_]/g, '')
            .replace(/\b[a-z]/g, (title_up) => title_up.toUpperCase());

// Format Newsletter Content
    /* Convert editable html of newsletter to final published html */
    const newsletter_generate = content => {
        content.find('tr')
            .removeClass('newsletter-builder-row draggable removable')
            .removeAttr('title data-id data-type data-name');
        content.find('.editable').contents().unwrap();
        content.find('a.disabled').removeClass('disabled');
        content.find('tr[class=""], a[class=""]').removeAttr('class');
        content.find('.newsletter-builder-ui .newsletter-editor-ui').remove();
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

const move_element = (from, to) => {
  let elem = from.clone();
  to.append(elem);
  from.remove();
};