$(document).ready(function(){

    $(".borrar").click(function(event){
        event.preventDefault();

        Swal.fire({
            title: '¿Deseas borrar este registro de correspondencia?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                $(".formBorrar").submit();
            } 
        });

    });
 });