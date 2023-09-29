let id_usuario = '';
let id_conductor = '';

$(document).on('click', '#edit_user_btn', function(data)
{
   id_usuario = data.target.parentNode.attributes.name.value;
   let user_name = data.target.parentNode.attributes.user.value;


   $('#edit_user_name').val(user_name);
})

$(document).on('click', '#modificar_usuario', function()
{
    editar_usuario();
})

function editar_usuario()
{
    let user_name = $('#edit_user_name').val();

    page = 'editar_nombre_usuario';
 
   if(user_name)
   {
    $.ajax
    ({
       url: '../../functions/editar.php',
       type: 'POST',
       dataType: 'html',
       data: 
       {
         page : page,
         user_name: user_name,
         id_usuario : id_usuario
      }
  
    })
    .done(function(res)
    { mi_perfil();
      swal('Operacion Exitosa', '', 'success');
  
    })
    .fail(function()
    {
      console.log("error ejecutando Ajax");
    })
   }
   else
   {
     swal('Cuidado', 'No se Pueden Enviar Datos Vacíos', 'warning');
   }
}


$(document).on('change', '#input_fp', function()
{

  let container = '#foto_perfil';
 readImage(container, this);
 editar_foto();
});

function editar_foto()
{
  let page = 'editar_foto_perfil';
  var formData = new FormData();
  var foto = $('#input_fp')[0].files[0];
  let confirmar = false;

  formData.append('file', foto);
  formData.append('page', page);

  $.ajax
  ({
     url: '../../functions/editar.php',
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