$(document).ready(function() {

  $("#ordenc ").click(function(){
  var selec=  $( "#ordenc " ).val();
  if(selec == "sale_date"){
    $("div#reomver").remove();
    $("div#reomver-comp").remove();
    $("div#reomver-comp-2").remove();
      $("div#compo-desde").append('<div id="reomver-comp"> \
      <br><h5 class="text-muted">Desde:</h5>\
      <input class="form-control" type="date" name="fecha-dese" value="">\
      <br><br></div>');
      $("div#compo-hasta").append('<div id="reomver-comp-2">\
      <br><h5 class="text-muted">Hasta:</h5>\
      <input class="form-control" type="date" name="fecha-hasta" value="">\
      <br><br></div>');
  }else if(selec == "total"){
    $("div#reomver").remove();
    $("div#reomver-comp").remove();
    $("div#reomver-comp-2").remove();
      $("div#compo-desde").append('<div id="reomver">\
      <br><h5 class="text-muted">Valor $:</h5>\
      <input class="form-control" type="text" name="valor-venta" value="">\
      <br><br></div>');
    }else if(selec == "state"){
      $("div#reomver").remove();
      $("div#reomver-comp").remove();
      $("div#reomver-comp-2").remove();
        $("div#compo-desde").append('<div id="reomver">\
        <br><h5 class="text-muted">Seleccione estado:</h5>\
        <select class="form-control" name="estadov">\
          <option value="1">Finalizado</option>\
          <option value="2">Pendiente</option>\
          <option value="3">Cancelado</option>\
          <option value="4">Sin confirmar</option>\
        </select>\
        <br><br></div>');
    }else{
      $("div#reomver").remove();
      $("div#reomver-comp").remove();
      $("div#reomver-comp-2").remove();
    }
  });

  $("#comp ").click(function(){
  var select=  $( "#comp " ).val();
  if(select == "todos"){
    $("div#reomver-comp").remove();
    $("div#reomver-comp-2").remove();
  }else {
    $("div#reomver-comp").remove();
    $("div#reomver-comp-2").remove();
      $("div#compo-desde").append('<div id="reomver-comp"> \
      <br><h5 class="text-muted">Desde:</h5>\
      <input class="form-control" type="date" name="fecha-dese" value="">\
      <br><br></div>');
      $("div#compo-hasta").append('<div id="reomver-comp-2">\
      <br><h5 class="text-muted">Hasta:</h5>\
      <input class="form-control" type="date" name="fecha-hasta" value="">\
      <br><br></div>');
    }
  });

});
