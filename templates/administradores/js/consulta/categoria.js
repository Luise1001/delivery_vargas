$(document).ready(comercios());

function comercios()
{
 const parametros = window.location.search;
 const variables = new URLSearchParams(parametros);
 let id_categoria = variables.get('id');
 let categoria = variables.get('categoria');
 let funcion = 'comercios';
  
  $.ajax
  ({
     url: '../../server/functions/consultas.php',
     type: 'POST',
     dataType: 'json',
     data: 
     {
       funcion : funcion,
       id_categoria: id_categoria,
       categoria: categoria
    }

  })
  .done(function(res)
  {
    $('.titulo-app').html(res.titulo);
    $('.comercios').html(res.comercios);
  })
  .fail(function(err)
  {
    console.log(err);
  })
}