<?php
  require '../config.php';
  if(!isset($_SESSION['idUsuario']) || $_SESSION['tipoUsuario'] == 2) //isset comprueba si la variable no existe
  {
    header('location: ../index.php'); //header redirecciona a una página (no deja entrar a la página)
  }
  $sentencia = $conexionMySQL->stmt_init();
  $sentencia->prepare("SELECT nombreUsuario,apPaternoUsuario,apMaternoUsuario,telefonoUsuario, email FROM usuarios WHERE idUsuario = ?");
  $sentencia->bind_param('s',$_SESSION['idUsuario']);
  $sentencia->execute();
  $resultado = $sentencia->get_result();
  $sentencia->close();
  $campos = $resultado->fetch_assoc();
?>
<!DOCTYPE html> <!--HTML 5-->
<html> <!--Inicio de la página HTML-->
<head> <!--Se ponen los recursos que se utilizarán (como CSS o JS)-->
  <meta charset="UTF-8"> <!--Codificación al español-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Escala los elementos para cualquier dispositvo (celular,ordenador,etc) -->
  <title>Inicio</title> <!--Titulo de la pestaña-->
  <link rel="shortcut icon" href="../images/logoRecyclus.png"> <!--icono de la pestaña-->
  <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/adminStyles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.3.2/sweetalert2.css">
  <link rel="stylesheet" href="../css/animate.min.css"/>
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script><!--Biblioteca de funciones que simplifica el usor de JS-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.3.2/sweetalert2.js" charset="utf-8"></script>
  <script type="text/javascript" src="../js/adminScript.js"></script>
