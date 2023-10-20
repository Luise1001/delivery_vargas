$(document).on('click', '.delete-product-button', function(e)
{
    let id_producto = e.currentTarget.attributes.producto.value;
    let codigo = e.currentTarget.attributes.codigo.value;
    let id_comercio = e.currentTarget.attributes.comercio.value;

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
            eliminar_producto(id_producto, codigo, id_comercio);
          break;
          
        default: false;
      }
    });

    
})
function eliminar_producto(id_producto, codigo, id_comercio)
{
    let funcion = 'eliminar_producto';


    $.ajax
    ({
       url: '../../server/functions/eliminar.php',
       type: 'POST',
       dataType: 'json',
       data: 
       {
         funcion : funcion,
         id_producto: id_producto,
         codigo: codigo,
         id_comercio: id_comercio
      }
  
    })
    .done(function(res)
    {
      let titulo = res.titulo;
      let cuerpo = res.cuerpo;
      let accion = res.accion;

      if(accion === 'success')
      {
        mis_productos()
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