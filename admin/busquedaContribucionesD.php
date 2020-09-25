<?php
  require '../config.php';
  $salida = "";
  //Obtiene contribuciones
  $query = "SELECT idUsuario,idContribucionD,puntoReciclaje,tipoDesecho,tipoProducto, peso, estadoContribucion FROM contribucionesDesechos";
  if (isset($_POST['consulta']))
  {
    $texto = $_POST['consulta']; // Sanitiza variable del input
    $texto = $conexionMySQL->real_escape_string($texto);
    $query = "SELECT idUsuario,idContribucionD,puntoReciclaje,tipoDesecho,tipoProducto, peso, estadoContribucion  FROM contribucionesDesechos WHERE idUsuario LIKE '%".$texto."%' OR puntoReciclaje LIKE '%".$texto."%' OR tipoDesecho LIKE '%".$texto."%' OR tipoProducto LIKE '%".$texto."%' OR peso LIKE '%".$texto."%'";
  }
  $sentencia = $conexionMySQL->query($query);
  $numeroFilas = $sentencia->num_rows;
  if ($numeroFilas > 0) // Si hay resultados los muestra como tabla
  {
    $salida.= "<table class='responsive-table highlight centered'>
      <thead>
       <th>idUsuario</th>
       <th>Punto Reciclaje</th>
       <th>Tipo desecho</th>
       <th>Tipo Producto</th>
       <th>Peso</th>
       <th></th>
      </thead>
      <tbody>";
      while ($row = $sentencia->fetch_assoc())
      {
        $salida.= "<tr>
          <td>".$row['idUsuario']."</td>
          <td>".$row['puntoReciclaje']."</td>
          <td>".$row['tipoDesecho']."</td>
          <td>".$row['tipoProducto']."</td>
          <td>".$row['peso']."</td>";
        if($row['estadoContribucion'] == 0){
          $salida .= "<td><a class='btn waves-effect waves-light blue darken-2' href='confirmarCitaContribucion.php?tipo=2&idC=".$row['idContribucionD']."' target='_blank'>Confirmar cita</a></td>
          <td><button class='btn waves-effect waves-light' onclick='aprobarContribucion(2,".$row['idContribucionD'].")'target='_blank'>Aprobar</button></td></tr>";
        }
        else{
          $salida .= "<td><a class='btn waves-effect waves-light' disabled>Confirmar cita</a></td><td><a class='btn waves-effect waves-light' disabled>Aprobado</a></td></</tr>";
        }
      }
      $salida.= "</tbody></table>";
 }
 else // Si no hay usuarios muestra mensaje
   $salida.= "<h5 class='center-align'>No se encontraron resultados</h5>";

 echo $salida;
 $sentencia->close();
 $conexionMySQL->close();
?>
