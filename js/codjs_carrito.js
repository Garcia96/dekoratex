$("#tooltip").click(function(){
  var primera=Cookies.getJSON('carrito');
  if(!primera){
    primera = [];
  }
  var producto=new Object();
  producto.imagen=$('#imagenpro').val();
  producto.nombre=$('#nombrepro').val();
  producto.tela=$('#tipo_tela').text();
  producto.color=$('#recibe_color').val();
  producto.alto=$('#alto').val();
  producto.ancho=$('#ancho').val();
  producto.cant=$('#cantidadprod').val();
  producto.precio=$('#preciopro').val();
  producto.valu=parseInt($('#alto').val())*parseInt($('#ancho').val())*parseInt($('#preciopro').val());
  var precio=parseInt($('#alto').val())*parseInt($('#ancho').val())*parseInt($('#preciopro').val());
  producto.valucan=parseInt(precio)*parseInt($('#cantidadprod').val());
  var suma=0;

  if(producto.alto === "" || producto.ancho=== ""){
    $("#alto").prop("requiered",true);
  }else{
    primera.push(producto);
  }
    var id=0;
  Cookies.set('carrito',primera);
  $("div.quitar").remove();
  primera.forEach(function(producto){
    $("div#contiene-productos").append(
      '  <div class="quitar">\
          <div id="noprod" class="container-fluid  border-image eliminar-sli" >\
          <div class="col-md-6 " style="padding:5%;" >\
            <img src="../image/productos/'+producto.imagen+'" class="img-responsive img-rounded" alt="" />\
            <h3>$ '+producto.valu+' </h3>\
          </div>\
          <div class="col-md-6 col-sm-6" style="padding:5%; margin-top:-10% ; padding-right:0%">\
            <br><a href="#" type="button" id="x" class="close eliminarslider" data-dismiss="modal" aria-hidden="true" data-id="'+id+'">&times;</a>\
            <input type="hidden" value="'+id+'">\
            <h3>'+producto.nombre+'  </h3>\
            <h4>Alto:'+producto.alto+'  m</h4>\
            <h4>Ancho:'+producto.ancho+'  m</h4>\
            <h5>Tela:'+producto.tela+' </h5>\
            <h5>Color:'+producto.color+' </h5>\
            <h5>Cantidad:'+producto.cant+' </h5>\
            <h5>Subtotal: $ '+producto.valucan+' </h5>\
            <input type="hidden" class="subtotalcuval" value=" '+producto.valucan+'">\
          </div>\
        </div>\
        </div>');
          suma=suma+parseInt(producto.valucan);
         id=id+1;
  });
  $("div.removerdiv").remove();
  $("div#contiene-productos").append(
    '<div class="removerdiv"><div id="romever"class="container-fluid " id="totalpro">\
  <div class="col-md-6" style="padding:0%">\
  <h1>Total</h1>\
  <h2 id="totalsli">$ '+suma+' </h2>\
  </div>\
  <a href="cart.php" class="btn btn-primary col-md-offset-5 btn-lg ">Ver carrito</a>\
  </div></div>');
});
