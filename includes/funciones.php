<?php
  $conn = new mysqli('url', 'name', 'pass', 'database');

  if ($conn->connect_error) {
    echo $error -> $conn->connect_error;
  }
?>
