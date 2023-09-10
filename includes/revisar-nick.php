<?php
  include_once 'funciones.php';

  if (isset($_POST['nick'])) {
    $nick = $_POST['nick'];
    $sql = "SELECT count(nick) AS total FROM comisiones WHERE nick = '$nick'";
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
