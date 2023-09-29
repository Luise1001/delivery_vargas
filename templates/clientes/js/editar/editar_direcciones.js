let id_direccion = '';
$(document).on('click', '.editar-direccion', function(data)
{
    id_direccion = data.currentTarget.attributes.id.value;
    let nombre = data.currentTarget.attributes.nombre.value;
    $('#edit_direction').val(nombre);
})

$(document).on('click', '#modificar_direccion', function()
{
    editar_direccion();
})

function editar_direccion()
{
    let page = 'editar_direccion';
    let nombre = $('#edit_direction').val();

    $.ajax
    ({
       url: '../../functions/editar.php',
       type: 'POST',
       dataType: 'html',
       data: 
       {
         page : page,
         id_direccion: id_direccion,
         nombre: nombre
      }
  
    })
    .done(function(res)
    {
     lista_de_direcciones();
  
    })
    .fail(function(err)
    {
      console.log(err);
    })
}