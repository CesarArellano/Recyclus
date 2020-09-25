<?php
  require '../config.php';
  if(!isset($_SESSION['tipoUsuario']) || $_SESSION['tipoUsuario'] == 1) //isset comprueba si la variable no existe
  {
    header('location: ../index.php'); //header redirecciona a una página (no deja entrar a la página)
  }
?>

<!DOCTYPE html> <!--HTML 5-->
<html> <!--Inicio de la página HTML-->
<head> <!--Se ponen los recursos que se utilizarán (como CSS o JS)-->
  <meta charset="UTF-8"> <!--Codificación al español-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Escala los elementos para cualquier dispositvo (celular,ordenador,etc) -->
  <title>Nueva Dirección</title> <!--Titulo de la pestaña-->
  <link rel="shortcut icon" href="../images/logoRecyclus.png"> <!--icono de la pestaña-->
  <link rel="stylesheet" href="../css/userStyles.css">
  <link rel="stylesheet" href="../css/materialize.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.3.2/sweetalert2.css">
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script><!--Biblioteca de funciones que simplifica el usor de JS-->
  <script src="../js/materialize.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.3.2/sweetalert2.js" charset="utf-8"></script>
</head>
<body>
  <nav>
    <div class="nav-wrapper green darken-2">
      <img class="brand-logo center logoEncabezado" src="../images/logoRecyclus.png"/>
      <a href="#" data-activates="movil" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul class="left hide-on-med-and-down">
        <li><a href="index.php">Menú principal</a></li>
        <li><a class="tooltipped" data-position="right" data-tooltip="" href="puntos.php" id="puntos">Puntos<i class="material-icons right">confirmation_number</i></a></li>
      </ul>
      <ul class="side-nav" id="movil">
        <li><a href="index.php">Menú principal</a></li>
        <li><a href="puntos.php" id="puntos2">Puntos<i class="material-icons right">confirmation_number</i></a></li>
      </ul>
    </div>
  </nav>
  <div class="container">
    <h1>Nueva dirección de usuario</h1>
    <br>
    <div>
      <div class="row"> <!--Habilita sistema de rejilla (12 columnas) Elemento Padre / Principal-->
        <div class="col s12">
          <div class="card hoverable card-opacity animate__animated animate__fadeIn animate__delay-2s"> <!--Tarjeta que contiene los inputs-->
            <form id="formAddress">
            <div class="card-content">
              <div class="row">
                <div class="input-field col l4 m6 s12">
                  <i class="material-icons prefix">pin_drop</i>
                  <input type="text" class="validate" id="inputPais" name="inputPais" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ]{2,80}"  maxlength="80"required>
                  <label for="inputPais" data-error="Ingrese caracteres alfabéticos" data-success="Correcto">País</label>
                </div>
                <div class="input-field col l4 m6 s12">
                  <i class="material-icons prefix">map</i>
                  <input type="text" class="validate" id="inputEstado" name="inputEstado" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ]{2,50}"  maxlength="50" required>
                  <label for="inputEstado" data-error="Ingrese caracteres alfabéticos" data-success="Correcto">Estado</label>
                </div>
                <div class="input-field col l4 m6 s12">
                  <i class="material-icons prefix">location_city</i>
                  <input type="text" class="validate" id="inputDelegacionMunicipio" name="inputDelegacionMunicipio" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ]{2,50}"  maxlength="50" required>
                  <label for="inputDelegacionMunicipio" data-error="Ingrese caracteres alfabéticos" data-success="Correcto">Delegación o municipio</label>
                </div>
                <div class="input-field col l4 m6 s12">
                  <i class="material-icons prefix">location_on</i>
                  <input type="text" class="validate" id="inputColonia" name="inputColonia" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð0-9 ]{2,50}"  maxlength="50" required>
                  <label for="inputColonia" data-error="Ingrese caracteres alfabéticos" data-success="Correcto">Colonia</label>
                </div>
                <div class="input-field col l4 m6 s12">
                  <i class="material-icons prefix">directions</i>
                  <input type="text" class="validate" id="inputCalle" name="inputCalle" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð0-9 ]{2,50}"  maxlength="50" required>
                  <label for="inputCalle" data-error="Ingrese caracteres alfabéticos" data-success="Correcto">Calle</label>
                </div>
                <div class="input-field col l4 m6 s12">
                  <i class="material-icons prefix">local_post_office</i>
                  <input type="text" class="validate" id="inputCodigoPostal" name="inputCodigoPostal" pattern="[0-9]{2,7}"  maxlength="7" required>
                  <label for="inputCodigoPostal" data-error="Ingrese dígitos" data-success="Correcto">Código postal</label>
                </div>
                <div class="input-field col l6 m6 s12">
                  <i class="material-icons prefix">explore</i>
                  <input type="text" class="validate" name="latitud" pattern="[0-9.]{2,10}"required>
                  <label for="latitud" data-error="Ingrese dígitos" data-success="Correcto">Latitud</label>
                </div>
                <div class="input-field col l6 m6 s12">
                  <i class="material-icons prefix">explore</i>
                  <input type="text" class="validate" name="longitud" pattern="[0-9.-]{2,10}" required>
                  <label for="longitud" data-error="Ingrese dígitos" data-success="Correcto">Longitud</label>
                </div>
              </div>
            </div>
            <div class="card-action center-align">
                <button class="btn-flat grey-text waves-effect" type="reset" style="margin: 10px"> Limpiar Campos</button>
                <button type="submit" class="btn waves-effect waves-light blue darken-2" id="botonSubmit" style="margin: 10px">Agregar dirección
                  <i class="material-icons right">send</i>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../js/addressScript.js"></script>
</body>
</html>
