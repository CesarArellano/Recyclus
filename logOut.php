<?php
  session_start(); //incialeremos las variables de sesión
  $_SESSION = array();
  session_destroy(); // Destruye las variables de sesión.
  header("location: index.php"); // Redirige a index.php
?>
