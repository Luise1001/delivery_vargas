$(document).ready(tasa_del_dia());

function tasa_del_dia()
{
    let page = 'tasa_del_dia';

    $.ajax
    ({
       url: '../../functions/editar.php',
       type: 'POST',
       dataType: 'html',
       data: 
       {
         page: page
       }
  
    })
    .done(function(res)
    {
        let tasa = parseFloat(res);
        $('#edit_tasa').val(tasa);
    })
    .fail(function()
    {
      console.log("error ejecutando Ajax");
    })
}

$(document).on('click', '#modificar_tasa', function()
{
    editar_tasa();
})

function editar_tasa()
{
    let page = 'editar_tasa';
    let tasa = $('#edit_tasa').val();

    $.ajax
    ({
       url: '../../functions/editar.php',
       type: 'POST',
       dataType: 'html',
       data: 
       {
         page: page,
         tasa: tasa
       }
  
    })
    .done(function(res)
    {
      swal('Operación Exitosa', '', 'success');
    })
    .fail(function(err)
    {
      console.log(err);
    })
}