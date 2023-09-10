<?php
include_once 'includes/funciones.php';

function nuevaNoti($titulo, $texto, $icono, $url){
  $estado = 0;
  try {
    $stmt = $conn->prepare("INSERT INTO notificaciones (titulo_noti, msg_noti, icon_noti, url_noti, estado_noti, date_noti) VALUES (?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("sssii", $titulo, $texto, $icono, $url, $estado);
    $stmt->execute();
    $id_registro = $stmt->insert_id;
    if ($stmt->affected_rows > 0) {
      return "true";
    } else {
      return array(
        'respuesta' => 'error',
        'error' => mysqli_error($conn)
      );
    }
    $stmt->close();
    $conn->close();
  } catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
  }
}

$nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
$nick = filter_var($_POST['nick'], FILTER_SANITIZE_STRING);
$correo = $_POST['correo'];
$tipo_pedido = filter_var($_POST['tipo'], FILTER_SANITIZE_STRING);
if (isset($_POST['tamaño'])) {
  $tamaño = $_POST['tamaño'];
}
else {
  $tamaño = "1";
}
if (isset($_POST['otro'])) {
  $otro_tamaño = filter_var($_POST['otro'], FILTER_SANITIZE_STRING);
}
else {
  $otro_tamaño = "NULLL";
}
if (isset($_POST['detallado'])) {
  $detallado = $_POST['detallado'];
}
else {
  $detallado = "1";
}
$descripcion = filter_var($_POST['pedido'], FILTER_SANITIZE_STRING);


if ($_POST['registro'] == 'nuevo') {

  $directorio = "/home/kitiebowdev/www/admin.odemoncat.com/htdocs/img/comisiones";

  if (!is_dir($directorio)) {
    mkdir($directorio, 0755, true);
  }

  $tmp_name = $_FILES['file_upload']['tmp_name'];
  $name = $_FILES["file_upload"]['name'];
  $count_files = count($tmp_name);
  $nick_minusculas = mb_strtolower($nick);
  $nombre_final = str_replace(' ', '', $nick_minusculas);
  $urls_imgs = array();

  for ($i=0; $i < $count_files; $i++) {
    $extension = pathinfo($name[$i], PATHINFO_EXTENSION);

    if(move_uploaded_file($tmp_name[$i], $directorio."/".$nombre_final.$i.".".$extension)) {
      $urls_imgs[] = $nombre_final.$i.".".$extension;
      $imagen_resultado = "Se subió correctamente";
    } else {
      $respuesta = array(
        'respuesta' => error_get_last()
      );
    }
  }

  $img_commaSeparated = implode(",", $urls_imgs);

  try {
    $stmt = $conn->prepare("INSERT INTO comisiones (nombre, nick, correo, tipo_pedidoID, tamano_ID, otro_tamano, detallado_ID, descripcion, urls_imgs) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssiisiss", $nombre, $nick, $correo, $tipo_pedido, $tamaño, $otro_tamaño, $detallado, $descripcion, $img_commaSeparated);
    $stmt->execute();
    $id_registro = $stmt->insert_id;
    if ($stmt->affected_rows > 0) {
      $respuesta = array(
        'respuesta' => 'Exito',
        'id_comision' => $id_registro
      );

      // $titulo_noti = "Nueva comision";
      // $txt_noti = "Nueva comision de ".$nick;
      // $icon_noti = "comision";
      // $url_id = $id_registro;
      //
      // $noti_return = nuevaNoti($titulo_noti, $txt_noti, $icon_noti, $url_id);
      // if ($noti_return = "true") {
      //   $respuesta = array(
      //     'respuesta' => 'Exito',
      //     'id_comision' => $id_registro
      //   );
      // }
      // else {
      //   $respuesta = $noti_return;
      // }
    } else {
      $respuesta = array(
        'respuesta' => 'error',
        'error' => mysqli_error($conn)
      );
    }
    $stmt->close();
    $conn->close();
  } catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
  }
  die(json_encode($respuesta));
}
?>
