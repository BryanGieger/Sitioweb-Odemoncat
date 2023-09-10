<?php
  include_once 'includes/funciones.php';
?>
<!DOCTYPE html>
<html lang="es">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Odemoncat</title>

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
    <!-- <ul id="idioma" class="dropdown-content">
      <li><a href="#!">Español</a></li>
      <li><a href="#!">English</a></li>
    </ul> -->
    <nav class="nav-extended nav-full-header z-depth-0 blue-grey darken-3">
      <div class="nav-background background-img" style="">
      </div>
      <div class="nav-wrapper container">
        <a class="brand-logo"><i class="ocatart-icons logo"></i></a>
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
          <li class="active"><a>Inicio</a></li>
          <li><a href="portafolio.php">Portafolio</a></li>
          <li><a href="comisiones.php">Comisiones</a></li>
          <!-- <li><a class="dropdown-button" href="#!" data-activates="idioma"><i class="ocatart-icons lang"></i>ES<i class="material-icons right">arrow_drop_down</i></a></li> -->
          <!-- <li><a href="#">Servicios</a></li>
          <li><a href="#">Tienda</a></li> -->
        </ul>


      </div>

      <div class="nav-header valign-wrapper">
        <div class="center">
          <h1 class="h1-titulo">ODE MONCAT</h1>
          <div class="tagline subtitulo">CONCEPT, FURRY AND DIGITAL
            ARTIST</div>
        </div>
      </div>

      <!-- Fixed Masonry Filters -->
      <div class="categories-wrapper af lighten-1">
        <div class="categories-container pin-top" style="top: 0px;">
          <ul class="categories db" id="categories">
            <li class="k"  id="homebtn"><a class="js-scroll-trigger" href="#home">Inicio</a></li>
            <li class="k"><a class="js-scroll-trigger" href="#about">Acerca de</a></li>
            <li class=""><a class="js-scroll-trigger" href="#projects">Proyectos</a></li>
            <li><a class="js-scroll-trigger" href="#signup">Contacto</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <ul class="side-nav" id="nav-mobile">
      <li class="active">
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
      <!-- <li>
        <a class="dropdown-button" href="#!" data-activates="idioma"><i class="ocatart-icons lang"></i>ES<i class="material-icons right">arrow_drop_down</i></a>
      </li> -->
    </ul>

