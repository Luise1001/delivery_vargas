$(document).on('click', '.eliminar-datos-bancarios', function(data)
{
    let id = data.currentTarget.attributes.id.value;
    let id_comercio = data.currentTarget.attributes.comercio.value;
    let tabla = data.currentTarget.attributes.tabla.value;

    swal('Seguro que desea eliminar','', 'warning',
    {
      buttons: {
        cancel: 'Cancelar',
        Confirmar: true,
      },
    })
    .then((value) => 
    {
      switch (value) {
     
        case "Confirmar":
          eliminar_datos_bancarios(id, id_comercio, tabla);
          break;
          
        default: false;
      }
    });

    
})
function eliminar_datos_bancarios(id, id_comercio, tabla)
{
    let funcion = 'eliminar_datos_bancarios';


    $.ajax
    ({
       url: '../../server/functions/eliminar.php',
       type: 'POST',
       dataType: 'html',
       data: 
       {
         funcion : funcion,
         id: id,
         id_comercio: id_comercio,
         tabla: tabla
      }
  
    })
    .done(function(res)
    {
      mis_datos_bancarios();
  
    })
    .fail(function(err)
    {
      console.log(err);
    })
}