$(document).ready(mis_categorias());

function mis_categorias()
{
    let funcion = 'categorias_comercios';
    $.ajax
    ({
       url: '../../server/functions/consultas.php',
       type: 'POST',
       dataType: 'html',
       data: 
       {
          funcion: funcion
       }
  
    })
    .done(function(res)
    {
      $('.categorias').html(res)

    })
    .fail(function()
    {
       console.log('error ejecutando Ajax');
    })
}

$(document).on('click', '.select-cat-comer', function(e)
{
    Selected_categories(e);
})

function Selected_categories(e)
{
   let funcion = 'elegir_categoria';
   let id_option = e.target.attributes.id.textContent;
   let id_categoria = e.target.attributes.name.textContent;

      $.ajax
      ({
         url: '../../server/functions/agregar.php',
         type: 'POST',
         dataType: 'html',
         data: 
         {
            funcion: funcion,
            id_categoria
         }
    
      })
      .done(function(res)
      {
       
        mis_categorias();
  
      })
      .fail(function()
      {
         console.log('error ejecutando Ajax');
      })

}
