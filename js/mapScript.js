function iniciarMap(){
  let latitud, altitud, existe;
  $.post('obtenerCoordenadasUsuario.php',function(data)
	{
    existe = data.existe;
    latitud = data.latitud;
    longitud = data.longitud;
    console.log(existe,latitud,longitud);
    if(existe == 1){
      var coord = {lat: latitud ,lng: longitud};
      var map = new google.maps.Map(document.getElementById('map'),{
        zoom: 10,
        center: coord
      });
      var marker = new google.maps.Marker({
        position: coord,
        map: map
      });
    }
	},'json');
}
