$(document).ready(detalle_conductor());

function detalle_conductor() {
   const parametros = window.location.search;
   const variables = new URLSearchParams(parametros);
   let id_usuario = variables.get('admin');
   let funcion = 'detalle_admin';

   $.ajax
      ({
         url: '../../server/functions/consultas.php',
         type: 'POST',
         dataType: 'json',
         data:
         {
            funcion: funcion,
            id_usuario: id_usuario
         }

      })
      .done(function (res) {
         $('.titulo-app').html(res.titulo);
         $('.detalle-admin').html(res.admin);
      })
      .fail(function (err) {
         console.log(err);
      })
}

$(document).on('click', '#guardar_admin', function () {
   editar_admin();
})

function editar_admin() {

   const parametros = window.location.search;
   const variables = new URLSearchParams(parametros);
   let id_usuario = variables.get('admin');
   let nivel = $('#nivel').val();
   let funcion = 'editar_admin';
 
      $.ajax
         ({
            url: '../../server/functions/editar.php',
            type: 'POST',
            dataType: 'json',
            data:
            {
               funcion: funcion,
               id_usuario: id_usuario,
               nivel: nivel
            }

         })
         .done(function (res) {
            let titulo = res.titulo;
            let cuerpo = res.cuerpo;
            let accion = res.accion;

            if(accion === 'success')
            {
               window.location.href= "lista_de_administradores";
            }
            else
            {
               swal(titulo, cuerpo, accion);
            }
         })
         .fail(function (err) {
            console.log(err);
         })
}
