var fadein_tween = TweenMax.to('#about-fade> div', .375,{ opacity: 1 });


var controller = new ScrollMagic.Controller();

var fadein_scene = new ScrollMagic.Scene({
  triggerElement: '#about-fade',
  reverse: true
})
.setTween(fadein_tween)
.addTo(controller);



var servicio1_scene = new ScrollMagic.Scene({
    triggerElement: '#servicio1-div',
    reverse: true
  })
  .on("enter", function (event) {
    $( "#servicio1-text" ).removeClass( "fadeOutRight");
    $( "#servicio1-text" ).addClass( "fadeInRight");
  })
  .on("leave", function (event) {
    $( "#servicio1-text" ).removeClass( "fadeInRight");
    $( "#servicio1-text" ).addClass( "fadeOutRight");
  })
  .addTo(controller);

  var servicio2_scene = new ScrollMagic.Scene({
    triggerElement: '#servicio2-div',
    reverse: true
  })
  .on("enter", function (event) {
    $( "#servicio2-text" ).removeClass( "fadeOutDown");
    $( "#servicio2-text" ).addClass( "fadeInUp");
  })
  .on("leave", function (event) {
    $( "#servicio2-text" ).removeClass( "fadeInUp");
    $( "#servicio2-text" ).addClass( "fadeOutDown");
  })
  .addTo(controller);

  var servicio3_scene = new ScrollMagic.Scene({
    triggerElement: '#servicio3-div',
    reverse: true
  })
  .on("enter", function (event) {
    $( "#servicio3-text" ).removeClass( "fadeOutUp");
    $( "#servicio3-text" ).addClass( "fadeInDown");
  })
  .on("leave", function (event) {
    $( "#servicio3-text" ).removeClass( "fadeInDown");
    $( "#servicio3-text" ).addClass( "fadeOutUp");
  })
  .addTo(controller);


  var  seguir_scene = new ScrollMagic.Scene({
    triggerElement: '#signup',
    reverse: true
  })
  .on("enter", function (event) {
    $( "#seguir-div" ).removeClass( "zoomOut");
    $( "#seguir-div" ).addClass( "zoomIn");
  })
  .on("leave", function (event) {
    $( "#seguir-div" ).removeClass( "zoomIn");
    $( "#seguir-div" ).addClass( "zoomOut");
  })
  .addTo(controller);


  var  contacto_scene = new ScrollMagic.Scene({
    triggerElement: '#contacto-div',
    reverse: true
  })
  .on("enter", function (event) {
    $( ".contacto-card" ).addClass( "pulse");
  })
  .on("leave", function (event) {
    $( ".contacto-card" ).removeClass( "pulse");
  })
  .addTo(controller);