const registrarse = document.querySelector('#card_registrarse');
const sesion = document.querySelector('#card_sesion');

$(document).on('click', '#sing_up_option', function()
{
   registrarse.style.display = 'flex';
   sesion.style.display = 'none';
})

$(document).on('click', '#log_in_option', function()
{
    registrarse.style.display = 'none';
    sesion.style.display = 'flex';
})

$(document).on('click', '#log_in', function(e)
{
     login(e);
})

function login(e)
{   
    e.preventDefault();

    let usuario = $('#user').val();
    let password = $('#password').val();
    let funcion = 'login';

    $.ajax
    ({
       url: 'server/functions/consultas.php',
       type: 'POST',
       dataType: 'json',
       async: false,
       data: 
       {
          funcion: funcion,
          usuario: usuario,
          password: password
       }
  
    })
    .done(function(res)
    {

        let titulo = res.titulo;
        let cuerpo = res.cuerpo;
        let accion = res.accion;

        if(accion === 'success')
        {
            window.location.href = 'templates/inicio/inicio';
        }
        else
        {
            swal(titulo, cuerpo, accion);
        }
         

    })
    .fail(function(err)
    {
        console.log(err);
    })
}

$(document).on('click', '#sing_up', function()
{
    nuevo_usuario();
})


function nuevo_usuario()
{
    let user = $('#r_user_name').val();
    let pass = $('#r_password').val();
    let pass_2 = $('#r_password_2').val();
    let codigo = $('#correo_code').val();
    let funcion = 'nuevo_usuario';

    $.ajax
    ({
       url: 'server/functions/agregar.php',
       type: 'POST',
       dataType: 'json',
       async: false,
       data: 
       {
          funcion: funcion,
          user: user,
          pass: pass,
          pass_2: pass_2,
          codigo: codigo
       }
  
    })
    .done(function(res)
    { 
        let titulo = res.titulo;
        let cuerpo = res.cuerpo;
        let accion = res.accion;

       swal(titulo, cuerpo, accion);

    })
    .fail(function(err)
    {
        console.log(err)
    })

}


$(document).on('keyup', '#r_password_2', function()
{ 
    let pass =  document.getElementById('r_password').value;
    let pass_2 = document.getElementById('r_password_2').value;
    let alerta = "Las contraseñas deben coincidir";
    let div = document.getElementById('alert');

    if(pass != pass_2)
    {
        $('#sing_up').prop('hidden', true);
        div.innerHTML = "<p>"+alerta+"</p>";
    }
    else
    {
        $('#sing_up').prop('hidden', false);
        div.innerHTML = "";
    }

    
})

$(document).on('click', '#sent_code', function()
{
    enviar_codigo();
    
})

function enviar_codigo()
{
    let correo = $('#r_user_name').val();
    let funcion = 'generar_codigo';

    $.ajax
    ({
       url: 'server/functions/agregar.php',
       type: 'POST',
       dataType: 'html',
       async: false,
       data: 
       {
          funcion: funcion,
          correo: correo
       }
  
    })
    .done(function(res)
    { 
       console.log(res)
    })
    .fail(function(err)
    {
        console.log(err)
    })
}

$(document).on('click', '#reset_pass', function()
{
    let correo = $('#correo_name').val();
    let funcion = 'reset_password';
    
    $.ajax
    ({
       url: 'server/functions/editar.php',
       type: 'POST',
       dataType: 'json',
       async: false,
       data: 
       {
          funcion: funcion,
          correo: correo
       }
  
    })
    .done(function(res)
    {
        let titulo = res.titulo;
        let cuerpo = res.cuerpo;
        let accion = res.accion;

        swal(titulo, cuerpo, accion);

    })
    .fail(function(err)
    {
        console.log(err)
    })
})


let deferredPrompt = null;
const installButton = document.getElementById('installButton');

installButton.addEventListener('click', installApp);

window.addEventListener('beforeinstallprompt', saveEvt);

function saveEvt(e)
{
  e.preventDefault();
  deferredPrompt = e;
  
  installButton.removeAttribute('hidden');
}

function installApp(e)
{
  deferredPrompt.prompt();
  e.srcElement.setAttribute('hidden', true);
}









