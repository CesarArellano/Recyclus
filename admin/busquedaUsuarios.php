<?php
  require '../config.php';
  $salida = "";
  //Obtiene usuarios
  $query = "SELECT idUsuario, nombreUsuario, apPaternoUsuario, apMaternoUsuario, email, telefonoUsuario, nombreRol FROM usuarios LEFT JOIN roles USING (idRol)";
  if (isset($_POST['consulta']))
  {
    $texto = $_POST['consulta']; // Sanitiza variable del input
    $texto = $conexionMySQL->real_escape_string($texto);
    $query = "SELECT idUsuario, nombreUsuario, apPaternoUsuario, apMaternoUsuario, email, telefonoUsuario, nombreRol FROM usuarios LEFT JOIN roles USING (idRol) WHERE nombreUsuario LIKE '%".$texto."%' OR apPaternoUsuario LIKE '%".$texto."%' OR apMaternoUsuario LIKE '%".$texto."%' OR email LIKE '%".$texto."%' OR telefonoUsuario LIKE '%".$texto."%'  OR nombreRol LIKE '%".$texto."%'";
  }
  $sentencia = $conexionMySQL->query($query);
  $numeroFilas = $sentencia->num_rows;
  if ($numeroFilas > 0) // Si hay resultados los muestra como tabla
  {
    $salida.= "<table class='responsive-table highlight centered'>
      <thead>
       <th>Nombre</th>
       <th>Apellido Paterno</th>
       <th>Apellido Materno</th>
       <th>Email</th>
       <th>Teléfono</th>
       <th>Tipo de usuario</th>
      </thead>
      <tbody>";
      while ($row = $sentencia->fetch_assoc())
      {
        $salida.= "<tr>
          <td>".$row['nombreUsuario']."</td>
          <td>".$row['apPaternoUsuario']."</td>
          <td>".$row['apMaternoUsuario']."</td>
          <td>".$row['email']."</td>
          <td>".$row['telefonoUsuario']."</td>
          <td>".$row['nombreRol']."</td>
          <td><a href='modificarUsuarios.php?id=".$row['idUsuario']."'target='_blank'>Modificar información</a></td></tr>";
      }
      $salida.= "</tbody></table>";
 }
 else // Si no hay usuarios muestra mensaje
   $salida.= "<h5 class='center-align'>No se encontraron resultados</h5>";

 echo $salida;
 $sentencia->close();
 $conexionMySQL->close();
?>
