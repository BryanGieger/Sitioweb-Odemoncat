<?php
function nuevaNoti($titulo, $texto, $icono, $url){
  try {
    $stmt = $conn->prepare("INSERT INTO notificaciones (titulo_noti, msg_noti, icon_noti, url_noti) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $titulo, $texto, $icono, $url);
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

?>
