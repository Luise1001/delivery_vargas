$(document).ready(mi_perfil());

function mi_perfil()
{
   let funcion = 'mi_perfil_conductor';

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
   { console.log(res)
     $('.titulo-app').html(res.titulo);
     $('#profile_header').html(res.header);
     $('#profile_information').html(res.information);
   })
   .fail(function(err)
   {
      console.log(err);
   })

}

$(document).on('change', '#input_fp', function()
{

  let container = '#foto_perfil';
 readImage(container, this);
 nueva_foto();
});

function nueva_foto()
{
  let funcion = 'nueva_foto_perfil';
  var formData = new FormData();
  var foto = $('#input_fp')[0].files[0];
  let confirmar = false;

  formData.append('file', foto);
  formData.append('funcion', funcion);

  $.ajax
  ({
     url: '../../server/functions/agregar.php',
     type: 'POST',
     dataType: 'html',
     async: true,
     data: formData,
     contentType: false,
     processData: false

  })
  .done(function(res)
  { 
    mi_perfil();
  })
  .fail(function(err)
  {
    console.log(err)
  })

}

$(document).ready(mi_switch());

function mi_switch()
{
   let funcion = 'mi_switch';

   $.ajax
   ({
      url: '../../server/functions/consultas.php',
      type: 'POST',
      dataType: 'html',
      data: 
      {
         funcion: funcion
      }
 
   })
   .done(function(res)
   { 
     $('.mi-switch').html(res);
   })
   .fail(function(err)
   {
      console.log(err.responseText);
   })
}

