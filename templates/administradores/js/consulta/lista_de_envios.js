$(document).ready(lista_de_envios());

function lista_de_envios()
{ 
   page = 'mis_envios';
 
  $.ajax
  ({
     url: '../../functions/consultas.php',
     type: 'POST',
     dataType: 'json',
     data: 
     {
       page : page
    }

  })
  .done(function(res)
  {
    $('#pendientes').html(res.pendientes);
    $('#asignados').html(res.asignados);
    $('#transito').html(res.transito);
    $('#completados').html(res.completados);

  })
  .fail(function(err)
  {
    console.log(err);
  })
}

$(document).on('click', '.envio-detalle', function(data)
{ 
  let id = data.target.id;
  let id_name = 'detalle_'+id;
  let detalle = document.getElementById(id_name);

  detalle.classList.toggle("active");
  if(detalle.style.display === 'block')
  {
    detalle.style.display = 'none';
  }
  else
  {
    detalle.style.display = 'block';
  }

})