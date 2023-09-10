(function($) {
  "use strict"; 
  $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: (target.offset().top + 20)
        }, 1000, "easeInOutExpo");
        return false;
      }
    }
  });





  $.attr

  var navbarCollapse = function() {
    var categories = $('#categories');
    if (categories.length) {
      var $links = categories.find('a');
      if ($("#categories").offset().top > 863) {
           $links.each(function() {
             var $link = $(this);
          if($($link.attr('href')).offset().top < $("#categories").offset().top){
            
            $links.parent().removeClass('active');
            $link.parent().addClass('active');
          }
      });
      } else {
        $links.parent().removeClass('active');
        //$('.js-scroll-trigger').parent().removeClass("active");
      }

    }


  };

  navbarCollapse();

  $(window).scroll(navbarCollapse);


})(jQuery); 
