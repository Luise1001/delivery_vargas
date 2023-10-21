$(document).on('click', '#editar_direccion', function(e)
{
  pre_editar_direccion(e);
})

function pre_editar_direccion(e)
{
  let id_direccion = e.currentTarget.attributes.direccion.value;
   
  $('#direccion_'+id_direccion).attr('readonly', false);
  $('#direccion_'+id_direccion).focus();
  $('#edit_dir_'+id_direccion).attr('hidden', false);
}

$(document).on('click', '.save-direction', function(e)
{
  let id_direccion = e.currentTarget.attributes.direccion.value;
   editar_direccion(id_direccion);
})


function editar_direccion(id_direccion)
{
    let nombre = $('#direccion_'+id_direccion).val();
    let funcion = 'editar_direccion';


    $.ajax
    ({
       url: '../../server/functions/editar.php',
       type: 'POST',
       dataType: 'json',
       data: 
       {
         funcion : funcion,
         id_direccion: id_direccion,
         nombre: nombre
      }
  
    })
    .done(function(res)
    {
      let titulo = res.titulo;
      let cuerpo = res.cuerpo;
      let accion = res.accion;
      if(accion === 'success')
      {
        mis_direcciones();
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