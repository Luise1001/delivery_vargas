let id_admin = 0;

$(document).on('click', '.editar_admin_btn', function(data)
{ 
    id_admin = data.currentTarget.attributes.admin.value;
    $('#edit_admin_user_name').val(data.currentTarget.attributes.user.value);
    $('#edit_admin_correo').val(data.currentTarget.attributes.correo.value);
    $('#edit_nivel').val(data.currentTarget.attributes.nivel.value);
})

$(document).on('click', '#editar_admin', function()
{
    editar_admin();
})

function editar_admin()
{
  let user_name = $('#edit_admin_user_name').val();
  let correo = $('#edit_admin_correo').val();
  let nivel = $('#edit_nivel').val();
  let funcion = 'editar_admin';

  if(user_name && correo && nivel)
  {
    
  $.ajax
  ({
     url: '../../server/functions/editar.php',
     type: 'POST',
     dataType: 'html',
     data: 
     {
        funcion: funcion,
        id_admin: id_admin,
        user_name: user_name,
        correo: correo,
        nivel: nivel
     }

  })
  .done(function(res)
  { 
     lista_de_administradores();
  })
  .fail(function()
  {
    console.log("error ejecutando Ajax");
  })
}
}
