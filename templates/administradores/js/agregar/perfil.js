$(document).on('click', '#guardar_perfil', function()
{
    nuevo_cliente();
})

function nuevo_cliente()
{
    let nombre = $('#nombre').val();
    let apellido = $('#apellido').val();
    let tipo_id = $('#tipo_id').val();
    let cedula = $('#cedula').val();
    let telefono = $('#telefono').val();
    let genero = document.querySelector('input[name="genero"]:checked').value;
    let funcion = 'nuevo_cliente';
    
   $.ajax
   ({
      url: '../../server/functions/agregar.php',
      type: 'POST',
      dataType: 'json',
      data: 
      {
         funcion: funcion,
         nombre: nombre,
         apellido: apellido,
         tipo_id: tipo_id,
         cedula: cedula,
         telefono: telefono,
         genero: genero
      }
 
   })
   .done(function(res)
   { 
      let titulo = res.titulo;
      let cuerpo = res.cuerpo;
      let accion = res.accion;

      if(accion === 'success')
      {
         mi_perfil();
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