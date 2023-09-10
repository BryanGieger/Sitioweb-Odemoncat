<?php
  include_once 'includes/funciones.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Comisiones | Odemoncat</title>

  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
  <link href="css/gallery-dark-materialize.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="css/ocatart.css" rel="stylesheet">
  <link href="css/animate.css" rel="stylesheet">
  <link rel="stylesheet" href="css/iconos.css">
  <link rel="stylesheet" href="css/sidebar.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/fontawesome.min.css" integrity="undefined" crossorigin="anonymous" />
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css" integrity="sha256-2bAj1LMT7CXUYUwuEnqqooPb1W0Sw0uKMsqNH0HwMa4=" crossorigin="anonymous" />
</head>

<body class="background-disc" id="home">
  <nav class="nav-extended nav-comisiones z-depth-0">
    <div class="nav-wrapper container">
      <a href="inicio" class="brand-logo">Odemoncat</a>
      <a href="#" data-activates="nav-mobile" class="button-collapse">
        <i class="material-icons">menu</i>
      </a>
      <ul class="right hide-on-med-and-down">
        <li>
          <a href="https://www.odemoncat.com/">Inicio</a>
        </li>
        <li>
          <a href="portafolio.php">Portafolio</a>
        </li>
        <li class="active">
          <a href="">Comisiones</a>
        </li>
        <!-- <li>
          <a href="docs.html">Servicios</a>
        </li>
        <li>
          <a href="https://shop.ocatart.com/">Tienda</a>
        </li> -->
      </ul>


    </div>

    <div class="nav-header nav-pad valign-wrapper">
      <div class="center div-logo">
        <i class="ocatart-icons logo nav-logo mini"></i>
      </div>
    </div>


  </nav>
  <ul class="side-nav" id="nav-mobile">
    <li>
      <a href="inicio">
        Inicio</a>
    </li>
    <li>
      <a href="portafolio">
        Portafolio</a>
    </li>
    <li class="active">
      <a href="comisiones">
        Comisiones</a>
    </li>
  </ul>


  <!-- Gallery -->
  <div id="portfolio" class="section gray portafolio content-comisiones text-comisiones">
    <div class="container">
      <div class="row">
        <div class="col s12 m9">
          <ul class="tabs tab-comisiones">
            <li class="tab col s12 m3">
              <a class="active" href="#cotizar">Cotizar</a>
            </li>
            <li class="tab col s12 m3">
              <a href="#ejemplos">3D</a>
            </li>
            <li class="tab col s12 m3">
              <a href="#reglas">Reglas</a>
            </li>
            <li class="tab col s12 m3">
              <a class="t4" href="#lista">Pedidos</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col s12 m12 l12">
          <div id="cotizar" class="col s12">
            <div class="col s12 m6 l6">
              <h3>Cotiza o realiza tu pedido</h3>
              <form class="form-cotizar" role="form" name="enviar-registo" id="enviar-registo-archivo" method="post" action="cotizar_comision.php" enctype="multipart/form-data">
                <div class="input-field col s12 input-Default">
                  <input id="nombre" name="nombre" class="input-ocatart" type="text">
                  <label for="nombre">Nombre y Apellido</label>
                  <span class="trigger-info a"><a class="form-trigger active" href="#info-nombre"><i class="material-icons">info</i></a></span>
                </div>
                <div class="row">
                  <div class="input-field col s6 input-Default margin-column">
                    <input id="nick_name" name="nick" class="input-ocatart" type="text">
                    <label for="nick_name" class="input-label">Nick</label>
                    <span class="trigger-info"><a class="form-trigger" href="#info-nick"><i class="material-icons">info</i></a></span>
                  </div>
                  <div class="input-field col s6 input-Default margin-column">
                    <input id="email" name="correo" class="input-ocatart" type="text">
                    <label for="email" class="input-label">Correo</label>
                    <span class="trigger-info"><a class="form-trigger" href="#info-correo"><i class="material-icons">info</i></a></span>
                  </div>
                </div>
                <div class="row relative">
                  <div class="input-field col s11 input-Default margin-column">
                    <select class="browser-default ocatart-select" id="tipo" name="tipo">
                      <option value="" disabled selected>Tipo de pedido</option>
                      <?php
                        try {
                          $sql = "SELECT id_tPedido, nombre_pedido, nombrActivador ";
                          $sql .= " FROM tipos_pedido ";
                          $sql .= " INNER JOIN div_activate ";
                          $sql .= " ON tipos_pedido.data_div=div_activate.id_activate ";
                          $sql .= " ORDER BY id_tPedido ";
                          $resultado = $conn->query($sql);
                        } catch (\Exception $e) {
                          $error = $e->getMessage();
                          echo $error;
                        }

                        while ($tipo_pedido = $resultado->fetch_assoc()) { ?>
                          <?php if ($tipo_pedido['nombrActivador'] == "none"): ?>
                            <option value="<?php echo $tipo_pedido['id_tPedido']; ?>" class="no-trigger"><?php echo $tipo_pedido['nombre_pedido']; ?></option>
                          <?php else: ?>
                            <option value="<?php echo $tipo_pedido['id_tPedido']; ?>" data-div="<?php echo $tipo_pedido['nombrActivador']; ?>"><?php echo $tipo_pedido['nombre_pedido']; ?></option>
                          <?php endif; ?>
                  <?php } ?>
                    </select>
                    <!-- <label for="tipo" class="input-label">Tipo de comision</label> -->
                  </div>
                  <span class="trigger-info"><a class="form-trigger" href="#info-tpedido"><i class="material-icons">info</i></a></span>
                </div>
                <div class="row relative">
                  <div class="input-field col s11 input-Default margin-column">
                    <select class="browser-default ocatart-select" id="tamaño" name="tamaño" disabled>
                      <?php
                        try {
                          $sql = "SELECT * FROM tamano";
                          $respuesta = $conn->query($sql);
                          while ($tamaño = $respuesta->fetch_assoc() ) {
                            if ($tamaño['id_tamano'] == "1") { ?>
                              <option value="<?php echo $tamaño['id_tamano']; ?>" disabled selected><?php echo $tamaño['tamano_nbr']; ?></option>
                     <?php  } else { ?>
                              <option value="<?php echo $tamaño['id_tamano']; ?>" id="<?php echo $tamaño['id_otr']; ?>"><?php echo $tamaño['tamano_nbr']; ?></option>
                     <?php  }
                          }
                        } catch (\Exception $e) {
                          $error = $e->getMessage();
                          echo $error;
                        }

                      ?>
                    </select>
                    <!-- <label for="tipo" class="input-label">Tipo de comision</label> -->
                  </div>
                  <span class="trigger-info"><a class="form-trigger" href="#info-tamaño"><i class="material-icons">info</i></a></span>
                </div>
                <div class="row otro-cont relative" style="display:none;">
                  <div class="input-field col s11 input-Default margin-column">
                    <input id="otro-tamaño" name="otro" class="input-ocatart ignore" type="text">
                    <label for="otro-tamaño" class="input-label">Especificar Tamaño (cm x cm)</label>
                  </div>
                  <span class="trigger-info"><a class="form-trigger" href="#info-esptamaño"><i class="material-icons">info</i></a></span>
                </div>
                <div class="row relative">
                  <div class="input-field col s11 input-Default margin-column">
                    <select class="browser-default ocatart-select" id="detallado" name="detallado" disabled>
                      <?php
                        try {
                          $sql = "SELECT * FROM detallado";
                          $respuesta = $conn->query($sql);
                          while ($detallado = $respuesta->fetch_assoc() ) {
                            if ($detallado['id_detallado'] == "1") { ?>
                              <option value="<?php echo $detallado['id_detallado']; ?>" disabled selected><?php echo $detallado['detallado_txt']; ?></option>
                     <?php  } else { ?>
                              <option value="<?php echo $detallado['id_detallado']; ?>"><?php echo $detallado['detallado_txt']; ?></option>
                     <?php  }
                          }
                        } catch (\Exception $e) {
                          $error = $e->getMessage();
                          echo $error;
                        }

                      ?>
                    </select>
                    <!-- <label for="tipo" class="input-label">Tipo de comision</label> -->
                  </div>
                  <span class="trigger-info"><a class="form-trigger" href="#info-detallado"><i class="material-icons">info</i></a></span>
                </div>
                <div class="row">
                  <div class="input-field col s12 input-Default margin-column">
                    <textarea id="textarea2" name="pedido" class="materialize-textarea input-ocatart" data-length="2000"></textarea>
                    <label for="textarea2" class="input-label">¿Como deseas tu pedido?</label>
                    <span class="trigger-info"><a class="form-trigger" href="#info-pedido"><i class="material-icons">info</i></a></span>
                  </div>
                </div>
                <div class="row">
                  <div class="file-field input-field margin-column" style="padding-right: 3px !important;">
                    <div class="btn background-theme">
                      <span>Buscar</span>
                      <input type="file" name="file_upload[]" multiple>
                    </div>
                    <div class="file-path-wrapper">
                      <input class="file-path input-ocatart ignore" name="file_hidden" type="text" placeholder="Sube hasta 5 imagenes de referencia">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="g-recaptcha" data-sitekey="6LdVw7gUAAAAAFgSwq27-lZXlHyH5xzjdQKyFvcz" data-theme="dark" data-callback="recaptchaCallback"></div>
                  <input type="hidden" class="hiddenRecaptcha required" name="hiddenRecaptcha" id="hiddenRecaptcha">
                </div>
                <div class="row">
                  <div class="errorsBox">
                    <ul id="messageBox">

                    </ul>
                  </div>
                </div>
                <div class="row">
                  <div class="col s12">
                    <ul>
                      <li class="left">
                        <a class="waves-effect waves-light btn-ocatart-link form-trigger active" href="#info-garantia">Garantía</a>
                      </li>
                      <li class="right">
                        <input type="hidden" name="registro" value="nuevo">
                        <button type="submit" class="waves-effect waves-light btn btn-ocatart-fat" id="crear_registro">Cotizar</button>
                      </li>
                    </ul>
                  </div>
                </div>
              </form>
            </div>
            <div class="cards-col col s12 m6 l6">
              <ul>
                <li>
                  <div class="form-card" id="info-garantia" style="display:block;">
                    <div class="form-cards-header">
                      <h4>Garantía</h4>
                    </div>
                    <div class="form-cards-close right" style="position:relative;">
                      <span class="trigger-info close a"><a class="form-trigger close" href="#info-garantia"><i class="material-icons">close</i></a></span>
                    </div>
                    <div class="form-cards-body">
                      <p>
                        Si has seleccionado la opción de seguro para tu pedido tienes la garantía de que si no llega tu paquete se te enviara completamente gratis nuevamente el mismo pedido. (el tiempo de reenvió seria un plazo en lo que se reimprime su pedido y se le dan acabados finales mas el tiempo de envió que la paquetería tenga estimado).
                      </p>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form-card" id="info-nombre">
                    <div class="form-cards-header">
                      <h4>Nombre</h4>
                    </div>
                    <div class="form-cards-close right" style="position:relative;">
                      <span class="trigger-info close a"><a class="form-trigger close" href="#info-nombre"><i class="material-icons">close</i></a></span>
                    </div>
                    <div class="form-cards-body">
                      <p>
                        Introduce tu nombre real este dato sirve en caso de querer una escultura le sera útil a la paquetería para que no le entreguen el pedido a cualquier persona solo se entregaría el paquete a quien se identifique con este nombre Ejemplo: Kevin Tomate Cerbero.
                      </p>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form-card" id="info-nick">
                    <div class="form-cards-header">
                      <h4>Nick</h4>
                    </div>
                    <div class="form-cards-close right" style="position:relative;">
                      <span class="trigger-info close a"><a class="form-trigger close" href="#info-nick"><i class="material-icons">close</i></a></span>
                    </div>
                    <div class="form-cards-body">
                      <p>
                        Algún nombre o seudónimo por el que la gente en internet te conozca. Ejemplo: FONCAT NOM
                      </p>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form-card" id="info-correo">
                    <div class="form-cards-header">
                      <h4>Correo</h4>
                    </div>
                    <div class="form-cards-close right" style="position:relative;">
                      <span class="trigger-info close a"><a class="form-trigger close" href="#info-correo"><i class="material-icons">close</i></a></span>
                    </div>
                    <div class="form-cards-body">
                      <p>
                        Correo electrónico al cual quieres recibir el costo que tendría el pedido.
                      </p>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form-card" id="info-tpedido">
                    <div class="form-cards-header">
                      <h4>Tipo de pedido</h4>
                    </div>
                    <div class="form-cards-close right" style="position:relative;">
                      <span class="trigger-info close a"><a class="form-trigger close" href="#info-correo"><i class="material-icons">close</i></a></span>
                    </div>
                    <div class="form-cards-body">
                      <p>
                        Dime que es lo que quisieras pedir o preguntar su precio si no te acuerdas que clase de cosas ofrezco sugiero que veas el <a href="portafolio">portafolio</a> ahí veras a que pertenece cada cosa.
                      </p>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form-card" id="info-tamaño">
                    <div class="form-cards-header">
                      <h4>Tamaño</h4>
                    </div>
                    <div class="form-cards-close right" style="position:relative;">
                      <span class="trigger-info close a"><a class="form-trigger close" href="#info-correo"><i class="material-icons">close</i></a></span>
                    </div>
                    <div class="form-cards-body">
                      <p>
                        Escoge algún tamaño que te ofrecemos.<br>&ensp;&ensp;Esculturas:<br>&ensp;&ensp;&ensp;&bull;Extra chica 5cm<br>&ensp;&ensp;&ensp;&bull;Chica 10cm<br>&ensp;&ensp;&ensp;&bull;Mediana 15cm<br>&ensp;&ensp;&ensp;&bull;Grande 30cm<br>&ensp;&ensp;&ensp;&bull;Otro tamaño
                      </p>
                      <p>
                        &ensp;&ensp;Busto:<br>&ensp;&ensp;&ensp;&bull;Extra chico 5cm<br>&ensp;&ensp;&ensp;&bull;Chico 10cm<br>&ensp;&ensp;&ensp;&bull;Mediano 15 cm<br>&ensp;&ensp;&ensp;&bull;Grande 25cm<br>&ensp;&ensp;&ensp;&bull;Otro tamaño
                      </p>
                      <p>
                        &ensp;&ensp;Badges 3D:<br>&ensp;&ensp;&ensp;&bull;Chico 5cm<br>&ensp;&ensp;&ensp;&bull;Mediano 10cm<br>&ensp;&ensp;&ensp;&bull;Grande 12cm<br>&ensp;&ensp;&ensp;&bull;Otro tamaño
                      </p>
                      <p>
                        &ensp;&ensp;Badges 2D:<br>&ensp;&ensp;&ensp;&bull;Chico 5cm<br>&ensp;&ensp;&ensp;&bull;Mediano 10cm<br>&ensp;&ensp;&ensp;&bull;Grande 15cm<br>&ensp;&ensp;&ensp;&bull;Otro tamaño
                      </p>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form-card" id="info-esptamaño">
                    <div class="form-cards-header">
                      <h4>Especificar Tamaño</h4>
                    </div>
                    <div class="form-cards-close right" style="position:relative;">
                      <span class="trigger-info close a"><a class="form-trigger close" href="#info-correo"><i class="material-icons">close</i></a></span>
                    </div>
                    <div class="form-cards-body">
                      <p>
                        Escoge algún tamaño que te ofrecemos.<br>&ensp;&ensp;Esculturas:<br>&ensp;&ensp;&ensp;&bull;Extra chica 5cm<br>&ensp;&ensp;&ensp;&bull;Chica 10cm<br>&ensp;&ensp;&ensp;&bull;Mediana 15cm<br>&ensp;&ensp;&ensp;&bull;Grande 30cm<br>&ensp;&ensp;&ensp;&bull;Otro tamaño
                      </p>
                      <p>
                        &ensp;&ensp;Busto:<br>&ensp;&ensp;&ensp;&bull;Extra chico 5cm<br>&ensp;&ensp;&ensp;&bull;Chico 10cm<br>&ensp;&ensp;&ensp;&bull;Mediano 15 cm<br>&ensp;&ensp;&ensp;&bull;Grande 25cm<br>&ensp;&ensp;&ensp;&bull;Otro tamaño
                      </p>
                      <p>
                        &ensp;&ensp;Badges 3D:<br>&ensp;&ensp;&ensp;&bull;Chico 5cm<br>&ensp;&ensp;&ensp;&bull;Mediano 10cm<br>&ensp;&ensp;&ensp;&bull;Grande 12cm<br>&ensp;&ensp;&ensp;&bull;Otro tamaño
                      </p>
                      <p>
                        &ensp;&ensp;Badges 2D:<br>&ensp;&ensp;&ensp;&bull;Chico 5cm<br>&ensp;&ensp;&ensp;&bull;Mediano 10cm<br>&ensp;&ensp;&ensp;&bull;Grande 15cm<br>&ensp;&ensp;&ensp;&bull;Otro tamaño
                      </p>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form-card" id="info-detallado">
                    <div class="form-cards-header">
                      <h4>Tipo de detallado</h4>
                    </div>
                    <div class="form-cards-close right" style="position:relative;">
                      <span class="trigger-info close a"><a class="form-trigger close" href="#info-correo"><i class="material-icons">close</i></a></span>
                    </div>
                    <div class="form-cards-body">
                      <p>
                        Si tu figura es extra chica, chica y mediana no se le pueden poner detalle alto por ser muy pequeña el nivel de detalle entre mas pequeña la pieza menos detalle se le notara, así que seria un costo mayor para un detalle que no se notara, el detalle básico es para las piezas extra chicas en delante el medio básico es para las figuras chicas en delante (solo es una recomendación).
                      </p>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="form-card" id="info-pedido">
                    <div class="form-cards-header">
                      <h4>Cómo deseas tu pedido</h4>
                    </div>
                    <div class="form-cards-close right" style="position:relative;">
                      <span class="trigger-info close a"><a class="form-trigger close" href="#info-pedido"><i class="material-icons">close</i></a></span>
                    </div>
                    <div class="form-cards-body">
                      <p>
                        Aquí especificaras a detalle como deseas que sea tu pedido entre mas especifico seas mejor podre realizar tu pedido.<br>Ejemplo:<br>ESPECIE<br>COLORES(puedes agregar una paleta de colores)<br>TATOOS O MANCHAS(agrega de que lado tiene algo de esto)<br>CANTIDAD DE DEDOS(tiene mas o menos de 5 por extremidad).
                      </p>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
          <div id="ejemplos" class="col s12">
            <div class="row special">
              <h3>Ejemplos de 3D</h3>
              <div class="divider"></div>
              <p>Los precios no son fijos dependen de lo que pidas.</p>
            </div>
            <div class="row">
              <h6 style="color:#999;margin-bottom:1rem;">Elige el tipo de detallado:</h6>
              <ul class="detallado ulhorizontal">
                <li>
                  <label class="ejemplo-trigger check-container" data-trigger="#ejemplo1">Básico.
                    <input type="radio" name="radio" checked>
                    <span class="checkmark ocatart-icons paw"></span>
                  </label>
                </li>
                <li>
                  <label class="ejemplo-trigger check-container" data-trigger="#ejemplo2">Básico medio.
                    <input type="radio" name="radio">
                    <span class="checkmark ocatart-icons paw"></span>
                  </label>
                </li>
                <li>
                  <label class="ejemplo-trigger check-container" data-trigger="#ejemplo3">Medio
                    <input type="radio" name="radio">
                    <span class="checkmark ocatart-icons paw"></span>
                  </label>
                </li>
                <li>
                  <label class="ejemplo-trigger check-container" data-trigger="#ejemplo4">Medio alto.
                    <input type="radio" name="radio">
                    <span class="checkmark ocatart-icons paw"></span>
                  </label>
                </li>
                <li>
                  <label class="ejemplo-trigger check-container" data-trigger="#ejemplo5">Alto
                    <input type="radio" name="radio">
                    <span class="checkmark ocatart-icons paw"></span>
                  </label>
                </li>
              </ul>
            </div>
            <div class="row">
              <?php
                try {
                  $sql = "SELECT num_ejemplo, url_img, ejemplo_txt FROM ejemplos";
                  $respuesta = $conn->query($sql);
                  while ($ejemplo = $respuesta->fetch_assoc() ) { ?>
                    <?php if ($ejemplo['num_ejemplo'] == "1"): ?>
                      <div class="ejemplo-panel" id="ejemplo<?php echo $ejemplo['num_ejemplo']; ?>" style="display:block;">
                        <div class="col s12">
                          <img class="responsive-img" src="img/ejemplos/<?php echo $ejemplo['url_img']; ?>" alt="imagen del ejemplo numero <?php echo $ejemplo['num_ejemplo']; ?>">
                        </div>
                        <div class="col s12">
                          <p><?php echo $ejemplo['ejemplo_txt']; ?></p>
                        </div>
                      </div>
                    <?php else: ?>
                      <div class="ejemplo-panel" id="ejemplo<?php echo $ejemplo['num_ejemplo']; ?>">
                        <div class="col s12">
                          <img class="responsive-img" src="img/ejemplos/<?php echo $ejemplo['url_img']; ?>" alt="imagen del ejemplo numero <?php echo $ejemplo['num_ejemplo']; ?>">
                        </div>
                        <div class="col s12">
                          <p><?php echo $ejemplo['ejemplo_txt']; ?></p>
                        </div>
                      </div>
                    <?php endif; ?>
            <?php }
                } catch (\Exception $e) {
                  $error = $e->getMessage();
                  echo $error;
                }
                ?>
            </div>
          </div>
          <div id="reglas" class="col s12">
            <h3>Reglas para los pedidos</h3>
            <ul class="collapsible" data-collapsible="expandable">
              <?php
                try {
                  $sql = "SELECT nombre_head, regla_txt FROM reglas";
                  $resultado = $conn->query($sql);
                  while ($reglas = $resultado->fetch_assoc() ) { ?>
                    <li>
                      <div class="collapsible-header"><?php echo $reglas['nombre_head']; ?></div>
                      <div class="collapsible-body"><span><?php echo $reglas['regla_txt'] ?></span</div>
                    </li>
            <?php }
                } catch (\Exception $e) {
                  $error = $e->getMessage();
                  echo $error;
                }
              ?>
            </ul>
          </div>
          <div id="lista" class="col s12">
            <h3>Lista de pedidos</h3>
            <div class="row">
              <p class="nota">Si deseas realizar un cotizado o pedido, por favor dirígete a la sección de cotizar.</p>
            </div>
            <div class="colores">
              <h6>Gama de estados:</h6>
              <ul class="ulhorizontal">
                <?php
                  try {
                    $sql = "SELECT titulo_estado, color_estado FROM estados ORDER BY id_estado";
                    $resultado = $conn->query($sql);
                    while ($estado = $resultado->fetch_assoc() ) { ?>
                      <li>
                        <div>
                          <label>
                              <?php echo mb_strtoupper($estado['titulo_estado']); ?>
                          </label>
                          <i class="ocatart-icons paw" style="color:<?php echo $estado['color_estado']; ?>;"></i>
                        </div>
                      </li>
             <?php  }
                  } catch (\Exception $e) {
                    $error = $e->getMessage();
                    echo $error;
                  }
                ?>
              </ul>
            </div>
            <table id="example" class="compact hover row-border stripe responsive nowrap" style="width:100%">
              <thead>
                <tr>
                  <th data-priority="1">#</th>
                  <th data-priority="2">Nick</th>
                  <th>Fecha</th>
                  <th>Tipo</th>
                  <th data-priority="3">Pago</th>
                  <th data-priority="4">Estado</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  try {
                    $sql = "SELECT id_comision, nick, fecha_registro, nombre_pedido, titulo_estado, color_estado, nmbr_estadoPado, color_estadoPado ";
                    $sql .= " FROM comisiones comis";
                    $sql .= " INNER JOIN tipos_pedido tp";
                    $sql .= " ON comis.tipo_pedidoID = tp.id_tPedido ";
                    $sql .= " INNER JOIN estados est";
                    $sql .= " ON comis.estados_ID = est.id_estado ";
                    $sql .= " INNER JOIN estados_pagado est_pado ";
                    $sql .= " ON comis.estado_padoID = est_pado.id_estadoPado ";
                    $sql .= " WHERE comis.confirmado = '1' ";
                    $respuesta = $conn->query($sql);
                    while ($lista = $respuesta->fetch_assoc() ) {
                      $fecha = $lista['fecha_registro'];
                      $fecha_format = date('d/m/Y', strtotime($fecha));
                ?>
                      <tr>
                        <td>#<?php echo str_pad($lista['id_comision'], 5, '0', STR_PAD_LEFT) ?></td>
                        <td><?php echo $lista['nick']; ?></td>
                        <td><?php echo $fecha_format; ?></td>
                        <td><?php echo $lista['nombre_pedido']; ?></td>
                        <td><?php echo $lista['nmbr_estadoPado']; ?><div class="estado" style="background-color:<?php echo $lista['color_estadoPado']; ?>;"></div></td>
                        <td><?php echo $lista['titulo_estado']; ?><div class="estado" style="background-color:<?php echo $lista['color_estado']; ?>;"></div></td>
                      </tr>
              <?php }
                  } catch (\Exception $e) {
                    $error = $e->getMessage();
                    echo $error;
                  }
                ?>
              </tbody>
            </table>

          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.container -->


  <!-- Contacto -->
  <section class="contact-section bg-black" id="contacto-div">
    <div class="container">


      <div class="social d-flex justify-content-center">
                  <a href="https://twitter.com/ode_moncat" target="_blank" class="mx-2">
                    <i class="ocatart-icons twitter"></i>
                  </a>
                  <a href="https://discord.gg/Y6T4AF3" target="_blank" class="mx-2">
                    <i class="ocatart-icons discord"></i>
                  </a>
                  <a href="https://fb.com/Odemoncat/" target="_blank" class="mx-2">
                    <i class="ocatart-icons facebook"></i>
                  </a>
                  <a href="https://t.me/Odemoncat/" target="_blank" class="mx-2">
                    <i class="ocatart-icons telegram"></i>
                  </a>
      </div>

    </div>
  </section>


  <!-- Footer -->
  <footer class="bg-black small center text-white-50">
    <div class="container">
      Copyright &copy; @odemoncat 2022
    </div>
  </footer>
  <!-- Core Javascript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.0/js/materialize.min.js"></script>
  <script src="js/initcotizaciones.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/1.16.1/TweenMax.min.js'></script>
  <script src='js/ScrollMagic.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.1/plugins/animation.gsap.js'></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <!-- <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/jquery.dataTables.min.js" integrity="sha256-t5ZQTZsbQi8NxszC10CseKjJ5QeMw5NINtOXQrESGSU=" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
  <!-- Custom scripts -->
  <!-- SweetAlert2 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js" integrity="sha256-2RS1U6UNZdLS0Bc9z2vsvV4yLIbJNKxyA4mrx5uossk=" crossorigin="anonymous"></script>
  <script src="js/jquery.validate.min.js" charset="utf-8"></script>
  <script src="js/additional-methods.min.js" charset="utf-8"></script>
  <script src="js/forms-ajax.js" charset="utf-8"></script>
</body>

</html>
