$(document).ready(header_menu());

function header_menu()
{
    let url = window.location.href;
  
    $.ajax
    ({
       url: '../../functions/header_menu.php',
       type: 'POST',
       dataType: 'html',
       data: 
       {
         url : url
      }
  
    })
    .done(function(res)
    {
      $('.setting-menu').html(res);
    })
    .fail(function(err)
    {
      console.log(err);
    })
}


$(document).ready(footer_menu());

function footer_menu()
{
    let url = window.location.href;
  
    $.ajax
    ({
       url: '../../functions/footer_menu.php',
       type: 'POST',
       dataType: 'html',
       data: 
       {
         url : url,
      }
  
    })
    .done(function(res)
    {
      $('.footer-menu').html(res);
       IconsColor();
    })
    .fail(function()
    {
      console.log("error ejecutando Ajax");
    })
}

$(document).on('click', '#btn_setting', function()
{
  this.classList.toggle("active");
  let dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") 
  {
    dropdownContent.style.display = "none";
  } 
  else
   {
    dropdownContent.style.display = "block";
  }
})

$(document).ready(focus_slide())

function focus_slide()
{
   $('#slide_0').focus();
}


function IconsColor()
{
   let MyLocation = window.location;
   let url = MyLocation.pathname;
   let icon = '';
   
   if(url.includes('inicio/inicio'))
   {
      icon = document.getElementById('icon_home');
      icon.style.color = "white";
   }
   if(url.includes('lista_de_envios'))
   {
      icon = document.getElementById('icon_motorcycle');
      icon.style.color = "white";
   }
   if(url.includes('calcular_ruta'))
   {
      icon = document.getElementById('icon_calculator');
      icon.style.color = "white";
   }
   if(url.includes('mi_perfil'))
   {
      icon = document.getElementById('icon_profile');
      icon.style.color = "white";
   }
   if(url.includes('comercios_by_categoria') || url.includes('lista_de_productos'))
   {
     icon = document.getElementById('icon_shopping');
     icon.style.color = "white";
   }
   if(url.includes('pedidos'))
   {
     icon = document.getElementById('icon_file');
     icon.style.color = "white";
   }
}