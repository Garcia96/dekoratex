$("#tooltip").click(function(){
  var primera=Cookies.getJSON('carrito');
  if(!primera){
    primera = [];
  }
  var suma=0
  $(".eliminarslider").click(function(e){
    e.preventDefault();
    var ide=$(this).attr('data-id');
    $(this).parentsUntil('div.quitar').remove();
    primera.forEach(function(producto){
      primera.splice(ide, 1);
      Cookies.set('carrito',primera);
      console.log(producto);
    });
    $(function () {
    $('.subtotalcuval').each(function(index,value){
      var valor=eval($(this).val());
      suma=suma+valor;
      console.log(suma);
    });
    $('#totalsli').text(' $ '+suma);
  });
});
});
