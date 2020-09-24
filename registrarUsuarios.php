<?php
  require 'config.php'; /* Si no tiene este archivo, no ejecuta nada*/
  require 'mcrypt.php'; /*Archivo para encriptar y desencriptar los ID de usuarios*/
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  require '../PHPMailer/Exception.php';
  require '../PHPMailer/PHPMailer.php';
  require '../PHPMailer/SMTP.php';

  header('Content-type: application/json; charset=utf-8'); // Se especifica el tipo de contenido a regresar al archivo JS, codificado en utf-8

  $nombreCliente = $_POST['nombreCliente'];
  $nombreCliente = $conexionMySQL->real_escape_string($nombreCliente); // Añade el caracter de escape \ si encuentra una cadena que inteta hacer inyección SQL, si no la deja tal cual
  $apPaternoCliente = $_POST['apPaternoCliente'];
  $apPaternoCliente = $conexionMySQL->real_escape_string($apPaternoCliente);
  $apMaternoCliente = $_POST['apMaternoCliente'];
  $apMaternoCliente = $conexionMySQL->real_escape_string($apMaternoCliente);
  $telefono = $_POST['telefono'];
  $telefono = $conexionMySQL->real_escape_string($telefono);
  $email = $_POST['email'];
  $email = $conexionMySQL->real_escape_string($email);
  $password = $_POST['password'];
  $password = $conexionMySQL->real_escape_string($password);
  $enc_password = password_hash($password,PASSWORD_DEFAULT); //Encriptar la contraseña (ocupa sha512 y lo ocupa 10 veces)
  $sentencia = $conexionMySQL->stmt_init();
  $sentencia->prepare("SELECT * FROM usuarios WHERE email = ?");
  $sentencia->bind_param('s',$email);
  $sentencia->execute();
  $resultado = $sentencia->get_result();
  $sentencia->close();
  if($resultado->num_rows == 1) //Si un correo ya está registrado
  {
    echo json_encode(array('mensaje' => "Error, usted ya se encuentra registrado", 'pagina' => "registro",'alerta' => "error"));
  }
  else
  {
    $sentencia = $conexionMySQL->stmt_init(); // Este método indica que la variable podra ocupar las siguientes consultas preparadas, retorna un objeto
    if(!$sentencia->prepare("INSERT INTO usuarios(nombreUsuario, apPaternoUsuario, apMaternoUsuario, email, password, telefono, estado, idCategoriaCliente, idRol) VALUES(?,?,?,?,?,?,0,1,3)"))
    {
      echo json_encode(array('mensaje' => "Error, al procesar la información al preparar", 'pagina' => "registro",'alerta' => "error"));
    }
    $sentencia->bind_param('ssssss',$nombreCliente,$apPaternoCliente,$apMaternoCliente,$email,$enc_password,$telefono); //Función que rellena los variables con la información del usuario. la password ya se pasa encriptada
    if(!$sentencia->execute()) //Función que ejecuta los comandos anteriores en la base de datos
    {
      echo json_encode(array('mensaje' => "Error, al procesar la información al ejecutar", 'pagina' => "registro",'alerta' => "error"));
    }
    else
    {
      $idUser = $conexionMySQL->insert_id;
      $idEncriptado = encrypt("dato:$idUser","ids");
      $mail = new PHPMailer(true);
      try
      {
        //Configuracion del servidor
        $mail->SMTPDebug = 0;                                       // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'vendokosasmx@gmail.com';               // SMTP username
        $mail->Password   = 'ecommerce$1';                          // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        //Usuarios
        $mail->setFrom('vendokosasmx@gmail.com', 'E-commerce Vendo Kosas MX');
        $mail->addAddress($email);
        // Content
        $mail->isHTML(true);                                        // Set email format to HTML
        $mail->Subject = 'Registro exitoso en Vendo Kosas MX';
        $mail->Body = "<html><body><span>Hola $nombreCliente</span><br><span>¡Te registraste con éxito!</span><br>
        <span>Activa tu cuenta, desde este enlace --> </span><a href='https://www.cesararellano.ml/ecommerce/activarCuenta.php?u=$idEncriptado' target='_blank'>Activar cuenta</a></body>
        </html>"; // Se pasa por método GET el parámetro u que es idUser;
        // Activo codificacción utf-8
        $mail->CharSet = 'UTF-8';
        $mail->send();
        echo json_encode(array('mensaje' => "Te registraste con éxito, te mandamos un correo electrónico para poder activar tu cuenta", 'pagina' => "index",'alerta' => "success"));
      }catch (Exception $e)
      {
        echo json_encode(array('mensaje' => "Error, al enviar correo electrónico", 'pagina' => "registro",'alerta' => "error"));
      }
    }
    $sentencia->close();
  }
  $conexionMySQL->close(); //Se cierra la conexión con la BD
?>
