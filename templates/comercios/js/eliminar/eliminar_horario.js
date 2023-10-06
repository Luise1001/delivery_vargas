$(document).on('change', '.switch-time', function(data)
{
    let id = data.currentTarget.attributes.dia.value;
    let div_name = 'div_hour_' + id;
    let switch_name = 'switch_' + id;
    let div = document.getElementById(div_name);
    const switch_time = document.getElementById(switch_name);
    let guardar_btn = document.getElementById('guardar_horario');

    if(!switch_time.checked)
    {
        div.setAttribute('hidden', true);
        guardar_btn.removeAttribute('hidden');

        horario.append('dia', id);

        eliminar_horario();
    }
   
})

function eliminar_horario()
{
    let funcion = 'eliminar_horario';
    horario.append('funcion', funcion);

    $.ajax
    ({
       url: '../../server/functions/eliminar.php',
       type: 'POST',
       dataType: 'html',
       async: true,
       data: horario,
       contentType: false,
       processData: false
  
    })
    .done(function(res)
    { 
        
    })
    .fail(function(err)
    {
      console.log(err)
    })
}