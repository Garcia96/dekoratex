$(document).ready(function() {
  var primera=Cookies.getJSON('carrito');
  if(!primera){
    primera = [];
  }
  $('#tooltip').tooltip();//funcionamiento del tooltip
  $('#tooltip_ns').tooltip();//funcionamiento del tooltip
  
    $('.menu-link').bigSlide({
      side: "right",            //Funcionamiento Sliderpael
      menuWidth: "37em"
    });
  $('.menu-link').click(function(){
    $('#ancho').val('');
    $('#alto').val('');
  });
var bd = $('<div class="modal-backdrop fade in "></div>');//crea modal
    $("#tooltip").click(function() { //Abre el modal creado
    bd.appendTo(document.body);
    $("#tooltip").tooltip('hide');//oculta el tooltip
  });
  $("#button-modal-close").click(function() { //Cierra el modal ya creado
   bd.remove();
  });
  $('#color-select').simplecolorpicker({//selector de colores
    picker: true,
    theme: 'glyphicons'
  });

  $(document).click(function() {//toma el valor del color y lo ubica en un input de tipo text
      var valor = $("#color-select option:selected ").text();
      $("#recibe_color").val(valor);

  });


});
