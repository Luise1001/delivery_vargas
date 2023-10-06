var horario = new FormData();
$(document).on('change', '.switch-time', function(data)
{
    let id = data.currentTarget.attributes.dia.value;
    let div_name = 'div_hour_' + id;
    let switch_name = 'switch_' + id;
    let div = document.getElementById(div_name);
    const switch_time = document.getElementById(switch_name);
    let guardar_btn = document.getElementById('guardar_horario');

    if(switch_time.checked)
    {
        div.removeAttribute('hidden');
        guardar_btn.removeAttribute('hidden');
        let abrir = $('#open_'+id).val();
        let cerrar = $('#closed_' + id).val();
   
        horario.append('dia', id);
        horario.append('abrir', abrir);
        horario.append('cerrar', cerrar);

        nuevo_horario();
    }
    else
    {
        div.setAttribute('hidden', true);
    }
   
})

function nuevo_horario()
{
    let funcion = 'nuevo_horario';
    horario.append('funcion', funcion);

    $.ajax
    ({
       url: '../../server/functions/agregar.php',
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