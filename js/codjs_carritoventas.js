$(document).ready(function() {
  var primera=Cookies.getJSON('carrito');
  if(!primera){
    primera = [];
  }
  var id=0;
  var suma=0;
  primera.forEach(function(producto){
    $("tbody#contiene-carrito-productos").append(
      '<tr class="subtotal" >\
      <td >\
        <a href="product-detail.php"><img src="../image/productos/'+producto.imagen+'" class="img-responsive img-rounded" alt="" /></a>\
      </td>\
      <td>\
          <div style=" padding-right: 40%">\
            <h4>'+producto.nombre+'</h4>\
          <label class="control-label col-md-3" for="alto">Alto: </label>\
          <div class="input-group">\
            <input type="text" name="altonuevo" id="alto" value="'+producto.alto+'" class="form-control input-sm " placeholder="Alto" disabled></h5>\
            <div class="input-group-addon">Metros</div>\
          </div><br>\
          <label class="control-label col-md-3" for="ancho">Ancho: </label>\
          <div class="input-group">\
            <input type="text" name="anchonuevo" id="ancho" value="'+producto.ancho+'" class="form-control input-sm" placeholder="Ancho" disabled></h5>\
            <div class="input-group-addon">Metros</div>\
          </div><br>\
          <h5>Color: '+producto.color+'</h5> \
          <h5>Tela: '+producto.tela+'</h5> \
          <h5 class="precio" id="prevalu" data-precio="'+producto.valu+'">$ '+producto.valu+'</h5><br> \
          <input type="hidden" value="'+producto.valu+'" name="valunit">\
          <a href="#" class="eliminar" data-id="'+id+'">Eliminar producto</a>\
      </td>\
      <td>\
        <div class="row" >\
                <div class=" number-spinner" ><br><br><br><br>\
                <button type="button" id="down" class="btn risp" data-id="'+id+'" ><span class="glyphicon glyphicon-minus"></span></button >\
                  <input type="text" class="canti"  id="spiner" style="width:15%;" value="'+producto.cant+'">\
                <button type="button"   id="up" class="btn risp" data-id="'+id+'" ><span class="glyphicon glyphicon-plus"></span></button >\
                </div>\
        </div>\
      </td>\
      <div class="sub">\
        <td ><br><br><br><br>\
          <h4 class="subtotalcu" value="'+producto.valucan+'" id="co">$ '+producto.valucan+' </h4>\
          <input class="subtotalcuval" type="hidden" value="'+producto.valucan+'">\
          <input class="cicloid" type="hidden" value="'+id+'">\
        </td>\
      </div>\
    </tr>');


    id=id+1;


  });
  $("tbody#contiene-carrito-productos").append(
    '  <tr >\
        <td colspan="2" align="right">\
          <a href="../Product/index.php?idp=1&np=Sheer" class="btn btn-primary " style="margin: 5%">Agregar <span class="glyphicon glyphicon-plus"></span></a>\
        </td>\
        <td colspan="2"  align="right">\
          <h3 class="totalfinal" id="totfinal" >Total: $  </h3><br>\
          <input class="cicloid" type="hidden" name="totalventa" id="totfinal2" value="">\
        </td>\
      </tr>\
      <tr>\
        <td colspan="4" align="right">\
          <input  type="submit" name="button" class="btn btn-primary" value="Finalizar compra">\
        </td>\
      </tr>');
});
