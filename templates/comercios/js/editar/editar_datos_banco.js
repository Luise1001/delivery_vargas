const pago_movil = document.getElementById('div_editar_pm');
const transferencia = document.getElementById('div_editar_tr');
const zelle = document.getElementById('div_editar_zelle');
let option = '';
let id = '';

$(document).on('click', '.edit-pm-btn', function(data)
{
    pago_movil.removeAttribute('hidden');
    transferencia.setAttribute('hidden', true);
    zelle.setAttribute('hidden', true);
    option = 'pm';

    FillData(option, data);

})

$(document).on('click', '.edit-tr-btn', function(data)
{
    pago_movil.setAttribute('hidden', true);
    transferencia.removeAttribute('hidden');
    zelle.setAttribute('hidden', true);
    option = 'tr';
    FillData(option, data);
})

$(document).on('click', '.edit-zl-btn', function(data)
{
    pago_movil.setAttribute('hidden', true);
    transferencia.setAttribute('hidden', true);
    zelle.removeAttribute('hidden');
    option = 'zl';
    FillData(option, data);

})

async function FillData(option, data)
{
    if(option === 'pm')
    {
         id = data.currentTarget.attributes.pm.value;
        let tipo_id = data.currentTarget.attributes.tipo.value;
        let documento=  data.currentTarget.attributes.documento.value;
        let id_banco = data.currentTarget.attributes.banco.value;
        let banco = data.currentTarget.attributes.bcname.value;
        let telefono = data.currentTarget.attributes.telefono.value;
        $('#position').val('pm');
        $('#edit_lista_banco_pm').html('');
    
        const bancos = await lista_de_bancos();
        
        $('#main_option_pm').val(id_banco);
        $('#main_option_pm').html(banco);
        $('#edit_lista_banco_pm').append(bancos);
        $('#edit_tipo_id_pm').val(tipo_id);
        $('#edit_rif_pm').val(documento);
        $('#edit_telefono_pm').val(telefono);
    }
    
    if(option === 'tr')
    {
         id = data.currentTarget.attributes.tr.value;
        let tipo_id = data.currentTarget.attributes.tipo.value;
        let documento=  data.currentTarget.attributes.documento.value;
        let id_banco = data.currentTarget.attributes.banco.value;
        let banco = data.currentTarget.attributes.bcname.value;
        let cuenta = data.currentTarget.attributes.cuenta.value;
        $('#position').val('tr');
        $('#edit_lista_banco_tr').html('');
    
        const bancos = await lista_de_bancos();
        
        $('#main_option_tr').val(id_banco);
        $('#main_option_tr').html(banco);
        $('#edit_lista_banco_tr').append(bancos);
        $('#edit_tipo_id_tr').val(tipo_id);
        $('#edit_rif_tr').val(documento);
        $('#edit_nro_cuenta').val(cuenta);
    }

    if(option === 'zl')
    {
        id = data.currentTarget.attributes.zelle.value;
        let correo = data.currentTarget.attributes.correo.value;
        let titular =  data.currentTarget.attributes.titular.value;
        $('#position').val('zl');
    
        
        $('#edit_correo_zelle').val(correo);
        $('#edit_titular_zelle').val(titular);
    }

}

$(document).on('keyup', '#edit_correo_zelle', async function()
{
    let email = $('#edit_correo_zelle').val();
    let validar_email = await AlertZelle(email);
    let button = document.getElementById('modificar_datos_banco');
    
     if(validar_email == false)
     {
       $('#edit_alert_correo_zelle').html('Debe Ingresar Un Correo Valido.');
       button.setAttribute('hidden', true);
     }
     else
     {
      $('#edit_alert_correo_zelle').html('');
        button.removeAttribute('hidden');
     }
     
})

$(document).on('click', '#modificar_datos_banco', function()
{ 
     editar_datos_banco();
})

function editar_datos_banco()
{
    let funcion = 'editar_datos_banco';
    let option = $('#position').val();
    let tipo_id = '';
    let documento = '';
    let telefono = '';
    let cuenta = '';
    let id_banco = '';
    let correo = '';
    let titular = '';

    let formData = new FormData();
    formData.append('funcion', funcion);
    formData.append('option', option);
    formData.append('id', id);
    
    if(option === 'pm')
    {
        tipo_id = $('#edit_tipo_id_pm').val();
        documento=  $('#edit_rif_pm').val();
        id_banco = $('#edit_lista_banco_pm').val();
        telefono = $('#edit_telefono_pm').val();
        
        formData.append('tipo_id',tipo_id );
        formData.append('documento', documento);
        formData.append('id_banco', id_banco);
        formData.append('telefono', telefono);
    }
    
    if(option === 'tr')
    {
        tipo_id = $('#edit_tipo_id_tr').val();
        documento=  $('#edit_rif_tr').val();
        id_banco = $('#edit_lista_banco_tr').val();
        cuenta = $('#edit_nro_cuenta').val();
        
        formData.append('tipo_id',tipo_id );
        formData.append('documento', documento);
        formData.append('id_banco', id_banco);
        formData.append('cuenta', cuenta);

    }

    if(option === 'zl')
    {
        correo = $('#edit_correo_zelle').val();
        titular =  $('#edit_titular_zelle').val();
        
        formData.append('correo', correo);
        formData.append('titular', titular);
    }

    if(id && tipo_id && documento && id_banco && telefono || id && tipo_id && documento && id_banco && cuenta || id && correo && titular)
    { 
     $.ajax
     ({
        url: '../../server/functions/editar.php',
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