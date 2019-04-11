/////////////////////////////////////
//// Common script for all pages ////
/////////////////////////////////////

$(() => {
    "use strict";

    /*
    $('.scroller').scroll(() => {
        let box_position = $('.box').offset();

        if(box_position.top <= 5){
            $('body').addClass('compact-header');
        }
        else{
            $('body').removeClass('compact-header');
        }
    });
    */

    //Click outside sub-menu header nav to close it
    $(document.body).on('mouseup',(e) => {
        let sub_menu = $('#header .with-sub-nav');
        // if the target of the click isn't the container or a descendant of the container
        if (!sub_menu.is(e.target) && sub_menu.has(e.target).length === 0){
            window.location.hash = '';
        }

    });

});

