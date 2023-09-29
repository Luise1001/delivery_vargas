let id_conductor = '';
$(document).on('click', '#editar_conductor_btn', function(data)
{ 
    $('#editar_nombre').val(data.target.parentNode.attributes.nombre.value);
    $('#editar_apellido').val(data.target.parentNode.attributes.apellido.value);
    $('#editar_tipo_id').val(data.target.parentNode.attributes.letra.value);
    $('#editar_cedula_conductor').val(data.target.parentNode.attributes.cedula.value);
    $('#editar_telefono').val(data.target.parentNode.attributes.telefono.value);
    $('#editar_direccion').val(data.target.parentNode.attributes.direccion.value);
    $('#editar_usuario_conductor').val(data.target.parentNode.attributes.usuario.value)
    id_conductor = data.target.parentNode.attributes.conductor.value;
})

$(document).on('click', '#modificar_conductor', function()
{
   let nombre = $('#editar_nombre').val();
   let apellido =  $('#editar_apellido').val();
   let tipo_id = $('#editar_tipo_id').val();
   let cedula = $('#editar_cedula_conductor').val();
   let telefono =  $('#editar_telefono').val();
   let direccion = $('#editar_direccion').val();
   let usuario = $('#editar_usuario_conductor').val();
   let page = 'editar_conductor';
    
    $.ajax
    ({
       url: '../../functions/editar.php',
       type: 'POST',
       dataType: 'html',
       data: 
       {
          page: page,
          id_conductor : id_conductor,
          nombre: nombre,
          apellido: apellido,
          tipo_id: tipo_id,
          cedula: cedula,
          telefono: telefono,
          direccion: direccion,
          usuario: usuario
       }
  
    })
    .done(function(res)
    {
       lista_de_conductores();
    })
    .fail(function()
    {
      console.log("error ejecutando Ajax");
    })
})

$(document).on('keyup', '#editar_usuario_conductor', function()
{
   let correo = $('#editar_usuario_conductor').val();
   verificar_usuario(correo);
})