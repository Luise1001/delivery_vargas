$(document).ready(mostrar_menu());

function mostrar_menu()
{
    let url = window.location.href;
  
    $.ajax
    ({
       url: '../../functions/sidebar_menu.php',
       type: 'POST',
       dataType: 'html',
       data: 
       {
         url : url,
      }
  
    })
    .done(function(res)
    {
      $('.menu-links').html(res);
    })
    .fail(function()
    {
      console.log("error ejecutando Ajax");
    })
}

$(document).on('click', '#reload', function()
{
  reload();
})

function reload()
{
  window.location.reload(true);
}

$(document).on('click', '.menu_opciones', function()
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

$(document).on('change', '#estatus', function()
{
   SwitchEncendidoApagado();
})

function SwitchEncendidoApagado()
{
  const estatus = document.getElementById('estatus');
  let page = 'switch_encendido_apagado';
  let estado = 1;

  if(estatus.checked)
  {
    estado = 0;
  }
  else
  {
    estado = 1;
  }

  $.ajax
  ({
     url: '../../functions/editar.php',
     type: 'POST',
     dataType: 'html',
     data: 
     {
       page : page,
       estado : estado
    }

  })
  .done(function(res)
  {
    reload();
   
  })
  .fail(function()
  {
    console.log("error ejecutando Ajax");
  })
  
}

$(document).ready(tasa_del_dia());

function tasa_del_dia()
{
    let page = 'tasa_del_dia';

    $.ajax
    ({
       url: '../../functions/editar.php',
       type: 'POST',
       dataType: 'html',
       data: 
       {
         page: page
       }
  
    })
    .done(function(res)
    {
       $('#tasa_dd').html('Tasa BCV: ' + res)
    })
    .fail(function()
    {
      console.log("error ejecutando Ajax");
    })
}
