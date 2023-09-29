$(document).ready(mis_datos_bancarios());

function mis_datos_bancarios()
{
    let page = 'mis_datos_bancarios';
    $.ajax
    ({
       url: '../../functions/consultas.php',
       type: 'POST',
       dataType: 'json',
       data: 
       {
          page: page
       }
  
    })
    .done(function(res)
    {
      $('.header-icons').html(res.botones);
      $('.mis-datos-bancarios').html(res.datos);

    })
    .fail(function()
    {
       console.log('error ejecutando Ajax');
    })
}

async function lista_de_bancos()
{
   let page = 'lista_de_bancos';
   const bancos = await
   $.ajax
   ({
      url: '../../functions/consultas.php',
      type: 'POST',
      dataType: 'html',
      data: 
      {
         page: page
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