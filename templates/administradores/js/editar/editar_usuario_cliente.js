let id_usuario = '';

$(document).on('click', '#editar_usuario_btn', function(data)
{   
    id_usuario = data.currentTarget.attributes.usuario.value;
  
})

$(document).on('click', '#modificar_usuario_comercio', function()
{
    let nivel = $('#edit_nivel_usuario').val();
    editar_usuario_comercio(id_usuario, nivel);
})

function editar_usuario_comercio(id_usuario, nivel)
{  
  let funcion = 'editar_usuario_cliente';

  $.ajax
  ({
     url: '../../server/functions/editar.php',
     type: 'POST',
     dataType: 'html',
     data: 
     {
        funcion: funcion,
        id_usuario: id_usuario,
        nivel: nivel
     }

  })
  .done(function(res)
  { 
    swal('Operacion Exitosa', '', 'success');
    
    if(typeof lista_de_usuarios === 'function')
    {
      lista_de_usuarios();
    }

    if(typeof lista_de_usuarios_comercios === 'function')
    {
      lista_de_usuarios_comercios();
    }
  })
  .fail(function()
  {
    console.log("error ejecutando Ajax");
  })

}