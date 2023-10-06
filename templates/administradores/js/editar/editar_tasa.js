$(document).ready(tasa_del_dia());

function tasa_del_dia()
{
    let funcion = 'tasa_del_dia';

    $.ajax
    ({
       url: '../../server/functions/editar.php',
       type: 'POST',
       dataType: 'html',
       data: 
       {
         funcion: funcion
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
    let funcion = 'editar_tasa';
    let tasa = $('#edit_tasa').val();

    $.ajax
    ({
       url: '../../server/functions/editar.php',
       type: 'POST',
       dataType: 'html',
       data: 
       {
         funcion: funcion,
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