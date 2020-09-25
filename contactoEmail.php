<?php
  require('config.php');

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  require 'PHPMailer/Exception.php';
  require 'PHPMailer/PHPMailer.php';
  require 'PHPMailer/SMTP.php';

  header('Content-type: application/json; charset=utf-8'); // Se especifica el tipo de contenido a regresar al archivo JS, codificado en utf-8

  $nombreCliente = $_POST['nombreCliente'];
  $nombreCliente = $conexionMySQL->real_escape_string($nombreCliente);
  $telefonoCliente = $_POST['telefonoCliente'];
  $telefonoCliente = $conexionMySQL->real_escape_string($telefonoCliente);
  $emailCliente = $_POST['emailCliente'];
  $emailCliente = $conexionMySQL->real_escape_string($emailCliente);
  $asunto = $_POST['asunto'];
  $asunto = $conexionMySQL->real_escape_string($asunto);
  $mensaje = $_POST['mensaje'];
  $mensaje = $conexionMySQL->real_escape_string($mensaje);

  $sentencia = $conexionMySQL->stmt_init();
  $sentencia->prepare("INSERT INTO contactoClientes(nombreCliente,telefonoCliente,emailCliente,asunto,mensaje,fechaContacto) VALUES(?,?,?,?,?,NOW())");
  $sentencia->bind_param('sssss',$nombreCliente,$telefonoCliente,$emailCliente,$asunto,$mensaje);
  if(!$sentencia->execute()){
    echo json_encode(array('mensaje' => "Error, al procesar la información, intente de nuevo", 'pagina' => "contacto",'alerta' => "error"));
  }
  else{
    $mail = new PHPMailer(true);
      try
      {
        //Configuracion del servidor
        $mail->SMTPDebug = 0;                                       // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'recyclus2020@gmail.com';               // SMTP username
        $mail->Password   = 'recyclus2020**';                          // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        //Usuarios
        $mail->setFrom('recyclus2020@gmail.com', 'Recyclus ¿Que Quieres reciclar Hoy?');
        $mail->addAddress($emailCliente);
        // Content
        $mail->isHTML(true);                                        // Set email format to HTML
        $mail->Subject = 'Contacto Recyclus';
        $mail->Body = "<html><body><span>Hola $nombreCliente</span><br><span>¡Tu solicitud se procesó con éxito!</span><br>
        <span>En breve atenderemos tu solicitud, mientras puede visitar nuestro sitio web --> </span><a href='http://antares.dci.uia.mx/ic19cav/Recyclus/registro.php' target='_blank'>Da click aquí</a></body>
        </html>";
        // Activo codificacción utf-8
        $mail->CharSet = 'UTF-8';
        $mail->send();
        echo json_encode(array('mensaje' => "Se procesó con éxito tu solicitud, te mandamos un correo electrónico para confirmar la solicitud (Si no aparece en tu bandeja de entrada, revisa en el spam)", 'pagina' => "index",'alerta' => "success"));
      }catch (Exception $e)
      {
        echo json_encode(array('mensaje' => "<p class='flow-text'>Error, al procesar tu solicitud, contacte vía Whatsapp:<p><a class='flow-text' href='https://api.whatsapp.com/send?phone=525541294515&text=Hola%20buenas,%20quiero%20solicitar%20informaci%C3%B3n.' target='_blank'>Da click aquí</a>", 'pagina' => "contacto",'alerta' => "error"));
      }
  }
  $sentencia->close();
  $conexionMySQL->close();
?>
