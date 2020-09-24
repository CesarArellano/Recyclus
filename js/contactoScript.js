function contactWhatsapp(params){
  let cliente = params.get('nombreCliente');
  let telefono = params.get('telefonoCliente');
  let email = params.get('emailCliente');
  let asunto = params.get('asunto');
  let mensaje = params.get('mensaje');
  let url = "https://api.whatsapp.com/send?phone=525567879498&text=Nombre: %0A" + cliente + "%0A%0ATelefono: %0A" + telefono + "%0A%0AEmail: %0A" + email + "%0A%0AAsunto: %0A" + asunto + "%0A%0AMensaje: %0A" + mensaje + "%0A";
	window.open(url);
}
function contactEmail(params){
  $.ajax(
  {
    type: 'POST',
    url: 'contactoEmail.php', //URL a donde se redirecciona
    data: params, // Inicializa el objeto con la información (del submit)del formulario.
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
      Swal.fire(
      {
        icon: data.alerta,
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
    error : function(jqXHR, textStatus, errorThrown){
      console.log(JSON.stringify(jqXHR));
      console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
      Swal.fire( // Se inicializa sweetalert2
      {
        icon: "error",
        title: "Ups...",
        html: "Error del servidor, intente de nuevo",
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Ok!'
      });
    }
  });
}

$(document).ready(function(){
  $('#formContact').on('submit', function(e){
    e.preventDefault();
    let params = new FormData(document.getElementById('formContact'));
    let tipoContacto = parseInt($('#tipoContacto').val());
    if(tipoContacto == 1)
      contactEmail(params);
    else if (tipoContacto == 2)
      contactWhatsapp(params);
    else{
      contactEmail(params);
      contactWhatsapp(params);
    }
  });
});
