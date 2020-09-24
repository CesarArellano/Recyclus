function obtenerProductosCarrito()
{
  $.post('obtenerProductosCarrito.php',function(data)
	{
    if(data.productos > 0){
      $('.tooltipped').tooltip({
        html: true,
        tooltip: data.nombreProductos
      });
      $('#textoNumProductosCarrito').html(data.productos);
    }
    else{
      $('#textoNumProductosCarrito').html("");
      $('.tooltipped').tooltip({
        html: true,
        tooltip: "Carrito vacío"
      });
    }
	},'json');
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
      $('#catologoWishList').html(data.wishList);
      $('#catologoCompras').html(data.compras);
      $('#informacionFacturacion').html(data.tarjetas);
      $('#direccionFacturacion').html(data.direccionFacturacion);
      $('#direccionEnvio').html(data.direccionEnvio);
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
  //$(obtenerDatosCliente());
});
