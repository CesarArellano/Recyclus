function obtenerPuntos()
{
  $.ajax(
  {
    type: "POST",
    url: "obtenerPuntos.php",
    dataType: 'json',
    success: function(data) // Después de enviar los datos se muestra la respuesta del servidor.
    {
      $('#puntos').html(data.contenidoPuntos);
      $('#contenidoRecompensas').html(data.contenidoRecompensas);
    },
    error : function(jqXHR, textStatus, errorThrown) // Si hubo error, despliega mensaje.
    {
      console.log(JSON.stringify(jqXHR));
      console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
      swal( // Se inicializa sweetalert2
      {
        title: "Ups...",
        type: "error",
        html: "Error del servidor, intente de nuevo",
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Ok!'
      });
    }
  });
}

$(document).ready(function()
{
  $(obtenerPuntos());
  $(".button-collapse").sideNav();
  $('select').material_select();

});
