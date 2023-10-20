$(document).on('click', '.eliminar-db', function(e)
{
    let id = e.currentTarget.attributes.dato.value;
    let tabla = e.currentTarget.attributes.tabla.value;

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
          eliminar_datos_bancarios(id, tabla);
          break;
          
        default: false;
      }
    });

    
})
function eliminar_datos_bancarios(id, tabla)
{
    let funcion = 'eliminar_datos_bancarios';


    $.ajax
    ({
       url: '../../server/functions/eliminar.php',
       type: 'POST',
       dataType: 'json',
       data: 
       {
         funcion : funcion,
         id: id,
         tabla: tabla
      }
  
    })
    .done(function(res)
    {
      let titulo = res.titulo;
      let cuerpo = res.cuerpo;
      let accion = res.accion;

      if(accion === 'success')
      {
        mis_datos_bancarios();
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