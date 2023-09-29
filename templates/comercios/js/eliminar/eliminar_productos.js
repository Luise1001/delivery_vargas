$(document).on('click', '.eliminar-producto', function(data)
{
    let id_producto = data.currentTarget.attributes.producto.value;
    let codigo = data.currentTarget.attributes.codigo.value;
    let rif = data.currentTarget.attributes.comercio.value;

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
            eliminar_producto(id_producto, codigo, rif);
          break;
          
        default: false;
      }
    });

    
})
function eliminar_producto(id_producto, codigo, rif)
{
    let page = 'eliminar_producto';


    $.ajax
    ({
       url: '../../functions/eliminar.php',
       type: 'POST',
       dataType: 'html',
       data: 
       {
         page : page,
         id_producto: id_producto,
         codigo: codigo,
         rif: rif
      }
  
    })
    .done(function(res)
    {
     lista_de_productos();
  
    })
    .fail(function(err)
    {
      console.log(err);
    })
}