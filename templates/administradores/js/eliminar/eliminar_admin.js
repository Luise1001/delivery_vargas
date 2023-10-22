$(document).on('click', '.eliminar-admin', function(e)
{   
    let id_usuario = e.currentTarget.attributes.admin.value;

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
          eliminar_admin(id_usuario);
          break;
          
        default: false;
      }
    });
})

function eliminar_admin(id_usuario)
{
    let funcion = 'eliminar_admin';

    $.ajax
    ({
       url: '../../server/functions/eliminar.php',
       type: 'POST',
       dataType: 'json',
       data: 
       {
          funcion: funcion,
          id_usuario: id_usuario
       }
  
    })
    .done(function(res)
    {
      let titulo = res.titulo;
      let cuerpo = res.cuerpo;
      let accion = res.accion;
      
      if(accion === 'success')
      {
        lista_de_administradores(); 
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