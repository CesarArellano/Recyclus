<?php
  require 'config.php'; /*Si no tiene este archivo, no ejecuta nada*/
  header('Content-type: application/json; charset=utf-8'); // Se especifica el tipo de contenido a regresar al archivo JS, codificado en utf-8

  $email = $_POST['email'];
  $email = $conexionMySQL->real_escape_string($email);
  $password = $_POST['password'];
  $password = $conexionMySQL->real_escape_string($password);

  $sentencia = $conexionMySQL->stmt_init();
  $sentencia->prepare("SELECT idUsuario,idRol,password FROM usuarios WHERE email = ? AND activo = 1");
  $sentencia->bind_param('s',$email);
  $sentencia->execute();
  $resultado = $sentencia->get_result();
  $sentencia->close();
  if($resultado->num_rows == 1) //El correo está registrado
  {
    $campos = $resultado->fetch_assoc(); // Asigna un arreglo asociativo
    if(password_verify($password, $campos['password'])) //Verifica que la contraseña encriptada y la original sean iguales
    {
      $_SESSION['idUsuario'] = intval($campos['idUsuario']); // 1 (Variable obligatoria para identificar al usuario)
      $_SESSION['tipoUsuario'] = intval($campos['idRol']);
      if($_SESSION['tipoUsuario'] == 1)
        $respuesta = json_encode(array('mensaje' => "Bienvenido al sistema",'pagina' => "admin", 'alerta' => "success")); // Conversión de Array a JSON
      else
        $respuesta = json_encode(array('mensaje' => "Bienvenido al sistema",'pagina' => "user", 'alerta' => "success"));
      echo $respuesta;
    }
    else
    {
      echo json_encode(array('mensaje' => "Error, email y/o contraseña incorrectos",'pagina'=> "login", 'alerta' => "error"));
    }
  }
  else
  {
    echo json_encode(array('mensaje' => "Error, su cuenta de correo no está registrada o falta activar cuenta (revise su correo electrónico)", 'pagina' => "login", 'alerta' => "error"));
  }
  $conexionMySQL->close(); //Se cierra la conexión con la BD
?>
