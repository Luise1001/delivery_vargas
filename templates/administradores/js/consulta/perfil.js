$(document).ready(mi_perfil());

function mi_perfil()
{
   let page = 'mi_perfil';

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
     $('.user-head').html(res.header);
     $('.user-personal-data').html(res.data);
   })
   .fail(function(err)
   {
      console.log(err.responseText);
   })

}

$(document).on('click', '.personal-data-btn', function()
{ 
   ArrowChange();
})

function ArrowChange()
{  
   let arrow = document.getElementById('arrow_pd');

   if(arrow.classList.contains('fa-angle-down'))
   { 
      $('#arrow_pd').removeClass('fa-angle-down');
      $('#arrow_pd').addClass('fa-angle-up');
   }
   else
   {
      $('#arrow_pd').removeClass('fa-angle-up');
      $('#arrow_pd').addClass('fa-angle-down');
   }
}