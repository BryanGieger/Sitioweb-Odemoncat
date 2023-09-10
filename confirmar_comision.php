<?php
include_once 'includes/funciones.php';

if (isset($_POST['precio'])) {
  $precio_elejido = $_POST['precio'];
} else {
  $precio_elejido = 0;
}
$need_direccion = $_POST['need_direccion'];
if ($need_direccion == "1") {
  $direccion = filter_var($_POST['direccion'], FILTER_SANITIZE_STRING);

  if (isset($_POST['direccion2'])) {
    $direccion2 = filter_var($_POST['direccion2'], FILTER_SANITIZE_STRING);
  } else {
    $direccion2 = "NULL";
  }

  $pais = $_POST['pais'];
  $provincia = filter_var($_POST['provincia'], FILTER_SANITIZE_STRING);
  $ciudad = filter_var($_POST['ciudad'], FILTER_SANITIZE_STRING);
  $codigo_postal = $_POST['codigo_postal'];

  if (isset($_POST['telefono'])) {
    $numero_telf = $_POST['telefono'];
  } else {
    $numero_telf = "NULL";
  }

  $numero_cel = $_POST['celular'];

  if (isset($_POST['seguro'])) {
    $seguro = $_POST['seguro'];
  } else {
    $seguro = 0;
  }

} else {
  $direccion = "NULL";
  $direccion2 = "NULL";
  $pais = 23;
  $provincia = "NULL";
  $ciudad = "NULL";
  $codigo_postal = "NULL";
  $numero_telf = "NULL";
  $numero_cel = "NULL";
  $seguro = 0;
}

$metodo_pago = $_POST['metodo_pago'];

$aditionalinfo = strlen($_POST['info_adicional']);
if ($aditionalinfo > 0) {
  $info_adicional = filter_var($_POST['info_adicional'], FILTER_SANITIZE_STRING);
} else {
  $info_adicional = "NULL";
}

$paso = $_POST['paso'];

if ($_POST['registro'] == 'actualizar') {
  $id_registro = $_POST['id_registro'];
  $confirmar = 1;
  try {
    $stmt = $conn->prepare('UPDATE comisiones SET user_desicion = ?, direccion = ?, direccion_2 = ?, pais_ID = ?, provincia = ?, ciudad = ?, codigo_postal = ?, numero_telf = ?, numero_cel = ?, method_pagoID = ?, info_adicional = ?, seguro = ?, paso = ?, confirmado = ?, editado = NOW() WHERE id_comision = ? ');
    $stmt->bind_param('ississsssisiiii', $precio_elejido, $direccion, $direccion2, $pais, $provincia, $ciudad, $codigo_postal, $numero_telf, $numero_cel, $metodo_pago, $info_adicional, $seguro, $paso, $confirmar, $id_registro);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
      $respuesta = array(
        'respuesta' => 'Exito',
        'id_actualizado' => $id_registro
      );
    } else {
      $respuesta = array(
        'respuesta' => 'error',
        'error' => $stmt->error
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
