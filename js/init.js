(function($){
	$(function(){


    // Navbar
    $(".button-collapse").sideNav();
    var categories = $('nav .categories-container');
    if (categories.length) {
      categories.pushpin({ top: categories.offset().top });
      var $links = categories.find('li');
      $links.each(function() {
        var $link = $(this);
        $link.on('click', function() {
          $links.removeClass('active');
          $link.addClass('active');


      
        });
      });
    }

	}); // end of document ready
})(jQuery); // end of jQuery name space