<?php
  try {
    $sql = "SELECT servicio_img, servicio_tag FROM servicios";
    $resultado = $conn->query($sql);
  } catch (\Exception $e) {
    $error = $e->getMessage();
    echo $error;
  }
  while ($servicios = $resultado->fetch_assoc()) {
    if ($servicios['servicio_tag'] == "about") { ?>
      <section id="<?php echo $servicios['servicio_tag']; ?>" class="about-section center">
        <div id="about-fade">
            <div class="container">
                <div class="row">
                  <div class="col lg8 mx-auto">
                    <h2 class="white-text mb-4">Creamos lo que pidas</h2>
                    <p class="text-white-50">Adquiere las esculturas de tus personajes completamente a tu gusto, seres fantásticos, especies alienígenas, diferentes tamaños, colores, formas interesantes, buenos acabados y efectos, si quieres que tu personaje tenga, cabeza de calabaza, una pata de palo y valla Montado sobre una bomba nuclear, ¡SÉ PUEDE HACER! como se te antoje, ¡Claro!... siempre y cuando no rompa las leyes de la física. Todo esto y mas lo puedes tener físicamente. ¡En tus manos!</p>
                  </div>
                </div>
                <img src="img/<?php echo $servicios['servicio_img']; ?>" class="responsive-img img-fluid estatua-img" alt="">
              </div>
        </div>
      </section>

      <section id="projects" class="projects-section background-body">
        <div class="container">
    <?php  }
        if ($servicios['servicio_tag'] == "servicio1-div") { ?>
              <!--Portafolio 1 -->
              <div class="row row-box" id="<?php echo $servicios['servicio_tag']; ?>">
                <div class="col l7">
                  <img class="responsive-img img-box" src="img/<?php echo $servicios['servicio_img']; ?>" alt="">
                </div>
                <div class="col l5">
                  <div class="featured-text text-row center animated text-lg-left texto-oculto" id="servicio1-text">
                    <h4>Ilustraciones digitales</h4>
                    <p class="text-black-50 mb-0">Puedes pedir ilustraciones digitales según lo que requieras, concept art, ilustración para comics, portadas de libros, ilustrar una novela gráfica, todo lo que necesites.</p>
                  </div>
                </div>
              </div>
          <?php  }
            if ($servicios['servicio_tag'] == "servicio2-div") { ?>
              <!-- Portafolio 2 -->
              <div class="row row-stretch justify-content-center no-gutters" id="<?php echo $servicios['servicio_tag']; ?>">
                <div class="col l6 column-box">
                  <img class="responsive-img img-box img-stretch" src="img/<?php echo $servicios['servicio_img']; ?>" alt="">
                </div>
                <div class="col l6 column-box">
                  <div class="bg-black text-row center h-100 project">
                    <div class="d-flex h-100">
                      <div class="text-box project-text w-100 my-auto text-center text-lg-left animated texto-oculto" id="servicio2-text">
                        <h4 class="white-text">Items para Furmakers</h4>
                        <p class="mb-0 text-white-50">objetos pensados para los creadores de fursuits para que puedan agregar a sus trabajos unos detalles interesantes a gusto de sus clientes.
                        </p>
                        <hr class="d-none d-lg-block mb-0 ml-0">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          <?php  }
            if ($servicios['servicio_tag'] == "servicio3-div") { ?>
              <!-- Portafolio 3 -->
              <div class="row row-stretch justify-content-center no-gutters" id="<?php echo $servicios['servicio_tag']; ?>">
                <div class="col l6 column-box">
                  <img class="responsive-img img-box img-stretch" src="img/<?php echo $servicios['servicio_img']; ?>" alt="">
                </div>
                <div class="col l6 column-box order-lg-first">
                  <div class="bg-black text-row center h-100 project">
                    <div class="d-flex h-100">
                      <div class="text-box project-text w-100 my-auto text-center text-lg-right animated texto-oculto"  id="servicio3-text">
                        <h4 class="white-text">Stikers</h4>
                        <p class="mb-0 text-white-50">Ahora puedes pedir stickers de tus oc's, fursona y mas cosas que se te ocurran para tu telegram.</p>
                        <hr class="d-none d-lg-block mb-0 mr-0">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <?php   }
          } ?>

    <section id="signup" class="signup-section">
      <div class="container">
        <div class="row">
          <div class="col m12 lg12 mx-auto center">
            <div class="animated" id="seguir-div">
                <i class="far fa-paper-plane fa-2x mb-2 white-text"></i>
                <h2 class="white-text mb-5 title-text">Notificarme cuando suba cosas nuevas</h2>
                <div class="row form-contact">
                    <div class="input-field col s12 m7 l8">
                        <input id="first_name" type="text" class="input-contact">
                        <label for="first_name" class="text-align-left">Email</label>
                      </div>
                      <div class="col s12 m5 l4 btn-contact">
                          <button class="btn waves-effect waves-light btn-transparent" type="submit" name="action">Notifícame
                              <i class="material-icons right">send</i>
                            </button>
                      </div>
                    </div>
            </div>
          </div>
        </div>
      </div>
    </section>

          <!-- Contacto -->
          <section class="contact-section bg-black" id="contacto-div">
              <div class="container">

                <div class="row">

                  <div class="col m4 mb-3 mb-md-0 div-card" style="float:none;margin:0 auto;">
                    <div class="card py-4 h-100 animated contacto-card">
                      <div class="card-body center">
                        <i class="fas fa-envelope text-primary mb-2"></i>
                        <h4 class="text-uppercase m-0">Correo</h4>
                        <hr class="my-4">
                        <div class="small text-black-50">
                          <a href="#">ode@odemoncat.com</a>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>

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
    <script src="js/init.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/1.16.1/TweenMax.min.js'></script>
    <script src='js/ScrollMagic.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.1/plugins/animation.gsap.js'></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Custom scripts -->
    <script src="js/ocatart.js"></script>
    <script src="js/scroll.js"></script>
  </body>
</html>

<?php $conn->close() ?>
