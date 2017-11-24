$(function(){
  $('.flexslider').flexslider({
    controlNav : false,
    nextText : '',
    prevText : '',
    });

});

// Hide mobile menu after clicking on a link
    $('.navbar-collapse a').click(function(){
        $(".navbar-collapse").collapse('hide');
    });
