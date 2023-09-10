<?php
include_once 'includes/funciones.php';

if ($_POST['registro'] == 'eliminar') {

  $id_borrar = $_POST['id'];
  $imagen_borrar = $_POST['img'];

  $directorio = "/home/ocatartc/admin/img/comisiones";

  $img_array = explode(",", $imagen_borrar);

  try {
    $stmt = $conn->prepare('DELETE FROM comisiones WHERE id_comision = ? ');
    $stmt->bind_param("i", $id_borrar);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
      foreach ($img_array as $key) {
        if (file_exists("$directorio/$key")) {
          if (unlink("$directorio/$key")) {
            $img_borrado = "La imagen $key se a borrado correctamente!";
          }
          else {
            $resultado = array(
              'respuesta' => error_get_last()
            );
          }
        }
        else {
          $resultado = array(
            'respuesta' => 'El archivo no existe',
            'error' => error_get_last()
          );
        }
      }
      $resultado = array(
        'respuesta' => 'Exito',
        'id_eliminado' => $id_borrar,
        'img_borrada' => $img_borrado
      );
    } else {
      $resultado = array(
        'respuesta' => 'error'
      );
    }
  } catch (\Exception $e) {
    $resultado = array(
      'respuesta' => $e->getMessage()
    );
  }
  die(json_encode($resultado));
}
?>
