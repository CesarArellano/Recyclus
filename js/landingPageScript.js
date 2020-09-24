$(document).ready(function(){
  $('.parallax').parallax();
  $('.modal').modal();
  $(".button-collapse").sideNav();
  $('.scrollspy').scrollSpy();
  $('select').material_select();
  $(document).on("click", ".select-wrapper", function (event) { event.stopPropagation(); }); //Evita que se cierra el select
  $("select[required]").css({display: "block", height: 0, padding: 0, width: 0, position: 'absolute'});
});
