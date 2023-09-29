let id_usuario = '';
let id_cliente = '';

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
    {
       mi_perfil();
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


$(document).on('click', '#edit_data_btn', function(data)
{
    id_cliente = data.target.parentNode.attributes.name.value;
    let nombre = data.target.parentNode.attributes.nombre.value;
    let apellido = data.target.parentNode.attributes.apellido.value;
    let tipo_id = data.target.parentNode.attributes.tipo.value;
    let cedula = data.target.parentNode.attributes.cedula.value;
    let telefono = data.target.parentNode.attributes.telefono.value;

    $('#editar_nombre_cliente').val(nombre);
    $('#editar_apellido_cliente').val(apellido);
    $('#editar_tipo_id_cliente').val(tipo_id);
    $('#editar_cedula_cliente').val(cedula);
    $('#editar_telefono_cliente').val(telefono);

})

$(document).on('click', '#modificar_cliente', function()
{
    let nombre = $('#editar_nombre_cliente').val();
    let apellido = $('#editar_apellido_cliente').val();
    let tipo_id = $('#editar_tipo_id_cliente').val();
    let cedula = $('#editar_cedula_cliente').val();
    let telefono = $('#editar_telefono_cliente').val();

    let page = 'editar_cliente';

    if(nombre && apellido && tipo_id && cedula && telefono)
    {
      $.ajax
      ({
         url: '../../functions/editar.php',
         type: 'POST',
         dataType: 'html',
         data: 
         {
           page : page,
           id_cliente: id_cliente,
           nombre: nombre,
           apellido: apellido,
           tipo_id: tipo_id,
           cedula: cedula,
           telefono: telefono
        }
    
      })
      .done(function(res)
      { 
        mi_perfil();
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
})

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