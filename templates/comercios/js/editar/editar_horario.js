$(document).on('change', '.open-hour', function(data)
{
    let id = data.currentTarget.attributes.dia.value;
    let abrir = this.value;
    horario.append('dia', id);
    horario.append('abrir', abrir);
    
    editar_horario();
})

$(document).on('change', '.close-hour', function(data)
{
    let id = data.currentTarget.attributes.dia.value;
    let cerrar = this.value;
    horario.append('dia', id);
    horario.append('cerrar', cerrar);
    
    editar_horario();
})

function editar_horario()
{
    let page = 'editar_horario';
    horario.append('page', page);
    let guardar_btn = document.getElementById('guardar_horario');
    guardar_btn.removeAttribute('hidden');

    $.ajax
    ({
       url: '../../functions/editar.php',
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