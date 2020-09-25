<?php
  require '../config.php';
  $salida = "";
  //Obtiene contribuciones
  $query = "SELECT idUsuario,idContribucionT,puntoReciclaje,tipoProducto,nombreProducto,marcaProducto,gamaProducto,tiempoUsoProducto FROM contribucionesTecnologicas";
  if (isset($_POST['consulta']))
  {
    $texto = $_POST['consulta']; // Sanitiza variable del input
    $texto = $conexionMySQL->real_escape_string($texto);
    $query = "SELECT idUsuario,idContribucionT,puntoReciclaje,tipoProducto,nombreProducto,marcaProducto,gamaProducto,tiempoUsoProducto FROM contribucionesTecnologicas WHERE idUsuario LIKE '%".$texto."%' OR puntoReciclaje LIKE '%".$texto."%' OR tipoProducto LIKE '%".$texto."%' OR nombreProducto LIKE '%".$texto."%' OR marcaProducto LIKE '%".$texto."%'  OR gamaProducto LIKE '%".$texto."%'";
  }
  $sentencia = $conexionMySQL->query($query);
  $numeroFilas = $sentencia->num_rows;
  if ($numeroFilas > 0) // Si hay resultados los muestra como tabla
  {
    $salida.= "<table class='responsive-table highlight centered'>
      <thead>
       <th>idUsuario</th>
       <th>Punto Reciclaje</th>
       <th>Tipo Producto</th>
       <th>Nombre Producto</th>
       <th>Marca</th>
       <th>Gama</th>
       <th>Uso</th>
       <th></th>
       <th></th>
      </thead>
      <tbody>";
      while ($row = $sentencia->fetch_assoc())
      {
        $salida.= "<tr>
          <td>".$row['idUsuario']."</td>
          <td>".$row['puntoReciclaje']."</td>
          <td>".$row['tipoProducto']."</td>
          <td>".$row['nombreProducto']."</td>
          <td>".$row['marcaProducto']."</td>
          <td>".$row['gamaProducto']."</td>
          <td>".$row['tiempoUsoProducto']."</td>";
        if($row['estadoContribucion'] == 0){
          $salida .= "<td><a href='#' onclick='aprobarContribucion(1,".$row['idContribucionT'].") target='_blank'>Aprobar</a></td>";
        }
        else{
          $salida .= "<td><a class='grey-text'>Aprobado</a></td>";
        }
        $salida .= "<td><a href='verMas.php?id=".$row['idUsuario']."'target='_blank'>Ver más</a></td></tr>";
      }
      $salida.= "</tbody></table>";
 }
 else // Si no hay usuarios muestra mensaje
   $salida.= "<h5 class='center-align'>No se encontraron resultados</h5>";

 echo $salida;
 $sentencia->close();
 $conexionMySQL->close();
?>
