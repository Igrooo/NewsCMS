$(function() {

    var items_without_thumb = $('.without-thumb');

    function newsthumb(newsletter) {
        html2canvas(newsletter).then(function (canvas) {
            return canvas;
        });
    }
    /* to get iframe content USE : .contents()
    * https://api.jquery.com/contents/#contents
    * */

    items_without_thumb.each(function(){
        var path_thumb = $(this).attr('data-path-thumb');
        $(this).removeAttr('data-path-thumb');
        var iframe = $(this).find('.temp-html');
        var content = iframe.contents().find('body > table').clone();
        console.log(content[0]);
        var icon = $(this).find('.thumb-icon');
        var canvas = newsthumb(content[0]);

        //iframe.remove();
        var image = new Image();
        image.id = "pic";
        image.src = canvas.toDataURL();
        $(this).appendChild(image);
        icon.remove();
    });
});