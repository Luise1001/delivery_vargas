let registrarse = document.querySelector('#card_registrarse');
let sesion = document.querySelector('#card_sesion');
let admin = document.querySelector('#card_admin');

$(document).on('click', '#sing_up_option', function()
{
   registrarse.style.display = 'flex';
   sesion.style.display = 'none';
   admin.style.display = 'none';
})

$(document).on('click', '#log_in_option', function()
{
    registrarse.style.display = 'none';
    sesion.style.display = 'flex';
    admin.style.display = 'none';
})

$(document).on('click', '#admin_option', function()
{
    registrarse.style.display = 'none';
    sesion.style.display = 'none';
    admin.style.display = 'flex';
})

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


const formSesion = document.querySelector('#formSesion');
const user = document.querySelector('#user_name');
const pass = document.querySelector('#password');
let page = '';

formSesion.addEventListener('submit', e=>
{
    page = 'sesion_cliente';
    let usuario = user.value;
    let password = pass.value;

    e.preventDefault();
    $.ajax
    ({
       url: 'functions/consultas.php',
       type: 'POST',
       dataType: 'json',
       async: false,
       data: 
       {
          page: page,
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
            window.location.href = "templates/inicio/inicio";
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
})


const SesionAdmin = document.querySelector('#SesionAdmin');
const a_user_name = document.querySelector('#a_user_name');
const a_password = document.querySelector('#a_password');

SesionAdmin.addEventListener('submit', e=>
{
    e.preventDefault();

    page = 'sesion_admin';
    let usuario = a_user_name.value;
    let password = a_password.value;

    $.ajax
    ({
       url: 'functions/consultas.php',
       type: 'POST',
       dataType: 'json',
       async: false,
       data: 
       {
          page: page,
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
            window.location.href = "templates/inicio/inicio";
        }
        else
        {
            swal(titulo, cuerpo, accion);
        }

         

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

$(document).on('click', '#reset_pass', function()
{
    let correo = $('#correo_name').val();
    let page = 'reset_password';
    
    $.ajax
    ({
       url: 'functions/editar.php',
       type: 'POST',
       dataType: 'json',
       async: false,
       data: 
       {
          page: page,
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

$(document).on('click', '#sing_up', function()
{
    registrar_usuario();
})


function registrar_usuario()
{
    let user = $('#r_user_name').val();
    let pass = $('#r_password').val();
    let pass_2 = $('#r_password_2').val();
    let codigo = $('#correo_code').val();
    let page = 'nuevo_usuario';

    $.ajax
    ({
       url: 'functions/agregar.php',
       type: 'POST',
       dataType: 'json',
       async: false,
       data: 
       {
          page: page,
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

$(document).on('click', '#sent_code', function()
{
    enviar_codigo();
    
})

function enviar_codigo()
{
    let correo = $('#r_user_name').val();
    let page = 'generar_codigo';

    $.ajax
    ({
       url: 'functions/agregar.php',
       type: 'POST',
       dataType: 'html',
       async: false,
       data: 
       {
          page: page,
          correo: correo
       }
  
    })
    .done(function(res)
    { 
    
    })
    .fail(function(err)
    {
        console.log(err)
    })
}



