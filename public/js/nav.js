var w = $(window).width(),
    toggle 		= $('#toggle-menu'),
    menu 		= $('.blog-nav nav ul'),
    hasChild = $('.has-child'),
    dropdown = $('.dropdown');

$(function() {
    $(toggle).on('click', function(e) {
        e.preventDefault();
        menu.toggle();
    });

    $(hasChild).click(function(e) {
        e.preventDefault();
        dropdown.toggle();
    });
});

$(window).resize(function(){
    if(w > 320 && menu.is(':hidden')) {
        menu.removeAttr('style');}
});