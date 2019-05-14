$(document).ready(function() {
  var primera=Cookies.getJSON('carrito');
  if(!primera){
    primera = [];
  }
  var id=0;
  primera.forEach(function(producto){
    $("div#contienesale").append(
      '<input type="hidden" name="alto'+id+'" value="'+producto.alto+'">\
      <input type="hidden" name="ancho'+id+'" value="'+producto.ancho+'">\
      <input type="hidden" name="valu'+id+'" value="'+producto.valu+'">\
      <input type="hidden" name="precio'+id+'" value="'+producto.precio+'">\
      <input type="hidden" name="cant'+id+'" value="'+producto.cant+'">\
      <input type="hidden" name="tela'+id+'" value="'+producto.tela+'">\
      <input type="hidden" name="color'+id+'" value="'+producto.color+'">\
      <input type="hidden" name="nombre'+id+'" value="'+producto.nombre+'">\
      <input type="hidden" name="image'+id+'" value="'+producto.imagen+'"><br>\
      <input type="hidden" name="arr" value="'+primera.length+'"><br>\
      '
    )
    id=id+1;
  });
  $("#finalizarcompra").click(function(){
      Cookies.remove('carrito');

  });
});
