$(document).ready(function() {
  function recaptchaCallback() {
    $('#hiddenRecaptcha').valid();
  };

  //Verifica el limite de imagenes a subir
  jQuery.validator.addMethod("totalFiles", function(value, element, param) {
        var totallength = ( element.files.length );
    return this.optional( element ) || totallength <= param;
  });
  jQuery.validator.addMethod("laxEmail", function(value, element) {
    // allow any non-whitespace characters as the host part
    return this.optional( element ) || /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@(?:\S{1,63})$/.test( value );
  }, 'Por favor, ingresa un correo valido');

  // Guarda un registro con subida de archivo
  $('#enviar-registo-archivo').validate({
    //debug: true,
    ignore: ".ignore",
    rules: {
      nombre: {
        required: true,
        minlength: 3
      },
      nick: {
        required: true,
        minlength: 3
      },
      correo: {
        required: true,
        email: true,
        laxEmail: true
      },
      tipo: {
        required: true
      },
      tamaño: {
        required: true
      },
      otro: {
        required: true,
        minlength: 1
      },
      detallado: {
        required: true
      },
      pedido: {
        required: true,
        minlength: 20,
        maxlength: 2000
      },
      "file_upload[]": {
        required: true,
        extension: "png|jpe?g|gif",
        totalFiles: 5
      },
      hiddenRecaptcha: {
        required: function () {
          if (grecaptcha.getResponse() == '') {
              return true;
          } else {
              return false;
          }
        }
      }
    },
    messages: {
      nombre: {
        required: "Por favor, ingresa tu nombre y apellido"
      },
      nick: {
        required: "Por favor, ingresa un nick",
        minlength: "El nick debe tener mas de 3 caracteres"
      },
      correo: {
        required: "Por favor, ingresa un correo",
        email: "Ingresa un correo valido",
        remote: "Este correo ya tiene una comision, solo puedes hacer una comision a la vez"
      },
      tipo: {
        required: "Por favor, elije un tipo de comision"
      },
      tamaño: {
        required: "Por favor, elije un tamaño"
      },
      otro: {
        required: "Por favor, ingresa un tamaño personalizado en centímetros"
      },
      detallado: {
        required: "Por favor, ingresa un tipo de detallado"
      },
      pedido: {
        required: "Por favor, ingresa los detalles de tu comision",
        minlength: "Tu descripcion del pedido es demaciado corta",
        maxlength: "¡Ups! Utilizaste mas de 2000 caracteres"
      },
      "file_upload[]": {
        required: "Por favor, selecciona varias imágenes",
        extension: "Solo puedes subir imagenes .png, .jpeg, .jpg y gif",
        totalFiles: "Solo puedes subir un maximo de 5 imagenes"
      },
      hiddenRecaptcha: {
        required: "Por favor, completa el captcha"
      }
    },
    errorElement: "li",
    errorPlacement: function(error, element) {
        error.appendTo('#messageBox');
        $(error).fadeIn("slow").delay(6000).fadeOut("slow", function() {
          $(error).remove();
        });
    },
    submitHandler : function(form) {

      var datos = new FormData(form);

      $.ajax({
        type: $(form).attr('method'),
        data: datos,
        url: $(form).attr('action'),
        dataType: 'json',
        contentType: false,
        processData: false,
        async: true,
        cache: false,
        success: function(data) {
          console.log(data);
          var resultado = data;
          if (resultado.respuesta == 'Exito') {
            const Toast = Swal.mixin({
              position: 'center',
              showConfirmButton: true,
              customClass: 'alerta',
              onAfterClose: () => {
                $(form).trigger("reset");
                location.reload();
              }
            });

              Toast.fire({
              type: 'success',
              title: 'Se envió tu cotización',
              text: 'Por favor revisa tu correo constantemente para que revises la cotización'
            })
          } else {
            const Toast = Swal.mixin({
              position: 'center',
              showConfirmButton: true,
              customClass: 'alerta'
            });

              Toast.fire({
              type: 'error',
              title: '¡Hubo un error!'
            })
          }
        }
      });

    }
  });

  $('#enviar-registro').validate({
    //debug: true,
    ignore: ".ignore",
    rules: {
      precio: {
        required: true
      },
      direccion: {
        required: true
      },
      pais: {
        required: true
      },
      provincia: {
        required: true
      },
      ciudad: {
        required: true
      },
      codigo_postal: {
        required: true,
        digits: true
      },
      telefono: {
        digits: true
      },
      celular: {
        required: true,
        digits: true
      },
      metodo_pago: {
        required: true
      },
      info_adicional: {
        maxlength: 800
      },
      seguro: {
        required: false
      }
    },
    messages: {
      precio: {
        required: "Por favor, selecciona el precio que te convenga"
      },
      direccion: {
        required: "Por favor, ingresa una direccion"
      },
      pais: {
        required: "Por favor, ingresa un país"
      },
      provincia: {
        required: "Por favor, ingresa un Estado/Provincia o Región"
      },
      ciudad: {
        required: "Por favor, ingresa una ciudad"
      },
      codigo_postal: {
        required: "Por favor, ingresa un código postal",
        digits: "Solo puedes ingresar numeros"
      },
      telefono: {
        digits: "Solo puedes ingresar numeros"
      },
      celular: {
        required: "Por favor, ingresa un numero de celular",
        digits: "Solo puedes ingresar numeros"
      },
      metodo_pago: {
        required: "Por favor, selecciona un metodo de pago"
      },
      info_adicional: {
        maxlength: "¡Ups! Excediste los 800 caracteres"
      }
    },
    errorElement: "li",
    errorPlacement: function(error, element) {
        error.appendTo('#messageBox');
        $(error).fadeIn("slow").delay(6000).fadeOut("slow", function() {
          $(error).remove();
        });
    },
    submitHandler : function(form) {

      var datos = $(form).serializeArray();

      $.ajax({
        type: $(form).attr('method'),
        data: datos,
        url: $(form).attr('action'),
        dataType: 'json',
        success: function(data) {
          console.log(data);
          var resultado = data;
          if (resultado.respuesta == 'Exito') {
            const Toast = Swal.mixin({
              position: 'center',
              showConfirmButton: true,
              customClass: 'alerta',
              onAfterClose: () => {
                window.location.href = 'comisiones.php';
              }
            });

              Toast.fire({
              type: 'success',
              title: 'Confirmaste tu cotización',
              text: 'Por favor revisa tu correo y la lista de pedidos para saber actualizaciones de tu pedido.'
            })
          } else {
            const Toast = Swal.mixin({
              toast: true,
              position: 'center',
              showConfirmButton: false,
              timer: 2000,
              customClass: 'alerta'
            });

              Toast.fire({
              type: 'error',
              title: '¡Hubo un error!'
            })
          }
        }
      });
    }
  });

  // Eliminar un registro con imagen
  $('.borrar-registro-imagen').on('click', function(e) {
    e.preventDefault();

    var id = $(this).data('id');
    var tipo = $(this).data('tipo');
    var img = $(this).data('img');

    Swal.fire({
      title: '¿Cacelar Comision?',
      text: "¡Esta acción no se puede revertir!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, Cancelar',
      cancelButtonText: 'No',
      customClass: 'alerta'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          type: 'post',
          data: {
            'id': id,
            'img': img,
            'registro' : 'eliminar'
          },
          url: tipo+'.php',
          success:function(data) {
            var resultado = JSON.parse(data);
            if (resultado.respuesta == 'Exito') {
              Swal.fire({
                title: '¡Cancelada!',
                text: 'Su comision a sido cancelada y eliminada.',
                type: 'success',
                customClass: 'alerta',
                onAfterClose: () => {
                  window.location.href = 'comisiones.php';
                }
              });
            }
          }
        })
       }
    });
  });
});
