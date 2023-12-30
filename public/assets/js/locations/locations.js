$('.delete-direction').on('click', function(e) {
    e.preventDefault();
    const form = $(this).closest('form');
    swal('Seguro que desea eliminar', '', 'warning', {
            buttons: {
                cancel: 'Cancelar',
                Confirmar: true,
            },
        })
        .then((value) => {
            switch (value) {

                case "Confirmar":
                    form.submit();
                    break;

                default:
                    false;
            }
        });
});