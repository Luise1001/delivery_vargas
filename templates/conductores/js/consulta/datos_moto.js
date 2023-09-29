$(document).ready(mi_moto());

function mi_moto()
{
    let page = 'mi_moto';
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
      $('.datos-moto').html(res);
    })
    .fail(function(err)
    {
       console.log(err);
    })
}

$(document).on('click', '.moto-data', function()
{ 
   ArrowChangeMT();
})

function ArrowChangeMT()
{  
   let arrow = document.getElementById('arrow_mt');

   if(arrow.classList.contains('fa-angle-down'))
   { 
      $('#arrow_mt').removeClass('fa-angle-down');
      $('#arrow_mt').addClass('fa-angle-up');
   }
   else
   {
      $('#arrow_mt').removeClass('fa-angle-up');
      $('#arrow_mt').addClass('fa-angle-down');
   }
}