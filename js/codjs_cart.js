$(document).ready(function() {
  var primera=Cookies.getJSON('carrito');
  if(!primera){
    primera = [];
  }
    var suma=0
$('.number-spinner button ').click(function() { //Funcionamiento de la cantidad de productos en el carrito
    var btn = $(this),
        oldValue = btn.closest('.number-spinner').find('input').val().trim(),
        precio=btn.closest('.number-spinner').find('input').attr('data-precio');
        newVal = 0;
        btn.closest('.number-spinner').find('button').prop("disabled", false);
        var precio=btn.closest('.subtotal').find('.precio').attr('data-precio');

    if (btn.attr('id') == 'up') {
        newVal = parseInt(oldValue) + 1;

        var  total=precio*newVal;

    } else {
        if (oldValue > 1) {
            newVal = parseInt(oldValue) - 1;
            var  total=parseInt(precio)*newVal;

        } else {
            newVal = 1;
            var  total=parseInt(precio)*newVal;
           btn.prop("disabled", true);
        }
    }

    btn.closest('.number-spinner').find('input').val(newVal);
    btn.closest('.subtotal').find('.subtotalcu').text("$ "+total);
    btn.closest('.subtotal').find('.subtotalcuval').val(total);



    $(function () {
      suma=0;
    $('.subtotalcuval').each(function(index,value){
      var valor=eval($(this).val());
      suma=suma+valor;
    });
    $('.totalfinal').text('Total: $ '+suma);
    $('#totalventa').val(suma);

    });

});

$(".eliminar").click(function(e){
  e.preventDefault();
  var ide=$(this).attr('data-id');
  $(this).parentsUntil('tbody').remove();
  primera.forEach(function(producto){
    primera.splice(ide, 1);
    Cookies.set('carrito',primera);
  });
  $(function () {
    suma=0;
  $('.subtotalcuval').each(function(index,value){
    var valor=eval($(this).val());
    suma=suma+valor;
  });
  $('.totalfinal').text('Total: $ '+suma);
  $('#totalventa').val(suma);
  });
});


$(function () {
$('.subtotalcuval').each(function(index,value){
  var valor=eval($(this).val());
  suma=suma+valor;
});
$('.totalfinal').text('Total: $ '+suma);
$('#totfinal2').val(suma);
});

$('.risp').click(function(){
  var r=$(this).attr('data-id');
  primera[r].cant=$('.canti').eq(r).val();
  primera[r].valucan=$('.subtotalcuval').eq(r).val();
  Cookies.set('carrito',primera);
});

});
