$(document).ready(function()
{
  $('select').material_select();
  $("#formUsers").on('submit', function(e)
  {
    let pass,passTwo, titulo;
    e.preventDefault();
    pass = document.getElementById('password').value;
    passTwo = document.getElementById('password2').value;
    console.log(pass,passTwo)
    if(pass == passTwo)
    {
      $.ajax(
      {
        type: 'POST',
        url: 'registrarUsuarios.php', //URL a donde se redirecciona
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
            if(data.pagina == 'index')
              location.href = 'index.php';
          });
          $(document).click(function()
          {
            if(data.pagina == 'index')
              location.href = 'index.php';
          });
          $(document).keyup(function(e)
          {
            if (e.which == 27) //Si se da enter
            {
              if(data.pagina == 'index')
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
  $("#formLogin").on('submit', function(e)
  {
    let titulo;
    e.preventDefault();
    $.ajax(
    {
      type: 'POST',
      url: 'validarLogin.php', //URL a donde se redirecciona
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
        }).then(function()
        {
          if(data.pagina == 'admin')
            location.href = 'admin/index.php';
          if(data.pagina == 'user')
            location.href = 'user/index.php';
        });
        $(document).click(function()
        {
          if(data.pagina == 'admin')
            location.href = 'admin/index.php';
          if(data.pagina == 'user')
            location.href = 'user/index.php';
        });
        $(document).keyup(function(e)
        {
          if (e.which == 27) //Si se da enter
          {
            if(data.pagina == 'admin')
              location.href = 'admin/index.php';
            if(data.pagina == 'user')
              location.href = 'user/index.php';
          }
        });
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
  });
});
