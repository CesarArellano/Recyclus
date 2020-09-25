function formDevices(){
  $('#formReciclar').hide();
  $('#formDevices').show();
  $('#mapa').show();
}
function mostrarInicio(){
  $('#formReciclar').show();
  $('#formDevices').hide();
  $('#formDI').hide();
  $('#formDO').hide();
  $('#mapa').hide();
}
function formDO(){
  $('#formReciclar').hide();
  $('#formDO').show();
  $('#mapa').show();
}
function formDI(){
  $('#formReciclar').hide();
  $('#formDI').show();
  $('#mapa').show();
}

function obtenerDatosCliente()
{
  $.ajax(
  {
    type: "POST",
    url: "obtenerDatosCliente.php",
    dataType: 'json',
    success: function(data) // Después de enviar los datos se muestra la respuesta del servidor.
    {
      if(data.direccion == 0){
        $('#buttonDevices').attr('disabled', true);
        $('#buttonDO').attr('disabled', true);
        $("#buttonDI").attr("disabled", true);
        $('#mensajeDireccion').html("<center><h5>No hay una dirección registrada</h5><a class='waves-effect waves-light btn green' href='nuevaDireccion.php'>Agregar dirección<i class='material-icons right'>add_location</i></a></center>");
      }
      $('#datosPersonales').html(data.datosPersonales);
      $('#nombre').html(data.nombre);
      $('#contenidoNotificaciones').html(data.notificaciones);
      $('#contribucionesT').html(data.contribucionesT);
      $('#contribucionesD').html(data.contribucionesD);
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
  $('.slider').slider();
  $(".button-collapse").sideNav();
  $("select").material_select();
  $(document).on("click", ".select-wrapper", function (event) { event.stopPropagation(); }); //Evita que se cierre el select
  $("select[required]").css({display: "block", height: 0, padding: 0, width: 0, position: 'absolute'}); // Muestra en pantalla un mensaje de que el campo del select está vacío.
  $('ul.tabs').tabs();
  $(obtenerDatosCliente());
  $('#formDevices').hide();
  $('#formDO').hide();
  $('#formDI').hide();
  $("#mapa").hide();
  $('#formNewDevice').on('submit', function(e)
  {
    let titulo;
    e.preventDefault();
    $.ajax(
    {
      type: 'POST',
      url: 'nuevaContribucionT.php', //URL a donde se redirecciona
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
          titulo = "¡Felicitaciones!";
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
  $('#formNewDO').on('submit', function(e)
  {
    let titulo;
    e.preventDefault();
    $.ajax(
    {
      type: 'POST',
      url: 'nuevaContribucionD.php', //URL a donde se redirecciona
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
          titulo = "¡Felicitaciones!";
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
  $('#formNewDI').on('submit', function(e)
  {
    let titulo;
    e.preventDefault();
    $.ajax(
    {
      type: 'POST',
      url: 'nuevaContribucionD.php', //URL a donde se redirecciona
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
