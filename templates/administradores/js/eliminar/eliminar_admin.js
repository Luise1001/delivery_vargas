$(document).on('click', '#eliminar_admin_btn', function(data)
{   
    id_admin = data.target.parentNode.attributes.admin.value;

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
          eliminar_admin();
          break;
          
        default: false;
      }
    });
})

function eliminar_admin()
{
    let page = 'eliminar_admin';

    $.ajax
    ({
       url: '../../functions/eliminar.php',
       type: 'POST',
       dataType: 'html',
       data: 
       {
          page: page,
          id_admin: id_admin
       }
  
    })
    .done(function(res)
    {
      lista_de_administradores(); 
    })
    .fail(function()
    {
      console.log("error ejecutando Ajax");
    })
}