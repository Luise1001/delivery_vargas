$(document).ready(mi_perfil());

function mi_perfil()
{
   let funcion = 'mi_perfil';

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
     $('.user-head').html(res.header);
     $('.user-personal-data').html(res.data);
   })
   .fail(function(err)
   {
      console.log(err.responseText);
   })
}

$(document).ready(mi_switch());

function mi_switch()
{
   let funcion = 'mi_switch';

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
     $('.mi-switch').html(res);
   })
   .fail(function(err)
   {
      console.log(err.responseText);
   })
}

$(document).on('click', '.personal-data-btn', function()
{ 
   ArrowPD();
})

function ArrowPD()
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

$(document).on('click', '.list-cat-btn', function()
{ 
   ArrowCAT();
})

function ArrowCAT()
{  
   let arrow = document.getElementById('arrow_cat');

   if(arrow.classList.contains('fa-angle-down'))
   { 
      $('#arrow_cat').removeClass('fa-angle-down');
      $('#arrow_cat').addClass('fa-angle-up');
   }
   else
   {
      $('#arrow_cat').removeClass('fa-angle-up');
      $('#arrow_cat').addClass('fa-angle-down');
   }
}