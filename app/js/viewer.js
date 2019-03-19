//////////////////////////
////// Viewer script /////
//////////////////////////
$(() => {
    "use strict";
    $('#toggle-mobile').click( function (){
        $(this).addClass('hidden');
        $('#toggle-desktop').removeClass('hidden');
        $('#viewer').addClass('responsive-view');
    });
    $('#toggle-desktop').click( function (){
        $(this).addClass('hidden');
        $('#toggle-mobile').removeClass('hidden');
        $('#viewer').removeClass('responsive-view');
    });

});