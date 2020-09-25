function resultadoBusquedaUsuarios(texto)
{
  $.ajax(
  {
    url: 'busquedaUsuarios.php',
    type: 'POST',
    dataType: 'html',
    data: {consulta: texto},
    success: function(data) // Después de enviar los datos se muestra la respuesta del servidor.
    {
      $("#resultadoBusquedaUsuarios").html(data);
    },
    error : function(xhr, status) // Si hubo error, despliega mensaje.
    {
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

function resultadoBusquedaContribucionesT(texto)
{
  $.ajax(
  {
    url: 'busquedaContribucionesT.php',
    type: 'POST',
    dataType: 'html',
    data: {consulta: texto},
    success: function(data) // Después de enviar los datos se muestra la respuesta del servidor.
    {
      $("#resultadoBusquedaContribucionesT").html(data);
    },
    error : function(xhr, status) // Si hubo error, despliega mensaje.
    {
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
function resultadoBusquedaContribucionesD(texto)
{
  $.ajax(
  {
    url: 'busquedaContribucionesD.php',
    type: 'POST',
    dataType: 'html',
    data: {consulta: texto},
    success: function(data) // Después de enviar los datos se muestra la respuesta del servidor.
    {
      $("#resultadoBusquedaContribucionesD").html(data);
    },
    error : function(xhr, status) // Si hubo error, despliega mensaje.
    {
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
  $(resultadoBusquedaUsuarios());
  $(resultadoBusquedaContribucionesT());
  $(resultadoBusquedaContribucionesD());

  $(".button-collapse").sideNav();
  $('ul.tabs').tabs();
  $("select").material_select();
  $(document).on("click", ".select-wrapper", function (event) { event.stopPropagation(); }); //Evita que se cierra el select
  $("select[required]").css({display: "block", height: 0, padding: 0, width: 0, position: 'absolute'}); // Muestra en pantalla un mensaje de que el campo del select está vacío.
  $('#estadisticasContenido').hide();
  $('#agregarUsuarioContenido').hide();
  $('#busquedaUsuarioContenido').hide();
  $('#busquedaContribucionesTContenido').hide();
  $('#busquedaContribucionesDContenido').hide();

  $('#inputBusquedaUsuarios').on('keyup', function()
  {
    let texto = $(this).val();
    if(texto != "")
      resultadoBusquedaUsuarios(texto);
    else
      resultadoBusquedaUsuarios();
  });

  $('#inputBusquedaContribucionesT').on('keyup', function()
  {
    let texto = $(this).val();
    if(texto != "")
      resultadoBusquedaContribucionesT(texto);
    else
      resultadoBusquedaContribucionesT();
  });
  $('#inputBusquedaContribucionesD').on('keyup', function()
  {
    let texto = $(this).val();
    if(texto != "")
      resultadoBusquedaContribucionesD(texto);
    else
      resultadoBusquedaContribucionesD();
  });

  $('#selectInicio').click(function()
  {
    $('#inicioContenido').show();
    $('#estadisticasContenido').hide();
    $('#agregarUsuarioContenido').hide();
    $('#busquedaUsuarioContenido').hide();
    $('#busquedaContribucionesTContenido').hide();
    $('#busquedaContribucionesDContenido').hide();
  });
  $('#selectEstadisticas').click(function()
  {
    $('#inicioContenido').hide();
    $('#estadisticasContenido').show();
    $('#agregarUsuarioContenido').hide();
    $('#busquedaContribucionesTContenido').hide();
    $('#busquedaContribucionesDContenido').hide();
  });
  $('#selectNuevoUsuario').click(function()
  {
    $('#inicioContenido').hide();
    $('#estadisticasContenido').hide();
    $('#agregarUsuarioContenido').show();
    $('#busquedaUsuarioContenido').hide();
    $('#busquedaContribucionesTContenido').hide();
    $('#busquedaContribucionesDContenido').hide();
  });

  $('#selectBusquedaUsuario').click(function()
  {
    $('#inicioContenido').hide();
    $('#estadisticasContenido').hide();
    $('#agregarUsuarioContenido').hide();
    $('#busquedaUsuarioContenido').show();
    $('#busquedaContribucionesTContenido').hide();
    $('#busquedaContribucionesDContenido').hide();
  });
  $('#selectBusquedaContribucionesT').click(function()
  {
    $('#inicioContenido').hide();
    $('#estadisticasContenido').hide();
    $('#agregarUsuarioContenido').hide();
    $('#busquedaUsuarioContenido').hide();
    $('#busquedaContribucionesTContenido').show();
    $('#busquedaContribucionesDContenido').hide();
  });
  $('#selectBusquedaContribucionesD').click(function()
  {
    $('#inicioContenido').hide();
    $('#estadisticasContenido').hide();
    $('#agregarUsuarioContenido').hide();
    $('#busquedaUsuarioContenido').hide();
    $('#busquedaContribucionesTContenido').hide();
    $('#busquedaContribucionesDContenido').show();
  });

  $("#formUsers").on('submit', function(e)
  {
    e.preventDefault();
    let pass,passTwo, titulo;
    pass = $('#password').val();
    passTwo = $('#password2').val();
    if(pass == passTwo)
    {
      $.ajax(
      {
        type: 'POST',
        url: 'registroUsuariosAdmin.php', //URL a donde se redirecciona
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
            if(data.apartado == 'index')
              location.href = 'index.php';
          });
          $(document).click(function()
          {
            if(data.apartado == 'index')
              location.href = 'index.php';
          });
          $(document).keyup(function(e)
          {
            if (e.which == 27) //Si se da enter
            {
              if(data.apartado == 'index')
                location.href = 'index.php';
            }
          });
          },
          error : function(xhr, status) // Si hubo error, despliega mensaje.
          {
            console.log('Entro a error servidor');
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
      else
      {
        swal( // Se inicializa sweetalert2
        {
            title: "Ups...",
            type: "error",
            html: "Error, las contraseñas no coinciden, intente de nuevo",
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok!'
        });
      }
  });
});