</head>
<body>
  <main>
    <nav class="blue darken-4">
      <div class="nav-wrapper">
  			<img src="../images/logoRecyclus.png" class="brand-logo center" height="50px" id="logoNav">
  			<a href="#" id="activar" data-activates="movil" class="button-collapse"><i class="material-icons">menu</i></a>
  		</div>
  	</nav>
    <div class="margen">
      <div id="inicioContenido">
        <br>
        <div class="row">
          <div class="col s12">
            <div class="card hoverable z-depth-2 animate__animated animate__fadeIn">
              <div class="card-content">
                <span class="card-title center"><h3><b>Instructivo</b></h3></span>
                <div class="flow-text">
                  <ul class="collection with-header">
                    <li class="collection-header">
                      <h6 align="justify"><b>Dentro de este apartado te ofrecemos una breve explicación de lo que puedes hacer en cada uno de los apartados del sistema.</b></h6>
                    </li>
                    <li class="collection-item">
                      <h6 align="justify"><b>Estadísticas: </b>---</h6>
                    </li>
                    <li class="collection-item">
                      <h6 align="justify"><b>Agregar: </b>En este apartado se podrán registrar administradores.</h6>
                    </li>
                    <li class="collection-item">
                      <h6 align="justify"><b>Búsqueda: </b> ---- </h6>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="estadisticasContenido">
        <h2>Estadísticas</h2>
      </div>
      <div id="agregarUsuarioContenido">
        <div class="row"> <!--Habilita sistema de rejilla (12 columnas) Elemento Padre / Principal-->
          <br>
          <div class="card hoverable col s12 card-opacity animate__animated animate__bounceInLeft"> <!--Tarjeta que contiene los inputs-->
            <h2 class="center-align">Registro usuarios</h2>
            <form method="POST" id="formUsers">
            <div class="card-content"> <!--Contenido de la tarjeta-->
              <div class="row"> <!--Habilita sistema de rejilla (12 columnas) Elementos hijo / secundarios-->
                <div class="input-field col l6 m6 s12">
                  <i class="material-icons prefix">account_circle</i>
                  <input type="text" class="validate" name="nombreUsuario" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ]{2,50}"  maxlength="50" required>
                  <label for="nombreUsuario">Ingrese su(s) nombre(s)</label>
                </div>
                <div class="input-field col l6 m6 s12">
                  <i class="material-icons prefix">account_circle</i>
                  <input type="text" class="validate" name="apPaternoUsuario" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ]{2,50}"  maxlength="50" required>
                  <label for="apPaternoUsuario">Ingrese su apellido paterno</label>
                </div>
                <div class="input-field col l6 m6 s12">
                  <i class="material-icons prefix">account_circle</i>
                  <input type="text" class="validate" name="apMaternoUsuario" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ]{2,50}"  maxlength="50" required>
                  <label for="apMaternoUsuario">Ingrese su apellido materno</label>
                </div>
                <div class="input-field col l6 m6 s12">
                  <i class="material-icons prefix">phone</i>
                  <input type="tel" class="validate" name="telefono" pattern="[0-9+]{1,14}"  maxlength="14" required>
                  <label for="icon_telephone">Ingrese su teléfono</label>
                </div>
                <div class="input-field col l6 m6 s12">
                  <i class="material-icons prefix">email</i>
                  <input type="email" class="validate" name="email" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,60}" maxlength="60" required>
                  <label for="email">Ingrese su email</label>
                </div>
                <div class="input-field col l6 m6 s12">
                  <i class="material-icons prefix">lock</i>
                  <input type="password" class="validate" id="password" name="password" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" minlength="8" maxlength="32" required>
                  <label for="password" data-success="Contraseña válida">Ingrese su contraseña</label>
                </div>
                <div class="input-field col l6 m6 s12">
                  <i class="material-icons prefix">lock</i>
                  <input type="password" class="validate" id="password2" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" minlength="8" maxlength="32" required>
                  <label for="password2">Repita su contraseña</label>
                </div>
              </div>
            </div>
            <div class="card-action center-align">
              <button class="btn-flat grey-text waves-effect" type="reset" style="margin: 10px"> Limpiar Campos</button>
              <button type="submit" class="btn waves-effect waves-light blue darken-2" style="margin: 10px">Registrarse
                <i class="material-icons right">send</i>
              </button>
            </div>
            </form>
          </div>
        </div>
      </div>

      <div id="busquedaUsuarioContenido">
        <h2 class="center-align">Búsqueda usuarios</h2>
        <div class="row">
          <div class="col s12">
            <div class="input-field">
              <i class="material-icons prefix">search</i>
              <input type="text" class="validate" id="inputBusquedaUsuarios">
              <label for="inputBusquedaUsuarios">Ingrese nombre del usuario</label>
            </div>
            <div id="resultadoBusquedaUsuarios"></div>
          </div>
        </div>
      </div>
      <div id="busquedaContribucionesTContenido">
        <h3 class="center-align">Búsqueda contribuciones tecnológicas</h3>
        <div class="row">
          <div class="col s12">
            <div class="input-field">
              <i class="material-icons prefix">search</i>
              <input type="text" class="validate" id="inputBusquedaContribucionesT">
              <label for="inputBusquedaContribucionesT">Ingrese nombre del usuario</label>
            </div>
            <div id="resultadoBusquedaContribucionesT"></div>
          </div>
        </div>
      </div>
      <div id="busquedaContribucionesDContenido">
        <h3 class="center-align">Búsqueda contribuciones desechos</h3>
        <div class="row">
          <div class="col s12">
            <div class="input-field">
              <i class="material-icons prefix">search</i>
              <input type="text" class="validate" id="inputBusquedaContribucionesD">
              <label for="inputBusquedaContribucionesD">Ingrese nombre del usuario</label>
            </div>
            <div id="resultadoBusquedaContribucionesD"></div>
          </div>
        </div>
      </div>

    </div>
    <div id="admin"></div>
    <ul id="movil" class="side-nav fixed">
      <li>
  			<div class="user-view">
  				<div class="background">
  			    	<img src="../images/background.png">
  				</div>
  				<a><img src="../images/avatar.png" style="width:40%;object-fit:cover;position:relative; top:15px;"></a>
          <br>
  				<a><span class="white-text"><?php echo $campos['nombreUsuario']." ".$campos['apPaternoUsuario'];?></span></a>
          <br>
        </div>
  		</li>
      <li><a id="selectInicio" href="#"><i class="material-icons">home</i>Inicio</a></li>
      <li><a id="selectEstadisticas" href="#"><i class="material-icons">insert_chart</i>Estadísticas</a></li>
      <li><div class="divider"></div></li>
      <li class="no-padding">
        <ul class="collapsible collapsible-accordion">
          <li>
            <a class="collapsible-header">Agregar<i class="material-icons">add</i></a>
            <div class="collapsible-body">
              <ul>
                <li><a id="selectNuevoUsuario" href="#"><i class="material-icons">person_add</i>Nuevo usuario</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </li>
      <li class="no-padding">
        <ul class="collapsible collapsible-accordion">
          <li>
            <a class="collapsible-header">Búsqueda<i class="material-icons">search</i></a>
            <div class="collapsible-body">
              <ul>
                <li><a id="selectBusquedaUsuario" href="#!"><i class="material-icons">account_box</i>Usuarios</a></li>
                <li><a id="selectBusquedaContribucionesT" href="#!"><i class="material-icons">local_mall</i>Contribuciones T</a></li>
                <li><a id="selectBusquedaContribucionesD" href="#!"><i class="material-icons">local_mall</i>Contribuciones D</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </li>
      <li><div class="divider"></div></li>
      <li><a href="../logOut.php"><i class="material-icons">exit_to_app</i>Salir del sistema</a></li>
		  <li><div class="divider"></div></li>
		  <center>
			   <p><i class="material-icons">settings</i></p><p>ADMINISTRADOR</p>
		  </center>
    </ul>
  </main>
</body>
</html>
