<?php
  require 'config.php';
  require 'mcrypt.php';
  error_reporting(E_ERROR); // Función oculta errores

  $idEncriptado = $_GET['u'];
  $idDescriptado = decrypt($idEncriptado,"ids");
  $idSeparado = explode(":",$idDescriptado);
  $idUser = intval($idSeparado[1]);
  if($idUser != 0)
  {
    $sentencia = $conexionMySQL->stmt_init();
    $sentencia->prepare("UPDATE usuarios SET activo = 1 WHERE idUsuario = ?");
    $sentencia->bind_param('i',$idUser);
    if(!$sentencia->execute())
    {
      $alerta = "error";
      $titulo = "Ups!";
      $mensaje = "Algo salió mal, no se activó su cuenta, póngase en contacto con servicio técnico";
    }
    else
    {
      $alerta = "success";
      $titulo = "Bien hecho!";
      $mensaje = "Se activó su cuenta";
    }
  }
  else
  {
    $alerta = "error";
    $titulo = "Ups!";
    $mensaje = "Algo salió mal, no se activó su cuenta";
  }
?>
<!DOCTYPE html> <!--HTML 5-->
<html> <!--Inicio de la página HTML-->
<head> <!--Se ponen los recursos que se utilizarán (como CSS o JS)-->
  <meta charset="UTF-8"> <!--Codificación al español-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Escala los elementos para cualquier dispositvo (celular,ordenador,etc) -->
  <title>Activación de cuenta</title> <!--Titulo de la pestaña-->
  <link rel="shortcut icon" href="images/logoRecyclus.png"> <!--icono de la pestaña-->
  <link rel="stylesheet" href="css/mainStyles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.3.2/sweetalert2.css">
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script><!--Biblioteca de funciones que simplifica el usor de JS-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.3.2/sweetalert2.js" charset="utf-8"></script>
</head>
<body>
</body>
<script type="text/javascript">
  swal(
  {
      type: '<?php echo $alerta ?>',
      title: '<?php echo $titulo ?>',
      html: '<?php echo $mensaje ?>',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Ok!'
  }).then(function ()
  {
    location.href = 'index.php';
  });
  $(document).click(function()
  {
    location.href = 'index.php';
  });
  $(document).keyup(function(e)
  {
      if (e.which == 27) //Si se da enter
      {
        location.href = 'index.php';
      }
  });
</script>
</html>
