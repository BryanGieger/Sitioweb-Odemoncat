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

    <title>Portafolio | Odemoncat</title>

    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <link href="css/gallery-dark-materialize.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="css/ocatart.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/iconos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
</head>

<body class="blue-grey darken-4" id="home">
    <div class="background-image"></div>
    <nav class="nav-extended nav-portafolio z-depth-0">
        </div>
        <div class="nav-wrapper container">
            <a href="inicio" class="brand-logo">Ocatart</a>
            <a href="#" data-activates="nav-mobile" class="button-collapse">
                <i class="material-icons">menu</i>
            </a>
            <ul class="right hide-on-med-and-down">
                <li>
                    <a href="https://www.odemoncat.com">Inicio</a>
                </li>
                <li class="active">
                    <a href="portafolio.php">Portafolio</a>
                </li>
                <li>
                    <a href="comisiones.php">Comisiones</a>
                </li>
                <!-- <li>
                    <a href="servicios">Servicios</a>
                </li>
                <li>
                    <a href="https://shop.ocatart.com">Tienda</a>
                </li> -->
            </ul>


        </div>

        <div class="nav-header nav-pad valign-wrapper">
            <div class="center div-logo">
                <i class="ocatart-icons logo nav-logo"></i>
                <h1 class="h1-titulo text-logo">ODEMONCAT</h1>
            </div>
        </div>

        <!-- Fixed Masonry Filters -->
        <div class="categories-wrapper af lighten-1">
            <div class="categories-container pin-top" style="top: 0px;">
                <ul class="categories db" id="categories">
                    <li class="k" id="homebtn">
                        <a class="js-scroll-trigger" href="#home">Inicio</a>
                    </li>
                    <li class="k active">
                        <a class="js-scroll-trigger" href="#all">Todos</a>
                    </li>
                    <?php
                      $sql = "SELECT nombre_cat, etiqueta FROM categoria_portfolio";
                      $resultado = $conn->query($sql);
                      while ($categorias = $resultado->fetch_assoc()) { ?>
                        <li class="">
                            <a class="js-scroll-trigger" href="#<?php echo $categorias['etiqueta']; ?>"><?php echo $categorias['nombre_cat']; ?></a>
                        </li>
                    <?php  }  ?>
                </ul>
            </div>
        </div>
    </nav>
    <ul class="side-nav" id="nav-mobile">
      <li>
        <a href="inicio">
          Inicio</a>
      </li>
      <li class="active">
        <a href="portafolio">
          Portafolio</a>
      </li>
      <li>
        <a href="comisiones">
          Comisiones</a>
      </li>
    </ul>

    <div id="modal" class="modal">
        <div class="">
            <div class="modal-content">
                <div>
                    <img id="modal-img" class="responsive-img materialboxed" src="#">
                </div>

            </div>
            <div class="modal-footer">

                <!--   <a class="btn-floating btn-large waves-effect waves-light btn-step">
                                    <i class="material-icons">
                                        <span class="icon-paw"></span>
                                    </i>
                                </a> -->
                <div class="center-vertical">
                    <h4 class="modal-text"></h4>
                    <div class="center-vertical full-right">
                            <!-- <div class="chip chip-step center-vertical right">
                                    <i class="material-icons">
                                        <span class="icon-paw icon-step"></span>
                                    </i>
                                    <b class="count-step">21</b>
                                </div> -->
                                <a href="comisiones" class="btn btn-option btn-list right">Solicitar pedido</a>
                    </div>
                </div>
                <p class="modal-parrafo"></p>
            </div>
        </div>
    </div>

    <!-- Gallery -->
    <div id="portfolio" class="section gray portafolio">
        <div class="gallery row div-gallery">
          <?php
            try {
              $sql = "SELECT id_portfolio, titulo, etiqueta, descripcion, url_img ";
              $sql .= " FROM portfolio ";
              $sql .= " INNER JOIN categoria_portfolio ";
              $sql .= " ON portfolio.categoria=categoria_portfolio.id_categoria ";
              $sql .= " ORDER BY id_portfolio DESC ";
              $resultado = $conn->query($sql);
            } catch (\Exception $e) {
              $error = $e->getMessage();
              echo $error;
            }
            while ($portafolio = $resultado->fetch_assoc()) { ?>
              <div class="col l4 m6 s12 gallery-item gallery-expand gallery-filter <?php echo $portafolio['etiqueta']; ?> z-1">
                  <div class="gallery-curve-wrapper">
                      <a class="gallery-cover modal-trigger" href="#modal">
                          <img class="responsive-img modal-img" src="img/portafolio/<?php echo $portafolio['url_img']; ?>" m-title="<?php echo $portafolio['titulo']; ?>" m-parrafo="<?php echo $portafolio['descripcion']; ?>" m-counter="21" alt="placeholder">
                      </a>
                  </div>
              </div>
          <?php  }  ?>
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
    <script src="https://cdn.jsdelivr.net/materialize/0.98.0/js/materialize.min.js"></script>
    <script src="../js/initPortafolio.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/1.16.1/TweenMax.min.js'></script>
    <script src='../js/ScrollMagic.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.1/plugins/animation.gsap.js'></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ"
        crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Custom scripts -->
    <script src="../js/imagesloaded.pkgd.min.js"></script>
    <script src="../js/masonry.pkgd.min.js"></script>
    <script src="../js/galleryExpand.js"></script>
</body>

</html>

<?php $conn->close(); ?>
