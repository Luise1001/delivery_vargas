let id_cliente = '';

$(document).on('click', '#modificar_cliente', function()
{
    editar_cliente();
})

$(document).on('click', '#editar_cliente_btn', function(data)
{
  let nombre = data.target.parentNode.attributes.nombre.value;
  let apellido = data.target.parentNode.attributes.apellido.value;
  let tipo_id = data.target.parentNode.attributes.letra.value;
  let cedula = data.target.parentNode.attributes.cedula.value;
  let telefono = data.target.parentNode.attributes.telefono.value;
  id_cliente = data.target.parentNode.attributes.cliente.value;

  $('#editar_nombre_cliente').val(nombre);
  $('#editar_apellido_cliente').val(apellido);
  $('#editar_tipo_id_cliente').val(tipo_id);
  $('#editar_cedula_cliente').val(cedula);
  $('#editar_telefono_cliente').val(telefono);

})

function editar_cliente()
{
    let nombre = $('#editar_nombre_cliente').val();
    let apellido =  $('#editar_apellido_cliente').val();
    let tipo_id = $('#editar_tipo_id_cliente').val();
    let cedula = $('#editar_cedula_cliente').val();
    let telefono =  $('#editar_telefono_cliente').val();

    if(nombre && apellido && tipo_id && cedula && telefono)
    {
      let page = 'editar_cliente';

    $.ajax
    ({
       url: '../../functions/editar.php',
       type: 'POST',
       dataType: 'html',
       data: 
       {
          page: page,
          id_cliente : id_cliente,
          nombre: nombre,
          apellido: apellido,
          tipo_id: tipo_id,
          cedula: cedula,
          telefono: telefono
       }
  
    })
    .done(function(res)
    {
       swal('Operacion Exitosa', '', 'success');
       lista_de_clientes()
    })
    .fail(function()
    {
      console.log("error ejecutando Ajax");
    })
}
else 
{
    swal('Alerte', 'No se pueden enviar Campos Vacíos', 'warning');
}
}