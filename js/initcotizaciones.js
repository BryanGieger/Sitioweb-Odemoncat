$(document).ready(function() {
  $('.button-collapse').sideNav();

  $('select').material_select();

  $('#tipo').change(function() {
    $("#tipo option:selected").each(function() {
      var tamaño = $('#tamaño');
      var detallado = $('#detallado');
      var parentEsp = $('.otro-cont');
      $(detallado).prop('disabled', 'disabled');
      $(detallado).prop('selectedIndex',0);
      $(detallado).addClass("ignore");
      $(tamaño).prop('disabled', 'disabled');
      $(tamaño).prop('selectedIndex',0);
      $(tamaño).addClass("ignore");
      $(parentEsp).hide();
      var activate = $(this).attr("data-div");

      if (activate == "ambos") {
        $(tamaño).prop('disabled', false);
        $(tamaño).removeClass("ignore");
        $(detallado).prop('disabled', false);
        $(detallado).removeClass("ignore");
      }
      else {
        $(tamaño).prop('disabled', false);
        $(tamaño).removeClass("ignore");
      }
    });

    $("#tipo .no-trigger:selected").each(function() {
      var tamaño = $('#tamaño');
      var detallado = $('#detallado');
      var parentEsp = $('.otro-cont');
      $(detallado).prop('disabled', 'disabled');
      $(detallado).addClass("ignore");
      $(tamaño).prop('disabled', 'disabled');
      $(tamaño).addClass("ignore");
      $(parentEsp).hide();
    });
  });

  $('#tamaño').change(function() {
    $("#tamaño option:selected").each(function() {
      var id = $(this).attr("id");
      var input = $('#otro-tamaño');
      var parent = $('.otro-cont');
      $(parent).hide();
      $(input).addClass("ignore");

      if (id == "otro") {
        $(parent).show();
        $(input).removeClass("ignore");
      }
    });
  });

  $('.form-trigger').click(function(event) {
    event.preventDefault();

    var cards = $(".form-card");
    var botones = $(".form-trigger");
    var thisBoton = $(this);
    var cardID = $(this).attr("href");

    if (thisBoton.hasClass("close")) {
      cards.hide();
      botones.removeClass("active");
    } else {
      cards.hide();
      botones.removeClass("active");
      thisBoton.addClass("active");
      $(cardID).fadeIn(800);
    }
  });

  $('.ejemplo-trigger').click(function() {
    var ejemplos = $(".ejemplo-panel");
    ejemplos.hide();
    var triggers = $(".ejemplo-trigger");
    triggers.removeClass("active");
    var thisTrigger = $(this);
    thisTrigger.addClass("active");
    var ejemploID = $(this).data("trigger");
    $(ejemploID).fadeIn(400);
  });

  $('#example').DataTable({
    //"order": [[ 0, "desc"]],
    responsive: true,
    "dom": 'rt<"bottom"iflp><"clear">',
    "language": {
      "sProcessing":     "Procesando...",
      "sLengthMenu":     "Mostrar _MENU_ registros",
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":     "Ningún dato disponible en esta tabla",
      "sInfo":           "Mostrando del _START_ al _END_ de _TOTAL_ registros",
      "sInfoEmpty":      "Mostrando 0 registros",
      "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix":    "",
      "sSearch":         "<i class='material-icons'>search</i>",
      "sUrl":            "",
      "sInfoThousands":  ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
      },
      "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
    }
  });
  $('.dataTables_filter label input').attr("placeholder", "Busca tu pedido");
  $('.dataTables_filter label input').focus(function() {
    $('.dataTables_filter label i').addClass("focus");
  });
  $('.dataTables_filter label input').focusout(function() {
    $('.dataTables_filter label i').removeClass("focus");
  });
  $('li.tab a.t4').click(function() {
    var button = $('.dataTables_paginate .paginate_button.next');
    var contador = $('.dataTables_paginate .paginate_button').length;
    if (contador < 4) {
      button.parent().css({
        'display':'none'
      })
    }
  });
});
