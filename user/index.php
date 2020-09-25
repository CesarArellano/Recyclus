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
  <title>Inicio</title> <!--Titulo de la pestaña-->
  <link rel="shortcut icon" href="../images/logoRecyclus.png"> <!--icono de la pestaña-->
  <link rel="stylesheet" href="../css/userStyles.css">
  <link rel="stylesheet" href="../css/animate.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.3.2/sweetalert2.css">
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script><!--Biblioteca de funciones que simplifica el usor de JS-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.3.2/sweetalert2.js" charset="utf-8"></script>
  <script type="text/javascript" src="../js/userScript.js"></script>
</head>
<body>
  <nav class="nav-extended green darken-2 center">
    <div class="nav-wrapper">
      <img class="brand-logo center logoEncabezado" src="../images/logoRecyclus.png"/>
      <a href="#" data-activates="movil" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul id="nav-mobile" class="left hide-on-med-and-down">
        <li><a class="tooltipped" data-position="right" data-tooltip="" href="puntos.php" id="puntos">Puntos<i class="material-icons right">confirmation_number</i></a></li>
      </ul>
      <ul class="side-nav" id="movil">
        <li><a href="puntos.php" id="puntos2">Puntos<i class="material-icons right">confirmation_number</i></a></li>
      </ul>
    </div>
    <div class="nav-content">
      <ul class="tabs tabs-transparent">
        <li class="tab"><a class="active" href="#inicio">Inicio</a></li>
        <li class="tab"><a href="#contribuciones">Mis contribuciones</a></li>
        <li class="tab"><a href="#notificaciones">Notificaciones</a></li>
        <li class="tab"><a href="#cuenta">Mi cuenta</a></li>
      </ul>
    </div>
  </nav>
  <div class="container">
    <div id="inicio" class="col s12">
      <div class="animate__animated animate__fadeIn animate__delay-1s" id="formReciclar">
        <h2>Inicio</h2>
        <h3 class="center-align">¿Qué quieres reciclar hoy?</h3>
        <br>
        <div class="row">
          <div class="col l4 m4 s12">
            <div class="card hoverable">
              <div class="card-image waves-effect waves-block waves-light">
                <img class="activator" src="https://cdn.pixabay.com/photo/2017/08/10/03/48/nexus-2617873_1280.jpg" style='width: 100%; height: 200px; object-fit: cover;'>
              </div>
              <div class="card-content">
                <span class="card-title activator grey-text text-darken-4">Desecho electrónico<i class="material-icons right">more_vert</i></span>
                <center><button class="waves-effect waves-light btn blue" onclick="formDevices()" id="buttonDevices">Presiona aquí<i class="material-icons right">devices</i></button></center>
              </div>
              <div class="card-reveal">
                <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i>Información</span>
                <p>Ganas más puntos según gama, marca y tiempo de uso de tu dispositivo.</p>
              </div>
            </div>
          </div>
          <div class="col l4 m4 s12">
            <div class="card hoverable">
              <div class="card-image waves-effect waves-block waves-light">
                <img class="activator" src="https://fotografias-compromiso.atresmedia.com/clipping/cmsimages01/2017/01/05/53F06CDA-E08D-4829-A43E-098656466EED/58.jpg" style='width: 100%; height: 200px; object-fit: cover;'>
              </div>
              <div class="card-content">
                <span class="card-title activator grey-text text-darken-4">Desecho Orgánico<i class="material-icons right">more_vert</i></span>
                <center><button class="waves-effect waves-light btn green darken-1" onclick="formDO()" id="buttonDO">Presiona aquí<i class="material-icons right">kitchen</i></button></center>
              </div>
              <div class="card-reveal">
                <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i>Información</span>
                <p>Serán medidos por kilogramo, y dependiendo del peso, más puntos.</p>
              </div>
            </div>
          </div>
          <div class="col l4 m4 s12">
            <div class="card hoverable">
              <div class="card-image waves-effect waves-block waves-light">
                <img class="activator" src="https://www.ecoticias.com/userfiles/extra/WZZS_200_.jpg" style='width: 100%; height: 200px; object-fit: cover;'>
              </div>
              <div class="card-content">
                <span class="card-title activator grey-text text-darken-4">Desecho Inórganico<i class="material-icons right">more_vert</i></span>
                <center><button class="waves-effect waves-light btn grey darken-2" onclick="formDI()" id="buttonDI">Presiona aquí<i class="material-icons right">delete_sweep</i></button></center>
              </div>
              <div class="card-reveal">
                <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i>Información</span>
                <p>A los desechos plásticos, de papel/cartón, y vidrio, separados por tipo y vendidos por cantidad.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="mapa">
      <h2 class="center-align">Puntos de reciclaje cercanos</h2>
      <div id="map"></div>
      </div>
      <div class="animate__animated animate__fadeIn animate__delay-1s" id="formDevices">
        <h2>Dispositivos</h2>
        <div class="col s12">
          <div class="card hoverable card-opacity animate__animated animate__fadeIn animate__delay-1s"> <!--Tarjeta que contiene los inputs-->
            <form id="formNewDevice">
            <div class="card-content">
              <div class="row">
                <div class="input-field col l4 m4 s12">
                  <i class="material-icons prefix">add_location</i>
                  <select name="puntoReciclaje" required>
                    <option value="" selected>Escoge una opción.</option>
                    <option value="Lugar 1">Lugar 1</option>
                    <option value="Lugar 2">Lugar 2</option>
                    <option value="Lugar 3">Lugar 3</option>
                    <option value="Lugar 4">Lugar 4</option>
                    <option value="Lugar 5">Lugar 5</option>
                  </select>
                  <label>¿Dónde quiere entregarlo</label>
                </div>
                <div class="input-field col l4 m4 s12">
                  <i class="material-icons prefix">devices</i>
                  <select name="tipoDispositivo" required>
                    <option value="" selected>Escoge una opción.</option>
                    <option value="Computadora">Computadora</option>
                    <option value="Teléfono">Teléfono</option>
                    <option value="Tableta">Tableta</option>
                  </select>
                  <label>Tipo de dispositvo</label>
                </div>
                <div class="input-field col l4 m4 s12">
                  <i class="material-icons prefix">phone_android</i>
                  <input type="text" class="validate" name="nombreDispositivo" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð0-9 ]{2,50}"  maxlength="50" required>
                  <label for="nombreDispositivo" data-error="Ingrese caracteres alfabéticos" data-success="Correcto">Nombre del dispositivo</label>
                </div>
                <div class="input-field col l4 m4 s12">
                  <i class="material-icons prefix">bookmark</i>
                  <select name="marcaDispositivo" required>
                    <option value="" selected>Escoge una opción.</option>
                    <option value="Apple">Apple</option>
                    <option value="Samsung">Samsung</option>
                    <option value="Xiaomi">Xiaomi</option>
                    <option value="Huawei">Huawei</option>
                    <option value="Motorola">Motorola</option>
                  </select>
                  <label>Marca del dispositvo</label>
                </div>
                <div class="input-field col l4 m4 s12">
                  <i class="material-icons prefix">clear_all</i>
                  <select name="gamaDispositivo" required>
                    <option value="" selected>Escoge una opción.</option>
                    <option value="Alta">Alta</option>
                    <option value="Media">Media</option>
                    <option value="Baja">Baja</option>
                  </select>
                  <label>Gama del dispositvo</label>
                </div>
                <div class="input-field col l4 m4 s12">
                  <i class="material-icons prefix">all_inclusive</i>
                  <select name="tiempoUso" required>
                    <option value="" selected>Escoge una opción.</option>
                    <option value="1">1 Año</option>
                    <option value="2">2 Años</option>
                    <option value="3">3 Años</option>
                    <option value="4">4 Años</option>
                    <option value="5">5 Años</option>
                  </select>
                  <label>Tiempo de uso</label>
                </div>
                <div class="input-field col l12 m12 s12">
                  <i class="material-icons prefix">speaker_notes</i>
                  <textarea name="descripcionDispositivo" class="materialize-textarea validate" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð0-9 ]{2,50}"  maxlength="300" data-length="300" required></textarea>
                  <label for="descripcionDispositivo">Descripción del dispositvo</label>
                </div>
              </div>
            </div>
            <div class="card-action center-align">
                <button class="btn-flat grey-text waves-effect" type="reset" style="margin: 10px"> Limpiar Campos</button>
                <button type="submit" class="btn waves-effect waves-light blue darken-2" style="margin: 10px">Enviar contribución
                  <i class="material-icons right">send</i>
                </button>
              </div>
            </form>
          </div>
        </div>
        <center>
          <button class="btn waves-effect waves-light cyan" onclick="mostrarInicio()">Regresar<i class="material-icons left">arrow_back</i></button>
        </center>
      </div>
      <div id="formDO">
        <h2>Desechos Orgánicos</h2>
        <div class="col s12">
          <div class="card hoverable card-opacity animate__animated animate__fadeIn animate__delay-1s"> <!--Tarjeta que contiene los inputs-->
            <form id="formNewDO">
            <div class="card-content">
              <div class="row">
                <div class="input-field col l4 m4 s12">
                  <i class="material-icons prefix">add_location</i>
                  <select name="puntoReciclaje" required>
                    <option value="" selected>Escoge una opción.</option>
                    <option value="Lugar 1">Lugar 1</option>
                    <option value="Lugar 2">Lugar 2</option>
                    <option value="Lugar 3">Lugar 3</option>
                    <option value="Lugar 4">Lugar 4</option>
                    <option value="Lugar 5">Lugar 5</option>
                  </select>
                  <label>¿Dónde quiere entregarlo</label>
                </div>
                <div class="input-field col l4 m4 s12">
                  <i class="material-icons prefix">select_all</i>
                  <select name="tipoProducto" required>
                    <option value="" selected>Escoge una opción.</option>
                    <option value="Frutas">Frutas</option>
                    <option value="Verduras">Verduras</option>
                  </select>
                  <label>Tipo de producto</label>
                </div>
                <div class="input-field col l4 m4 s12">
                  <i class="material-icons prefix">vertical_align_bottom</i>
                  <input type="text" class="validate" name="pesoProducto" pattern="[0-9.]{2,50}"  maxlength="10" required>
                  <label for="pesoProducto" data-error="Ingrese digitos" data-success="Correcto">Peso en KG</label>
                </div>
                <input type="hidden" name="tipoDesecho" value="Orgánico">
              </div>
            </div>
            <div class="card-action center-align">
                <button class="btn-flat grey-text waves-effect" type="reset" style="margin: 10px"> Limpiar Campos</button>
                <button type="submit" class="btn waves-effect waves-light blue darken-2" style="margin: 10px">Enviar contribución
                  <i class="material-icons right">send</i>
                </button>
              </div>
            </form>
          </div>
        </div>
        <center>
          <button class="btn waves-effect waves-light cyan" onclick="mostrarInicio()">Regresar<i class="material-icons left">arrow_back</i></button>
        </center>
      </div>
      <div id="formDI">
        <h2>Desechos Inorgánicos</h2>
        <div class="col s12">
          <div class="card hoverable card-opacity animate__animated animate__fadeIn animate__delay-1s"> <!--Tarjeta que contiene los inputs-->
            <form id="formNewDI">
            <div class="card-content">
              <div class="row">
                <div class="input-field col l4 m4 s12">
                  <i class="material-icons prefix">add_location</i>
                  <select name="puntoReciclaje" required>
                    <option value="" selected>Escoge una opción.</option>
                    <option value="Lugar 1">Lugar 1</option>
                    <option value="Lugar 2">Lugar 2</option>
                    <option value="Lugar 3">Lugar 3</option>
                    <option value="Lugar 4">Lugar 4</option>
                    <option value="Lugar 5">Lugar 5</option>
                  </select>
                  <label>¿Dónde quiere entregarlo</label>
                </div>
                <div class="input-field col l4 m4 s12">
                  <i class="material-icons prefix">select_all</i>
                  <select name="tipoProducto" required>
                    <option value="" selected>Escoge una opción.</option>
                    <option value="Plástico">Plástico</option>
                    <option value="Vidrio">Vidrio</option>
                    <option value="Cartón">Cartón</option>
                  </select>
                  <label>Tipo de producto</label>
                </div>
                <div class="input-field col l4 m4 s12">
                  <i class="material-icons prefix">vertical_align_bottom</i>
                  <input type="text" class="validate" name="pesoProducto" pattern="[0-9.]{2,50}"  maxlength="10" required>
                  <label for="pesoProducto" data-error="Ingrese digitos" data-success="Correcto">Peso en KG</label>
                </div>
                <input type="hidden" name="tipoDesecho" value="Inorgánico">
              </div>
            </div>
            <div class="card-action center-align">
                <button class="btn-flat grey-text waves-effect" type="reset" style="margin: 10px"> Limpiar Campos</button>
                <button type="submit" class="btn waves-effect waves-light blue darken-2" style="margin: 10px">Enviar contribución
                  <i class="material-icons right">send</i>
                </button>
              </div>
            </form>
          </div>
        </div>
        <center>
          <button class="btn waves-effect waves-light cyan" onclick="mostrarInicio()">Regresar<i class="material-icons left">arrow_back</i></button>
        </center>
      </div>
      <div id="mensajeDireccion"></div>
    </div>
    <div id="contribuciones" class="col s12">
      <h2>Contribuciones</h2>
      <div class="row">
        <div class="col l6 m6 s12">
          <h4>Tecnológicos</h4>
          <div id="contribucionesT"></div>
        </div>
        <div class="col l6 m6 s12">
          <h4>Desechos</h4>
          <div id="contribucionesD"></div>
        </div>
      </div>
    </div>
    <div id="notificaciones" class="col s12">
      <h2>Notificaciones</h2>
      <div id="contenidoNotificaciones"></div>
    </div>
    <div id="cuenta" class="col s12">
      <h2>Mi cuenta</h2>
      <br>
      <div class="row">
        <div class="col l6 m12 s12">
          <center>
            <img src="../images/avatar.png" height="150px">
            <div id="nombre"></div>
            <a href="../logOut.php" class="waves-effect waves-light btn red"><i class="material-icons left">exit_to_app</i>Cerrar sesión</a>
          </center>
        </div>
        <div class="col l6 m12 s12">
          <div class="row">
              <div class="card-panel hoverable">
                <div id="datosPersonales"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../js/mapScript.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDaeWicvigtP9xPv919E-RNoxfvC-Hqik&callback=iniciarMap"></script>
</body>
</html>
