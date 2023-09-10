<?php
  $str = $_GET['num'];
  $str_limpio = ltrim($str, '0');
  $id = $str_limpio;
  //$id = $_GET['id'];
  if(!filter_var($id, FILTER_VALIDATE_INT)):
    header("Location: 404");
  else:
    include_once 'includes/funciones.php';
    $sql = "SELECT count(id_comision) AS total FROM comisiones WHERE paso = 2 AND confirmado = 0 AND id_comision = $id";
    $resultado = $conn->query($sql);
    $total = $resultado->fetch_assoc();
    if (!$total['total'] == "1"):
      header("Location: 404");
    else:
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Confirmar pedido</title>

  <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
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
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css" integrity="sha256-2bAj1LMT7CXUYUwuEnqqooPb1W0Sw0uKMsqNH0HwMa4=" crossorigin="anonymous" />
</head>

<body class="background-disc" id="home">
  <nav class="nav-extended nav-comisiones z-depth-0">
    <div class="nav-wrapper container">
      <a href="inicio" class="brand-logo"><i class="ocatart-icons logo nav-logo mini"></i></a>
      <a href="#" data-activates="nav-mobile" class="button-collapse">
        <i class="material-icons">menu</i>
      </a>
      <ul class="right hide-on-med-and-down">
        <li>
          <a href="inicio">Inicio</a>
        </li>
        <li>
          <a href="portafolio">Portafolio</a>
        </li>
        <li>
          <a href="comisiones">Comisiones</a>
        </li>
        <!-- <li>
          <a href="docs.html">Servicios</a>
        </li>
        <li>
          <a href="https://tienda.ocatart.com">Tienda</a>
        </li> -->
      </ul>
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
    <li>
      <a href="comisiones">
        Comisiones</a>
    </li>
  </ul>


  <!-- Gallery -->
  <div id="confirmacion" class="section gray confirmacion content-comisiones text-comisiones">
    <div class="container">
      <?php
        try {
          $sql = "SELECT id_comision, nombre, nick, nombre_pedido, need_direccion, titulo_pedido, urls_imgs, observacion, doble_precio, primer_precio, segundo_precio, precio, descuento ";
          $sql .= " FROM comisiones c ";
          $sql .= " INNER JOIN tipos_pedido tp ";
          $sql .= " ON c.tipo_pedidoID = tp.id_tPedido ";
          $sql .= " WHERE c.id_comision = $id ";
          $resultado = $conn->query($sql);
          $info = $resultado->fetch_assoc();
        } catch (\Exception $e) {
          $error = $e->getMessage();
          echo $error;
        }
      ?>
      <div class="row">
        <div class="col s12 m6 l6 center-div">
          <h3 style="margin-bottom:14px;">Resumen de tu pedido</h3>
          <span class="info-ocatart">&ensp;<i class="ocatart-icons info"></i>&ensp;Recuerda que puedes confirmar tu comision ahora y pagarla mas tarde.</span>
          <div class="resumen" style="margin-top:14px;">
            <div class="row">
              <div class="col s12 m8">
                <b>Numero de pedido:</b> #<?php echo str_pad($info['id_comision'], 5, '0', STR_PAD_LEFT); ?>
              </div>
              <div class="col s12 m8">
                <b>Nombre:</b> <?php echo $info['nombre']; ?>
              </div>
              <div class="col s12 m8">
                <b>Nick:</b> <?php echo $info['nick']; ?>
              </div>
              <div class="col s12 m8">
                <b>Tipo de comision:</b> <?php echo $info['nombre_pedido']; ?>.
              </div>
              <div class="col s12 observacion">
                <?php if ($info['doble_precio'] == "1"):
                  $primer_precio = number_format($info['primer_precio']);
                  $segundo_precio = number_format($info['segundo_precio']);
                ?>
                  <b>Observacion:</b> <?php echo $info['observacion']; ?>
                  <br>
                  <div class="col s6">
                    Opcion 1: $<?php echo $primer_precio; ?> MXN
                  </div>
                  <div class="col s6">
                    Opcion 1: $<?php echo $segundo_precio; ?> MXN
                  </div>
                <?php else: ?>
                  <b>Observacion:</b> <?php echo $info['observacion']; ?>
                <?php endif; ?>
              </div>
              <hr class="col s12 fact">
            </div>
            <div class="row">
              <?php
                $precio_format = number_format($info['precio']);
                $descuento_format = number_format($info['descuento']);
                $precio = $info['precio'];
                $descuento = $info['descuento'];
                $total = $precio - $descuento;
                $total_format = number_format($total);
              ?>
              <div class="col s8">
                <div class="title-comision">
                  <?php echo $info['titulo_pedido']; ?>
                </div>
              </div>
              <div class="col s4">
                <div class="precio">
                  $<?php echo $precio_format; ?><span>.00</span> MXN
                </div>
              </div>
              <hr class="col s12 fact">
            </div>
            <div class="row">
              <div class="col s8">
                <div class="precio-title">
                  Subtotal
                </div>
              </div>
              <div class="col s4 right">
                <div class="precio">
                  $<?php echo $precio_format; ?><span>.00</span> MXN
                </div>
              </div>
              <div class="col s8">
                <div class="precio-title">
                  Descuento
                </div>
              </div>
              <div class="col s4 right">
                <div class="precio">
                  -$<?php echo $descuento_format; ?><span>.00</span> MXN
                </div>
              </div>
              <hr class="col s6 fact right">
            </div>
            <div class="row">
              <div class="col s8">
                <div class="precio-total">
                  Total
                </div>
              </div>
              <div class="col s4 right">
                <div class="total">
                  $<?php echo $total_format; ?><span>.00</span> MXN
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col s12 m6 l6 center-form">
          <h3>Completar tu pedido</h3>
          <span class="info-ocatart">&ensp;<i class="ocatart-icons info"></i>&ensp;Para confirmar tu pedido por favor rellena el siguiente formulario.</span>
          <div class="errorsBox">
            <ul id="messageBox">

            </ul>
          </div>
          <form class="form-direccion" role="form" name="enviar-registro" id="enviar-registro" method="post" action="confirmar_comision.php">
            <?php if ($info['need_direccion'] == "1"): ?>
              <?php if ($info['doble_precio'] == "1"): ?>
                <div class="row">
                  <div class="input-field col s12 input-Default margin-column">
                    <select class="browser-default ocatart-select" id="elegir_precio" name="precio">
                      <option value="" disabled selected>Opciones de precio</option>
                      <option value="1">Opcion 1 $<?php echo $primer_precio; ?> MXN</option>
                      <option value="2">Opcion 2 $<?php echo $segundo_precio; ?> MXN</option>
                    </select>
                  </div>
                </div>
              <?php endif; ?>
              <div class="input-field col s12 input-Default">
                <input id="direccion" name="direccion" class="input-ocatart" type="text">
                <label for="direccion">Dirección</label>
              </div>
              <div class="row">
                <div class="input-field col s12 input-Default margin-column">
                  <input id="direccion2" name="direccion2" class="input-ocatart" type="text">
                  <label for="direccion2" class="input-label">Adicional (Piso, edificio, referencias etc.)</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s6 input-Default margin-column">
                  <select class="browser-default ocatart-select" id="pais" name="pais">
                    <option value="" disabled selected>País</option>
                    <?php
                      try {
                        $sql = "SELECT * FROM paises ORDER BY nombr_pais";
                        $respuesta = $conn->query($sql);
                        while ($pais = $respuesta->fetch_assoc() ) { ?>
                          <?php if ($pais['nombr_pais'] == "ninguno"): ?>
                          <?php else: ?>
                            <option value="<?php echo $pais['id_pais']; ?>"><?php echo $pais['nombr_pais']; ?></option>
                          <?php endif; ?>
                  <?php }
                      } catch (\Exception $e) {
                        $error = $e->getMessage();
                        echo $error;
                      }

                    ?>

                  </select>
                </div>
                <div class="input-field col s6 input-Default margin-column">
                  <input id="estado" name="provincia" class="input-ocatart" type="text">
                  <label for="estado" class="input-label">Estado/Provincia/Región</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s6 input-Default margin-column">
                  <input id="ciudad" name="ciudad" class="input-ocatart" type="text">
                  <label for="ciudad" class="input-label">Ciudad</label>
                </div>
                <div class="input-field col s6 input-Default margin-column">
                  <input id="codigo_postal" name="codigo_postal" class="input-ocatart" type="text">
                  <label for="codigo_postal" class="input-label">Código Postal</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s6 input-Default margin-column">
                  <input id="telefono" name="telefono" class="input-ocatart" type="text">
                  <label for="telefono" class="input-label">Número de teléfono</label>
                </div>
                <div class="input-field col s6 input-Default margin-column">
                  <input id="celular" name="celular" class="input-ocatart" type="text">
                  <label for="celular" class="input-label">Número de celular</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12 input-Default margin-column">
                  <select class="browser-default ocatart-select" id="metodo_pago" name="metodo_pago">
                    <option value="" disabled selected>Metodo de pago</option>
                    <?php
                      try {
                        $sql = "SELECT * FROM method_pago";
                        $respuesta = $conn->query($sql);
                        while ($pago = $respuesta->fetch_assoc() ) { ?>
                          <option value="<?php echo $pago['id_methPago']; ?>"><?php echo $pago['titulo_methPago']; ?></option>
                  <?php }
                      } catch (\Exception $e) {
                        $error = $e->getMessage();
                        echo $error;
                      }

                    ?>

                  </select>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12 input-Default margin-column">
                  <textarea id="info_adicional" name="info_adicional" class="materialize-textarea input-ocatart" data-length="800"></textarea>
                  <label for="info_adicional" class="input-label">¿Algo adicional que hayas olvidado comentar sobre tu pedido?</label>
                </div>
              </div>
              <div class="row">
                <p>
                  <input type="checkbox" class="filled-in" id="seguro" name="seguro" value="1" />
                  <label for="seguro">Seguro del paquete (Adicional: $100 MXN a tu pedido)</label>
                </p>
              </div>
            <?php else: ?>
              <div class="row">
                <div class="input-field col s12 input-Default margin-column">
                  <select class="browser-default ocatart-select" id="metodo_pago" name="metodo_pago">
                    <option value="" disabled selected>Metodo de pago</option>
                    <?php
                      try {
                        $sql = "SELECT * FROM method_pago";
                        $respuesta = $conn->query($sql);
                        while ($pago = $respuesta->fetch_assoc() ) { ?>
                          <option value="<?php echo $pago['id_methPago']; ?>"><?php echo $pago['titulo_methPago']; ?></option>
                  <?php }
                      } catch (\Exception $e) {
                        $error = $e->getMessage();
                        echo $error;
                      }

                    ?>

                  </select>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12 input-Default margin-column">
                  <textarea id="info_adicional" name="info_adicional" class="materialize-textarea input-ocatart" data-length="800"></textarea>
                  <label for="info_adicional" class="input-label">¿Algo adicional que hayas olvidado comentar sobre tu pedido?</label>
                </div>
              </div>
            <?php endif; ?>
            <div class="row">
              <div class="col s12">
                <ul>
                  <li class="left">
                    <a class="waves-effect waves-light btn-ocatart-link form-trigger active borrar-registro-imagen" data-id="<?php echo $id; ?>" data-tipo="cancelar_comision" data-img="<?php echo $info['urls_imgs']; ?>">Cancelar Pedido</a>
                  </li>
                  <li class="right">
                    <input type="hidden" name="need_direccion" value="<?php echo $info['need_direccion']; ?>">
                    <input type="hidden" name="paso" value="3">
                    <input type="hidden" name="registro" value="actualizar">
                    <input type="hidden" name="id_registro" value="<?php echo $id; ?>">
                    <button type="submit" class="waves-effect waves-light btn btn-ocatart-fat" id="crear_registro">Confirmar</button>
                  </li>
                </ul>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- /.container -->


  <!-- Contacto -->
  <section class="contact-section bg-black" id="contacto-div">
    <div class="container">


      <div class="social d-flex justify-content-center">
        <a href="https://twitter.com/ocatart" target="_blank" class="mx-2">
          <i class="ocatart-icons twitter"></i>
        </a>
        <a href="https://discord.gg/Y6T4AF3" target="_blank" class="mx-2">
          <i class="ocatart-icons discord"></i>
        </a>
        <a href="https://fb.com/ocatarte/" target="_blank" class="mx-2">
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
      Copyright &copy; @ocatart 2019
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
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
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
<?php
            endif;
            $conn->close();
          endif;
?>
