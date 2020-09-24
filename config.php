<?php
  $conexionMySQL = new mysqli('localhost', 'ic19cav', "208192", "ic19cav"); //Variable que te permite el acceso a la BD
  if($conexionMySQL->connect_error)
  {
    echo "Error, no se pudo conectar a la BD";
    exit();
  }
  /* cambiar el conjunto de caracteres a utf8 */
  if(!$conexionMySQL->set_charset("utf8"))
  {
    printf("Error cargando el conjunto de caracteres utf8: %s\n", $conexionMySQL->error);
    exit();
  }
  session_start(); //Esta función inicializa variables de sesiones (crear, usar o destruir);
?>
