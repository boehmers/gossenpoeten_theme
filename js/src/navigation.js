/**
 * Created by Manuel on 06.04.2017.
 */
( function( $ ) {
    var selector = $(".menu-item-has-children>a");

    $(window).resize(function(){
        //get the window width
        var winWidth =  $(window).width();

        //set the maxWidth
        var maxWidth = 768;

        //if the window width is less than maxWidth pixels
        if(winWidth < maxWidth){//begin if then
            selector.addClass("dropdown-toggle");
            selector.attr('data-toggle', 'dropdown');
            selector.removeClass("dropdown");
        }
        else{
            selector.removeClass("dropdown-toggle");
            selector.attr('data-toggle', '');
            selector.addClass("dropdown");
        }//end if then else
    });//end window resize event

    $(document).ready(function() {
        //get the window width
        var winWidth =  $(window).width();

        //set the maxWidth
        var maxWidth = 768;

        //if the window width is less than maxWidth pixels
        if(winWidth < maxWidth){//begin if then
            selector.addClass("dropdown-toggle");
            selector.attr('data-toggle', 'dropdown');
            selector.removeClass("dropdown");
        }
        else{
            selector.removeClass("dropdown-toggle");
            selector.attr('data-toggle', '');
            selector.addClass("dropdown");
        }//end if then else
    });
} )( jQuery );