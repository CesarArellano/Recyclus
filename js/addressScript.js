function obtenerPuntos()
{
  $.ajax(
  {
    type: "POST",
    url: "obtenerDatosCliente.php",
    dataType: 'json',
    success: function(data) // Después de enviar los datos se muestra la respuesta del servidor.
    {
      if(data.puntos > 0){
        $('.tooltipped').tooltip({
          html: true,
          tooltip: data.puntos+" puntos acumulados"
        });
      }
      else{
        $('.tooltipped').tooltip({
          html: true,
          tooltip: "No tiene puntos"
        });
      }
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
  $("#formAddress").on('submit', function(e)
  {
    let titulo;
    e.preventDefault();
    $.ajax(
    {
      type: 'POST',
      url: 'registrarNuevaDireccion.php', //URL a donde se redirecciona
      data: new FormData(this), // Inicializa el objeto con la información (del submit)del formulario.
      dataType : 'json',
      processData: false,
      contentType: false,
      cache: false,
      success: function(data) // Después de enviar los datos se muestra la respuesta del servidor.
      {
        if(data.alerta == "error") // título de acuerdo al tipo de alerta
          titulo = "Ups...";
        else
          titulo = "Bien hecho!";
        swal(
        {
          type: data.alerta,
          title: titulo,
          html: data.mensaje,
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Ok!'
        }).then(function ()
        {
          if(data.apartado == 'cuenta')
            location.href = 'index.php';
        });
        $(document).click(function()
        {
          if(data.apartado == 'cuenta')
            location.href = 'index.php';
        });
        $(document).keyup(function(e)
        {
          if (e.which == 27) //Si se da enter
          {
            if(data.apartado == 'cuenta')
              location.href = 'index.php';
          }
        });
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
  });
});
