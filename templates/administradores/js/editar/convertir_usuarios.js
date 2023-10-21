let id_usuario;

$(document).on('click', '.convertir-usuario', function(e)
{   
    id_usuario = e.currentTarget.attributes.usuario.value;
})

$(document).on('click', '#convertir_usuario', function()
{
    let nivel = $('#edit_nivel_usuario').val();
    convertir_usuario(id_usuario, nivel);
})

function convertir_usuario(id_usuario, nivel)
{  
  let funcion = 'convertir_usuario';

  $.ajax
  ({
     url: '../../server/functions/editar.php',
     type: 'POST',
     dataType: 'json',
     data: 
     {
        funcion: funcion,
        id_usuario: id_usuario,
        nivel: nivel
     }

  })
  .done(function(res)
  { 
    let titulo = res.titulo;
    let cuerpo = res.cuerpo;
    let accion = res.accion;

    if(accion === 'success')
    {
      lista_de_usuarios();
    }
    else
    {
      swal(titulo, cuerpo, accion);
    }
  })
  .fail(function(err)
  {
    console.log(err);
  })

}