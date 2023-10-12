$(document).ready(mi_perfil());

function mi_perfil()
{
   let funcion = 'mi_perfil';

   $.ajax
   ({
      url: '../../server/functions/consultas.php',
      type: 'POST',
      dataType: 'json',
      data: 
      {
         funcion: funcion
      }
 
   })
   .done(function(res)
   { 
     $('.titulo-app').html(res.titulo);
     $('#profile_header').html(res.header);
     $('#profile_information').html(res.information);
   })
   .fail(function(err)
   {
      console.log(err);
   })

}

