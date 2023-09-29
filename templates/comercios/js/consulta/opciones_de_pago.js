$(document).ready(opciones_de_pago());

function opciones_de_pago()
{ 
    let page = 'opciones_de_pago';
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
    .done(function(res)
    {
      $('.opciones-de-pago').html(res)

    })
    .fail(function(err)
    {
       console.log(err);
    })
}

$(document).on('click', '.select-pay-comer', function(e)
{
    Selected_method(e);
})

function Selected_method(e)
{
   let page = 'elegir_metodo_pago';
   let id_option = e.target.attributes.id.textContent;
   let id_metodo = e.target.attributes.name.textContent;

      $.ajax
      ({
         url: '../../functions/agregar.php',
         type: 'POST',
         dataType: 'html',
         data: 
         {
            page: page,
            id_metodo
         }
    
      })
      .done(function(res)
      {
       
        opciones_de_pago();
  
      })
      .fail(function(err)
      {
         console.log(err);
      })

}

$(document).on('click', '.list-payment-btn', function()
{ 
   ArrowPay();
})

function ArrowPay()
{  
   let arrow = document.getElementById('arrow_pay');

   if(arrow.classList.contains('fa-angle-down'))
   { 
      $('#arrow_pay').removeClass('fa-angle-down');
      $('#arrow_pay').addClass('fa-angle-up');
   }
   else
   {
      $('#arrow_pay').removeClass('fa-angle-up');
      $('#arrow_pay').addClass('fa-angle-down');
   }
}