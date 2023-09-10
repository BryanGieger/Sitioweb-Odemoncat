<?php
  include_once 'funciones.php';

  if (isset($_POST['correo'])) {
    $correo = $_POST['correo'];
    $sql = "SELECT count(correo) AS total FROM comisiones WHERE correo = '$correo'";
    $resultado = $conn->query($sql);
    $total = $resultado->fetch_assoc();

    if ($total['total'] == 0) {
      echo "true";
    } else {
      echo "false";
    }
    $conn->close();
  }
?>
