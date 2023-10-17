$(document).ready(mis_datos_bancarios());

function mis_datos_bancarios()
{
    let funcion = 'mis_datos_bancarios';
    $.ajax
    ({
       url: '../../server/functions/consultas.php',
       type: 'POST',
       dataType: 'json',
       data: 
       {
          funcion: funcion
       }
  
    })
    .done(function(res)
    {
      $('.header-icons').html(res.botones);
      $('.mis-datos-bancarios').html(res.datos);

    })
    .fail(function(err)
    {
       console.log(err);
    })
}

async function lista_de_bancos()
{
   let funcion = 'lista_de_bancos';
   const bancos = await
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
   .done(async function(res)
   {
       return await res;

   })
   .fail(function()
   {
      console.log('error ejecutando Ajax');
   })

   return bancos;

}