$(document).ready(lista_de_productos());

function lista_de_productos()
{ 
   page = 'mis_productos';
 
  $.ajax
  ({
     url: '../../functions/consultas.php',
     type: 'POST',
     dataType: 'json',
     data: 
     {
       page : page
    }

  })
  .done(function(res)
  {
    $('.header-icons').html(res.botones);
    $('.catalogo-productos').html(res.productos);

  })
  .fail(function(err)
  {
    console.log(err);
  })
}



