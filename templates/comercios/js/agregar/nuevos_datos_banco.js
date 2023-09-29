var selected = 1;
$(document).ready(ChooseOption(selected));

$(document).on('change', '#metodo_de_pago', function(data)
{
    let select = document.getElementById('metodo_de_pago');
    let option = this.options[select.selectedIndex];
    selected = option.value;

    ChooseOption(selected);

})


async function ChooseOption(option)
{
    let div_pago_movil = document.getElementById('div_pago_movil');
    let div_transferencia = document.getElementById('div_transferencia');
    let div_zelle = document.getElementById('div_zelle');

    if(typeof lista_de_bancos === 'function')
    {
      if(option == 1)
      {
          div_pago_movil.removeAttribute('hidden');
          div_transferencia.setAttribute('hidden', true);
          div_zelle.setAttribute('hidden', true);
  
          const bancos = await lista_de_bancos();
          $('#lista_banco_pm').html(bancos);
  
      }
      if(option == 2)
      {
          div_pago_movil.setAttribute('hidden', true);
          div_transferencia.removeAttribute('hidden');
          div_zelle.setAttribute('hidden', true);  
          let val = false;
  
          const bancos = await lista_de_bancos(val);
          $('#lista_banco_tr').html(bancos);
      }
      if(option == 3)
      {
          div_pago_movil.setAttribute('hidden', true);
          div_transferencia.setAttribute('hidden', true);
          div_zelle.removeAttribute('hidden');     
      }
    }
    

}

$(document).on('click', '#agregar_datos_banco', function()
{
    nuevos_datos_banco();
})

function nuevos_datos_banco()
{
    let formData = new FormData();
    let page = 'nuevos_datos_bancarios';
    let banco = '';
    let letra = '';
    let rif = '';
    let telefono = '';
    let cuenta = '';
    let correo = '';
    let titular = '';

    formData.append('page', page);

   if(selected == 1)
   { 
      banco = $('#lista_banco_pm').val();
      letra = $('#tipo_id_pm').val();
      rif = $('#rif_pm').val();
      telefono = $('#telefono_pm').val();

      formData.append('metodo', 'pago_movil');
      formData.append('banco', banco);
      formData.append('letra', letra);
      formData.append('rif', rif);
      formData.append('telefono', telefono);
   }
   if(selected == 2)
   {
    banco = $('#lista_banco_tr').val();
    letra = $('#tipo_id_tr').val();
    rif = $('#rif_tr').val();
    cuenta = $('#nro_cuenta').val();

    formData.append('metodo', 'transferencia');
    formData.append('banco', banco);
    formData.append('letra', letra);
    formData.append('rif', rif);
    formData.append('cuenta', cuenta);
   }
   if(selected == 3)
   {
    correo = $('#correo_zelle').val();
    titular = $('#titular_zelle').val();

    formData.append('metodo', 'zelle');
    formData.append('correo', correo);
    formData.append('titular', titular);
   }

   if(banco && rif && telefono || banco && rif && cuenta || correo && titular)
   {
    $.ajax
    ({
       url: '../../functions/agregar.php',
       type: 'POST',
       dataType: 'html',
       async: true,
       data: formData,
       contentType: false,
       processData: false
  
    })
    .done(function(res)
    { 
       mis_datos_bancarios();
    })
    .fail(function(err)
    {
      console.log(err)
    })
   }
   else
   {
     swal('Cuidado', 'No se Pueden Enviar Campos Vacíos', 'warning');
   }
}

$(document).on('keyup', '#correo_zelle', async function()
{
    let email = $('#correo_zelle').val();
    let validar_email = await AlertZelle(email);
   
    let button = document.getElementById('agregar_datos_banco');
    if(validar_email == false)
    {
      $('#alert_correo_zelle').html('Debe Ingresar Un Correo Valido.');
      button.setAttribute('hidden', true);
    }
    else
    {
     $('#alert_correo_zelle').html('');
       button.removeAttribute('hidden');
    }
})

async function AlertZelle(email)
{
    let page = 'valida_email';
   const resp = 
    $.ajax
    ({
       url: '../../functions/consultas.php',
       type: 'POST',
       dataType: 'html',
       data: 
       {
         page: page,
         email: email
       }
  
    })
    .done(async function(res)
    { 
      return await res;
    })
    .fail(function(err)
    {
      console.log(err)
    })
    return resp;
}